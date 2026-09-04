<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // ログイン画面を表示する
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ログイン処理を実行する
    public function login(Request $request)
    {
        // 入力値のバリデーション
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 認証を試みる
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // ログイン成功時はウェルカムページやマイページへリダイレクト
            return redirect()->intended('/');
        }

        // 認証失敗時の処理
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->onlyInput('email');
    }
}