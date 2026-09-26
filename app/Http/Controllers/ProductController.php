<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest; // 提出条件のFormRequestをインポート

class ProductController extends Controller
{
    /**
     * 商品一覧表示（検索・価格絞り込み・ログインユーザー以外・昇順）
     */
    public function index(Request $request)
    {
        // ログイン中のユーザー以外の商品に絞り込み、会社情報も一緒に取得
        $query = Product::with('company')->where('user_id', '!=', Auth::id());

        // キーワード検索
        if ($keyword = $request->input('keyword')) {
            $query->where('product_name', 'like', '%' . $keyword . '%');
        }

        // 最低価格の絞り込み
        if ($min_price = $request->input('min_price')) {
            $query->where('price', '>=', $min_price);
        }

        // 最高価格の絞り込み
        if ($max_price = $request->input('max_price')) {
            $query->where('price', '<=', $max_price);
        }

        // 商品番号（id）の昇順で取得
        $products = $query->orderBy('id', 'asc')->get();

        return view('product_index', compact('products'));
    }

    /**
     * 新規登録画面
     */
    public function create()
    {
        return view('product_create');
    }

    /**
     * 新規登録処理（FormRequestを使用）
     */
    public function store(ProductRequest $request)
    {
        // テーブル定義書の company_id 必須要件に対応するため、ログインユーザーの company_id を紐付け[cite: 1, 2]
        Product::create([
            'user_id' => Auth::id(),
            'company_id' => Auth::user()->company_id ?? 1, // ユーザーに紐づく会社ID（存在しない場合のフォールバックとして1を指定）
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'img_path' => $request->img_path ?? 'default.jpg', // 必要に応じて画像パスの保存処理
        ]);

        return redirect()->route('products.index')->with('success', '商品を登録しました！');
    }

    /**
     * 商品詳細表示
     */
    public function show($id)
    {
        // 画面定義書の会社名表示に対応するため company リレーションも一緒に取得[cite: 6]
        $product = Product::with('company', 'user')->findOrFail($id);
        return view('product_show', compact('product'));
    }

    /**
     * 編集画面
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        
        // 自分の出品物でなければ一覧に戻す
        if ($product->user_id !== Auth::id()) {
            return redirect()->route('products.index');
        }

        return view('edit', compact('product'));
    }

    /**
     * 更新処理（FormRequestを使用）
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->user_id !== Auth::id()) {
            return redirect()->route('products.index');
        }

        $product->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')->with('success', '商品を更新しました！');
    }

    /**
     * 削除処理
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->user_id === Auth::id()) {
            $product->delete();
        }

        return redirect()->route('products.index')->with('success', '商品を削除しました！');
    }

    /**
     * 購入画面の表示（GET用：必要に応じて実装）
     */
    public function purchase(Request $request, $id)
    {
        $product = Product::with('company')->findOrFail($id);
        return view('product_purchase', compact('product'));
    }

    /**
     * 購入処理の実行（POST用：ルーティングの 'buy' に合わせる）
     */
    public function buy(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        $quantity = $request->input('quantity');

        // 在庫数を減らす
        $product->stock -= $quantity;
        $product->save();

        // 購入履歴（sales）を保存
        Sale::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        return redirect()->route('products.index')->with('success', '購入が完了しました！');
    }
}