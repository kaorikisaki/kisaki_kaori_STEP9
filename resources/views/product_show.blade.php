@extends('layouts.app')

{{-- ログインユーザーによってページのタイトルを動的に変更する --}}
@section('title', $product->user_id === Auth::id() ? '出品商品詳細' : '商品詳細')

@section('content')
    {{-- ログインユーザーによって見出しを切り替える --}}
    @if ($product->user_id === Auth::id())
        <h1 class="text-3xl font-bold mb-6">出品商品詳細</h1>
    @else
        <h1 class="text-3xl font-bold mb-6">商品詳細</h1>
    @endif

    <div class="bg-white rounded shadow p-6 max-w-2xl">
        <div class="mb-4">
            <h2 class="text-xl font-bold mb-2">商品名：{{ $product->product_name }}</h2>
            <p class="text-gray-700 whitespace-pre-wrap">説明：{{ $product->description }}</p>
        </div>

        <div class="mb-4">
            <span class="block mb-2">画像：</span>
            @if ($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" class="w-64 h-64 object-cover rounded border">
            @else
                <p class="text-gray-500">画像はありません</p>
            @endif
        </div>

        <div class="mb-6">
            <span class="text-xl font-bold">金額：¥{{ number_format($product->price) }}</span>
            <p class="text-sm text-gray-600 mt-1">在庫数：{{ $product->stock }}</p>
            <p class="text-sm text-gray-700 mt-1">会社：{{ $product->company->company_name ?? '未設定' }}</p>
        </div>

        {{-- 教材に合わせたハートマークの表示（他人の商品の場合） --}}
        @if ($product->user_id !== Auth::id())
            <div class="mb-6">
                <span class="text-2xl cursor-pointer">❤️</span>
            </div>
        @endif

        <div class="flex items-center space-x-4">
            {{-- ログインユーザーが「出品者」の場合：編集・削除ボタンを表示 --}}
            @if ($product->user_id === Auth::id())
                <!-- 編集ボタン -->
                <a href="{{ route('products.edit', $product) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">編集</a>

                <!-- 削除ボタン -->
                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800 transition">削除する</button>
                </form>
            
            {{-- ログインユーザーが「他人（購入者）」の場合：カートに追加するボタンを表示 --}}
            @else
                <a href="{{ route('products.purchase', $product->id) }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition font-semibold">カートに追加する</a>
            @endif

            <!-- 戻るボタン -->
            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">戻る</a>
        </div>
    </div>
@endsection