@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-sm">
        
        <!-- タイトル -->
        <h1 class="text-2xl font-bold mb-6">マイページ</h1>

        <!-- アカウント編集ボタン -->
        <div class="mb-6">
            <a href="{{ route('mypage.edit') }}" class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700 transition">
                アカウント編集
            </a>
        </div>

        <!-- ユーザー情報エリア -->
        <div class="flex justify-between items-start mb-10 text-sm text-gray-700 border-b pb-6">
            <div class="space-y-2">
                <p><strong>ユーザ名：</strong> {{ $user->name }}</p>
                <p><strong>Eメール：</strong> {{ $user->email }}</p>
            </div>
            <div class="space-y-2 text-right">
                <p><strong>名前：</strong> {{ $user->name_kanji ?? '未登録' }}</p>
                <p><strong>カナ：</strong> {{ $user->name_kana ?? '未登録' }}</p>
            </div>
        </div>

        <!-- 出品商品セクション -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold">&lt;出品商品&gt;</h2>
                <!-- 新規登録ボタン -->
                <a href="{{ route('products.create') }}" class="bg-blue-600 text-white text-xs px-3 py-1.5 rounded hover:bg-blue-700 transition">
                    新規登録
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="border-b text-gray-600">
                            <th class="py-3 px-4">商品番号</th>
                            <th class="py-3 px-4">商品名</th>
                            <th class="py-3 px-4">商品説明</th>
                            <th class="py-3 px-4">料金(¥)</th>
                            <th class="py-3 px-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $product)
                            <tr>
                                <td class="py-4 px-4">{{ $product->id }}</td>
                                <td class="py-4 px-4">{{ $product->product_name }}</td>
                                <td class="py-4 px-4">{{ $product->description }}</td>
                                <td class="py-4 px-4">{{ number_format($product->price) }}</td>
                                <td class="py-4 px-4 text-right">
                                    <a href="{{ route('products.show', $product->id) }}" class="bg-emerald-600 text-white text-xs px-3 py-1 rounded hover:bg-emerald-700 transition">詳細</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 px-4 text-center text-gray-500">出品した商品はありません。</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 購入した商品セクション -->
        <div class="mb-8">
            <h2 class="text-lg font-bold mb-4">&lt;購入した商品&gt;</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="border-b text-gray-600">
                            <th class="py-3 px-4">商品名</th>
                            <th class="py-3 px-4">商品説明</th>
                            <th class="py-3 px-4">料金(¥)</th>
                            <th class="py-3 px-4">個数</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        {{-- コントローラーから渡される購入履歴（sales）をループ処理 --}}
                        @forelse($sales ?? [] as $sale)
                            <tr>
                                <td class="py-4 px-4">{{ $sale->product->product_name ?? '不明な商品' }}</td>
                                <td class="py-4 px-4">{{ $sale->product->description ?? '' }}</td>
                                <td class="py-4 px-4">{{ number_format($sale->product->price ?? 0) }}</td>
                                <td class="py-4 px-4">{{ $sale->quantity }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 px-4 text-center text-gray-500">購入した商品はありません。</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- トップページへ戻る -->
        <div class="mt-8 pt-4 border-t">
            <a href="{{ url('/') }}" class="text-blue-600 hover:underline text-sm">トップページへ戻る</a>
        </div>

    </div>
@endsection