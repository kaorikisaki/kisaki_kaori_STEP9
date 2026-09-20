@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
    <h1 class="text-3xl font-bold mb-6">出品商品詳細</h1>

    <div class="bg-white rounded shadow p-6 max-w-2xl">
        <div class="mb-4">
            <h2 class="text-xl font-bold mb-2">商品名：{{ $product->name }}</h2>
            <p class="text-gray-700 whitespace-pre-wrap">説明：{{ $product->description }}</p>
        </div>

        <div class="mb-4">
            <span class="block mb-2">画像：</span>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" class="w-64 h-64 object-cover rounded border">
            @else
                <p class="text-gray-500">画像はありません</p>
            @endif
        </div>

        <div class="mb-6">
            <span class="text-xl font-bold">金額：¥{{ number_format($product->price) }}</span>
        </div>

        <div class="flex items-center space-x-4">
            <!-- 編集ボタン -->
            <a href="{{ route('products.edit', $product) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">編集</a>

            <!-- 削除ボタン -->
            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800 transition">削除する</button>
            </form>

            <!-- 戻るボタン -->
            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">戻る</a>
        </div>
    </div>
@endsection