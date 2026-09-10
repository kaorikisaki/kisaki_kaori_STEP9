<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class MypageController extends Controller
{
    /**
     * マイページ画面の表示
     */
    public function index()
    {
        // 現在ログインしているユーザー情報を取得
        $user = Auth::user();

        // ログインユーザーが出品した商品データを取得
        $products = Product::where('user_id', $user->id)->get();

        // ビューにユーザー情報と商品データを一緒に渡す
        return view('mypage', compact('user', 'products'));
    }

    /**
     * アカウント編集画面を表示する
     */
    public function edit()
    {
        $user = Auth::user();
        
        // ※もしビューファイル名もスネークケース/規約に合わせる場合は
        // 'edit' を 'mypage_edit' などに変更するとより綺麗に統一できます。
        return view('edit', compact('user'));
    }

    /**
     * アカウント情報を更新する
     */
    public function update(Request $request)
    {
        // 複数単語の変数名にする場合はスネークケース（$validated_data など）にするのが規約に合致します
        $validated_data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
        ]);

        $user = Auth::user();
        $user->update($validated_data);

        return redirect()->route('mypage')->with('success', 'アカウント情報を更新しました。');
    }
}