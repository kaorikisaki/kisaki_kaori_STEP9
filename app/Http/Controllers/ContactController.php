<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // お問い合わせ画面を表示する
    public function index()
    {
        return view('contact.index');
    }

    // お問い合わせデータを受け取って処理する
    public function store(Request $request)
    {
        // 入力値のバリデーション（チェック）
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ]);

        // 送信完了メッセージとともに、お問い合わせ画面に戻す
        return redirect()->route('contact.index')->with('success', 'お問い合わせを送信しました。');
    }
}