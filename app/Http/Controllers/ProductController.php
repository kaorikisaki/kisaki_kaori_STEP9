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
        // ログイン中のユーザー以外の商品に絞り込む
        $query = Product::where('user_id', '!=', Auth::id());

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
        Product::create([
            'user_id' => Auth::id(),
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')->with('success', '商品を登録しました！');
    }

    /**
     * 商品詳細表示
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
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
        $product = Product::findOrFail($id);
        return view('product_purchase', compact('product')); // ビューがある場合
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