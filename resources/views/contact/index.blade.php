@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-6">
    <h2 class="text-3xl font-bold mb-6">お問い合わせフォーム</h2>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.store') }}">
        @csrf

        <!-- 名前 -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 mb-2">名前</label>
            <input id="name" type="text" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" name="name" required autofocus>
        </div>

        <!-- メールアドレス -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 mb-2">メールアドレス</label>
            <input id="email" type="email" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" name="email" required>
        </div>

        <!-- お問い合わせ内容 -->
        <div class="mb-6">
            <label for="message" class="block text-gray-700 mb-2">お問い合わせ内容</label>
            <textarea id="message" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" name="message" rows="6" required></textarea>
        </div>

        <!-- 送信・戻るボタン -->
        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">
                送信
            </button>
            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 transition">
                戻る
            </a>
        </div>
    </form>
</div>
@endsection