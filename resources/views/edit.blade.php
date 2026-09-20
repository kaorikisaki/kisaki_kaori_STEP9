@extends('layouts.app')

@section('title', '出品商品編集')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-sm">
        
        <!-- タイトル -->
        <h1 class="text-2xl font-bold mb-6">出品商品編集</h1>

        <!-- バリデーションエラー表示 -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 成功メッセージ表示 -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-600 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- 更新用フォーム -->
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- 商品名 -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">商品名</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- 価格 -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">価格</label>
                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- 商品説明 -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">商品説明</label>
                <textarea id="description" name="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- 在庫数 -->
            <div class="mb-4">
                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">在庫数</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- 商品画像 -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">商品画像</label>
                <input type="file" id="image" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <!-- ボタンエリア -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('products.show', $product->id) }}" class="bg-gray-500 text-white text-sm px-4 py-2 rounded hover:bg-gray-600 transition">
                    戻る
                </a>
                <button type="submit" class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700 transition">
                    更新
                </button>
            </div>
        </form>

    </div>
@endsection