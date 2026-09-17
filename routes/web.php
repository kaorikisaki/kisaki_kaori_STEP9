<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MypageController; 
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LikeController;

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

// 商品一覧画面の表示
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// ★【重要】{id} よりも上に /products/create を配置する！
// 商品新規登録画面の表示
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// 商品の保存処理
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// 商品詳細画面の表示
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// お気に入り登録・解除
Route::middleware('auth')->group(function () {
    Route::post('/products/{product}/like', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/products/{product}/like', [LikeController::class, 'destroy'])->name('likes.destroy');
});