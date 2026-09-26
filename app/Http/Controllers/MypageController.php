<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sale;
use App\Models\User;

class MypageController extends Controller
{
    /**
     * マイページを表示する
     */
    public function index()
    {
        $user = Auth::user();

        // ログインユーザーが出品した商品
        $products = $user->products()->latest()->get();

        // ログインユーザーの購入履歴（Saleモデルを経由して商品情報も一緒に取得）
        $sales = Sale::with('product')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('mypage', compact('user', 'products', 'sales'));
    }

    /**
     * アカウント編集画面を表示する
     */
    public function edit()
    {
        $user = Auth::user();
        return view('mypage_edit', compact('user')); // ビューのファイル名に合わせて適宜変更してください
    }

    /**
     * アカウント情報を更新する
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_kanji' => ['nullable', 'string', 'max:255'],
            'name_kana' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($validated);

        return redirect()->route('mypage.index')->with('success', 'アカウント情報を更新しました。');
    }
}