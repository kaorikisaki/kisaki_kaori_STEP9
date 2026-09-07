<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product; // 追加：Productモデルのインポート

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
}