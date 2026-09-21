@extends('layouts.app')

@section('title', '購入画面')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">購入画面</h1>

    {{-- エラーメッセージの表示 --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 商品名と説明（name から product_name に変更） --}}
    <div class="mb-4 space-y-1">
        <p class="text-lg text-gray-800">商品名：{{ $product->product_name }}</p>
        <p class="text-lg text-gray-600">説明：{{ $product->description }}</p>
    </div>

    {{-- 商品画像（image から img_path に変更） --}}
    <div class="mb-6">
        <span class="block mb-2 text-gray-700">画像：</span>
        @if ($product->img_path)
            <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" class="w-64 h-64 object-cover rounded border mx-auto">
        @else
            <p class="text-gray-500">画像はありません</p>
        @endif
    </div>

    {{-- 購入フォーム --}}
    <form action="{{ route('products.buy', $product->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock ?? 10 }}" class="border border-gray-300 rounded px-3 py-2 w-32 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-6 space-y-2">
            <p class="text-lg text-gray-800">金額：¥{{ number_format($product->price) }}</p>
            <p class="text-lg text-gray-800">残り：{{ $product->stock ?? '' }}</p>
            <p class="text-lg text-gray-800">会社：{{ $product->company ?? 'TNG' }}</p>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">購入する</button>
            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 transition">戻る</a>
        </div>
    </form>
</div>
@endsection