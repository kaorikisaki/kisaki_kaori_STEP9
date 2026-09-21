<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800">
    <div class="max-w-4xl mx-auto px-6 py-12">
        <h1 class="text-2xl font-bold mb-8">商品登録</h1>

        <!-- バリデーションエラーの表示 -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>・{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 商品登録フォーム -->
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <!-- name から product_name に変更 -->
                <label for="product_name" class="block text-sm font-medium mb-1">商品名</label>
                <input type="text" id="product_name" name="product_name" value="{{ old('product_name') }}" class="w-full border border-gray-300 rounded px-3 py-2 bg-white" required>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium mb-1">価格</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" class="w-full border border-gray-300 rounded px-3 py-2 bg-white" required>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium mb-1">商品説明</label>
                <textarea id="description" name="description" rows="5" class="w-full border border-gray-300 rounded px-3 py-2 bg-white">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium mb-1">在庫数</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock') }}" class="w-full border border-gray-300 rounded px-3 py-2 bg-white">
            </div>

            <div class="flex items-center gap-4">
                <!-- image から img_path に変更 -->
                <label for="img_path" class="text-sm font-medium">商品画像</label>
                <input type="file" id="img_path" name="img_path" class="text-sm text-gray-500 file:mr-4 file:py-1.5 file:px-4 file:rounded file:border file:border-gray-300 file:text-sm file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
            </div>

            <div class="flex items-center gap-3 pt-4">
                <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-5 py-2 rounded text-sm hover:bg-gray-600">戻る</a>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded text-sm hover:bg-blue-700">登録</button>
            </div>
        </form>
    </div>
</body>
</html>