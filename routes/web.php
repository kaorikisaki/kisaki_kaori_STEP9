<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

// ログイン画面の表示
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// ログイン処理
Route::post('/login', [LoginController::class, 'login']);

// ユーザー登録画面の表示
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// ユーザー登録処理の実行
Route::post('/register', [RegisterController::class, 'register']);