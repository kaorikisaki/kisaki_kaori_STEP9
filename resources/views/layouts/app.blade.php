<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Cytech EC')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col justify-between">

    <!-- ヘッダー -->
    <header class="bg-white border-b shadow-sm py-4">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <!-- 左側: アプリ名 -->
            <div class="text-xl font-bold">
                <a href="{{ route('products.index') }}">Cytech EC</a>
            </div>

            <!-- 右側: メニュー、ユーザー名、ログアウト -->
            <div class="flex items-center gap-6 text-sm">
                <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">Home</a>
                <a href="{{ route('mypage') }}" class="text-blue-600 hover:underline">マイページ</a>
                <span>ログインユーザー: TTUU</span>
                <a href="#" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition inline-block">
                    ログアウト
                </a>
            </div>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="container mx-auto p-6 flex-grow">
        @yield('content')
    </main>

    <!-- フッター -->
    <footer class="bg-white border-t py-6 mt-10">
        <div class="container mx-auto text-center flex flex-col items-center gap-4">
            <!-- お問い合わせボタン -->
            <div>
                <a href="{{ route('contact.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded shadow hover:bg-blue-600 transition">
                    お問い合わせ
                </a>
            </div>

            <!-- リンク -->
            <div class="flex gap-6 text-sm">
                <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">Home</a>
                <a href="{{ route('mypage') }}" class="text-blue-600 hover:underline">マイページ</a>
            </div>

            <!-- コピーライト -->
            <div class="text-xs text-gray-500">
                &copy; 2024 Company, Inc
            </div>
        </div>
    </footer>

</body>
</html>