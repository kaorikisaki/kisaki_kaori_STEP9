<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'マイアプリ')</title>
    
    <!-- ▼ ここにTailwind CSSのCDNを追加する -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>
<body class="bg-gray-100 text-gray-900">

    <main class="container mx-auto p-6">
        @yield('content')
    </main>

</body>
</html>