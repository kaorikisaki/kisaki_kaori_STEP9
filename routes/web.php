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

Route::get('/home', function () {
    return redirect()->route('products.index');
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

// --- 商品関連のルート ---
// 一覧画面
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// 新規登録画面（※ {id} などの変数ルートより上にする必要があります）
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// 編集画面
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

// 保存処理
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// 更新処理
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

// 削除処理
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// 詳細画面（※ /products/create や /products/{product}/edit よりも下に置くのが鉄則です）
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// お気に入り登録・解除
Route::middleware('auth')->group(function () {
    Route::post('/products/{product}/like', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/products/{product}/like', [LikeController::class, 'destroy'])->name('likes.destroy');
});

// --- 商品購入関連のルート ---
// 購入画面の表示
Route::get('/products/{product}/purchase', [ProductController::class, 'purchase'])->middleware('auth')->name('products.purchase');

// 購入処理の実行
Route::post('/products/{product}/purchase', [ProductController::class, 'buy'])->middleware('auth')->name('products.buy');