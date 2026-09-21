<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // クエリの初期化
        $query = Product::query();

        // ログイン中のユーザー以外の商品に絞り込む
        if (Auth::check()) {
            $query->where('user_id', '!=', Auth::id());
        }

        // キーワード検索（product_nameに変更）
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

        // 商品番号の昇順で並び替えて取得
        $products = $query->orderBy('id', 'asc')->get();

        return view('product_index', compact('products'));
    }

    public function show($id)
    {
        // 指定されたIDの商品を取得（見つからない場合は404エラー）
        $product = Product::findOrFail($id);

        return view('product_show', compact('product'));
    }

    // 商品新規登録画面の表示
    public function create()
    {
        return view('product_create');
    }

    // 商品の保存処理
    public function store(Request $request)
    {
        // バリデーション（入力チェック）- product_nameに変更
        $request->validate([
            'product_name' => 'required|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0', // 在庫数もバリデーションに含めると安心です
            'description' => 'nullable',
            // 'img_path' => 'nullable|image|max:2048', // 画像を使う場合は追加
        ]);

        // データベースへ保存（product_nameに変更）
        Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->input('stock', 0),
            'description' => $request->description,
            'user_id' => Auth::id(), // ログインしていればユーザーIDも保存
            // 'img_path' => $path, // 画像保存処理の実装に合わせて調整
        ]);

        return redirect()->route('products.index')->with('success', '商品を登録しました！');
    }

    /**
     * 商品編集画面を表示する
     */
    public function edit(Product $product)
    {
        return view('edit', compact('product'));
    }

    /**
     * 商品情報を更新する
     */
    public function update(Request $request, Product $product)
    {
        // バリデーション - product_nameに変更
        $request->validate([
            'product_name' => 'required|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable',
        ]);

        // データの更新 - product_nameに変更
        $product->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        return redirect()->route('products.show', $product->id)->with('success', '商品を更新しました！');
    }

    /**
     * 商品購入画面を表示する
     */
    public function purchase(Product $product)
    {
        return view('product_purchase', compact('product'));
    }

    /**
     * 購入処理を実行する（在庫の減算 & 購入履歴の保存）
     */
    public function buy(Request $request, Product $product)
    {
        // バリデーション（入力された数量が在庫数を超えていないかなど）
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        // sales テーブルに購入履歴を保存
        \App\Models\Sale::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
        ]);

        // products テーブルの在庫数（stock）を減らす
        $product->stock -= $request->quantity;
        $product->save();

        return redirect()->route('products.index')->with('success', '商品を購入しました！');
    }
}