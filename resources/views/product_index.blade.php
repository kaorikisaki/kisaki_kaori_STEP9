<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="max-w-7xl mx-auto px-6 py-8">
        <h1 class="text-2xl font-bold mb-6">商品一覧</h1>

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
                        <td class="py-3 px-4">{{ $product->name }}</td>
                        <td class="py-3 px-4">{{ $product->description }}</td>
                        <td class="py-3 px-4">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" class="w-12 h-12 object-cover">
                        </td>
                        <td class="py-3 px-4">{{ number_format($product->price) }}</td>
                        <td class="py-3 px-4">
                            <a href="{{ route('products.show', $product->id) }}" class="bg-emerald-600 text-white px-4 py-1.5 rounded text-sm hover:bg-emerald-700 transition">詳細</a>
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
    </div>

</body>
</html>