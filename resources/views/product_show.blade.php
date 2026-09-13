@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
    <h1 class="text-2xl font-bold mb-6">商品詳細</h1>

    <div class="bg-white rounded shadow p-6">
        <div class="mb-4">
            <span class="text-sm text-gray-500">商品番号: {{ $product->id }}</span>
            <h2 class="text-xl font-bold mt-1">{{ $product->name }}</h2>
        </div>

        <div class="mb<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'マイアプリ')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- ここに共通のヘッダーなどを置いてもOK -->

    <main class="container mx-auto p-6">
        <!-- 各ページの中身がここに埋め込まれます -->
        @yield('content')
    </main>

</body>
</html>-4">
            <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" class="w-48 h-48 object-cover rounded border">
        </div>

        <div class="mb-4">
            <p class="text-gray-700 whitespace-pre-wrap">{{ $product->description }}</p>
        </div>

        <div class="mb-6">
            <span class="text-lg font-bold text-blue-600">¥{{ number_format($product->price) }}</span>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">戻る</a>

            @auth
                @if ($product->likes->where('user_id', auth()->id())->isNotEmpty())
                    <form action="{{ route('likes.destroy', $product) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">お気に入り解除</button>
                    </form>
                @else
                    <form action="{{ route('likes.store', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600 transition">お気に入り登録</button>
                    </form>
                @endif
            @endauth
        </div>
    </div>
@endsection