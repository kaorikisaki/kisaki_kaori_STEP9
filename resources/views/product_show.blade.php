<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="max-w-4xl mx-auto px-6 py-8">
        <h1 class="text-2xl font-bold mb-6">商品詳細</h1>

        <div class="bg-white rounded shadow p-6">
            <div class="mb-4">
                <span class="text-sm text-gray-500">商品番号: {{ $product->id }}</span>
                <h2 class="text-xl font-bold mt-1">{{ $product->name }}</h2>
            </div>

            <div class="mb-4">
                <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" class="w-48 h-48 object-cover rounded border">
            </div>

            <div class="mb-4">
                <p class="text-gray-700 whitespace-pre-wrap">{{ $product->description }}</p>
            </div>

            <div class="mb-6">
                <span class="text-lg font-bold text-blue-600">¥{{ number_format($product->price) }}</span>
            </div>

            <div>
                <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">戻る</a>
            </div>
        </div>
    </div>

</body>
</html>
