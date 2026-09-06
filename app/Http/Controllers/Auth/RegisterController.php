<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // ユーザー登録画面の表示
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // ユーザー登録処理
    public function register(Request $request)
    {
        // 1. 入力値のバリデーション
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_kanji' => ['required', 'string', 'max:255'],
            'name_kana' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 2. データベースにユーザーを保存（company_idをここで紐付け）
        $user = User::create([
            'name' => $request->name,
            'name_kanji' => $request->name_kanji,
            'name_kana' => $request->name_kana,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_id' => 1, // ※画面に持たせないため、ここで固定のIDを設定します
        ]);

        // 3. ログインさせてリダイレクト
        Auth::login($user);

        return redirect('/')->with('success', 'ユーザー登録が完了しました！');
    }
}