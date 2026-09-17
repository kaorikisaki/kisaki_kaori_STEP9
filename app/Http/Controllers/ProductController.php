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

        // 1. ログイン中のユーザー以外の商品に絞り込む
        if (Auth::check()) {
            $query->where('user_id', '!=', Auth::id());
        }

        // 2. キーワード検索（商品名）
        if ($keyword = $request->input('keyword')) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        // 3. 最低価格の絞り込み
        if ($min_price = $request->input('min_price')) {
            $query->where('price', '>=', $min_price);
        }

        // 4. 最高価格の絞り込み
        if ($max_price = $request->input('max_price')) {
            $query->where('price', '<=', $max_price);
        }

        // 5. 商品番号の昇順で並び替えて取得
        $products = $query->orderBy('id', 'asc')->get();

        return view('product_index', compact('products'));
    }

    public function show($id)
    {
        // 指定されたIDの商品を取得（見つからない場合は404エラー）
        $product = Product::findOrFail($id);

        return view('product_show', compact('product'));
    }

   // 6. 商品新規登録画面の表示
    public function create()
    {
        return view('product_create'); // 'product_create' に変更する
    }

    // 7. 商品の保存処理
    public function store(Request $request)
    {
        // バリデーション（入力チェック）
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'nullable',
        ]);

        // データベースへ保存（ログイン中のユーザーIDも紐付ける場合）
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'user_id' => Auth::id(), // ログインしていればユーザーIDも保存
        ]);

        return redirect()->route('products.index')->with('success', '商品を登録しました！');
    }
}