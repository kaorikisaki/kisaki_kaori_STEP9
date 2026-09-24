@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
    <h1 class="text-2xl font-bold mb-6">商品一覧</h1>

    {{-- 購入成功時のメッセージ表示 --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('products.index') }}" method="GET" class="mb-6 inline-flex items-center gap-4">
        <input type="text" name="keyword" placeholder="商品名を入力" value="{{ request('keyword') }}" class="border border-gray-300 rounded px-3 py-2 w-72">
        
        <div class="flex items-center gap-2">
            <input type="number" name="min_price" placeholder="最低価格" value="{{ request('min_price') }}" class="border border-gray-300 rounded px-3 py-2 w-28">
            <span>～</span>
            <input type="number" name="max_price" placeholder="最高価格" value="{{ request('max_price') }}" class="border border-gray-300 rounded px-3 py-2 w-28">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">検索</button>
    </form>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b text-sm text-gray-700">
                    <th class="py-3 px-4 font-semibold">商品番号</th>
                    <th class="py-3 px-4 font-semibold">商品名</th>
                    <th class="py-3 px-4 font-semibold">商品説明</th>
                    <th class="py-3 px-4 font-semibold">画像</th>
                    <th class="py-3 px-4 font-semibold">料金(¥)</th>
                    <th class="py-3 px-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($products as $product)
                <tr>
                    <td class="py-3 px-4">{{ $product->id }}</td>
                    <td class="py-3 px-4">{{ $product->product_name }}</td>
                    <td class="py-3 px-4">{{ $product->description }}</td>
                    <td class="py-3 px-4">
                        <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" class="w-12 h-12 object-cover">
                    </td>
                    <td class="py-3 px-4">{{ number_format($product->price) }}</td>
                    <td class="py-3 px-4">
                        @if(Auth::check() && $product->user_id === Auth::id())
                            {{-- 自分の出品した商品の場合は、詳細/編集画面へ --}}
                            <a href="{{ route('products.show', $product->id) }}" class="bg-emerald-600 text-white px-4 py-1.5 rounded text-sm hover:bg-emerald-700 transition">詳細</a>
                        @else
                            {{-- 他人の商品の場合は、購入画面へ --}}
                            <a href="{{ route('products.purchase', $product->id) }}" class="bg-blue-600 text-white px-4 py-1.5 rounded text-sm hover:bg-blue-700 transition">購入画面へ</a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-6 text-center text-gray-500">該当する商品がございません。</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection