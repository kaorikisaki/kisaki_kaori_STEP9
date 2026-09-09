<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MypageController; 

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

// マイページ画面の表示（ログイン必須）
Route::get('/mypage', [MypageController::class, 'index'])->middleware('auth')->name('mypage');

// アカウント編集画面の表示
Route::get('/mypage/edit', [MypageController::class, 'edit'])->middleware('auth')->name('mypage.edit');

// アカウント情報の更新処理
Route::patch('/mypage/update', [MypageController::class, 'update'])->middleware('auth')->name('mypage.update');
