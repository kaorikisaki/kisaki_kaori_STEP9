<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント編集画面</title>
    <!-- Tailwind CSSの読み込み -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen p-8">
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-lg shadow-sm">
        
        <!-- タイトル -->
        <h1 class="text-2xl font-bold mb-6">アカウント情報編集</h1>

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
        <form action="{{ route('mypage.update') }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- ユーザ名 -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">ユーザ名</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Eメール -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Eメール</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- 名前（漢字など） -->
            <div class="mb-4">
                <label for="name_kanji" class="block text-sm font-medium text-gray-700 mb-1">名前</label>
                <input type="text" id="name_kanji" name="name_kanji" value="{{ old('name_kanji', $user->name_kanji ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- カナ -->
            <div class="mb-6">
                <label for="name_kana" class="block text-sm font-medium text-gray-700 mb-1">カナ</label>
                <input type="text" id="name_kana" name="name_kana" value="{{ old('name_kana', $user->name_kana ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- ボタンエリア -->
            <div class="flex items-center space-x-4">
                <a href="{{ url('/mypage') }}" class="bg-gray-500 text-white text-sm px-4 py-2 rounded hover:bg-gray-600 transition">
                    戻る
                </a>
                <button type="submit" class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700 transition">
                    更新
                </button>
            </div>
        </form>

    </div>
</body>
</html>