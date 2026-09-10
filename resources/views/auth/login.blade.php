<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- 上部ヘッダー -->
    <header class="w-full py-6 px-12 flex justify-between items-center">
        <span class="text-xl text-gray-800">Laravel</span>
        <div class="space-x-6 text-sm text-gray-600">
            <!-- ルート名に変更 -->
            <a href="{{ route('login') }}" class="hover:underline">Login</a>
            <a href="{{ route('register') }}" class="hover:underline">Register</a>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="flex items-center justify-center flex-grow pb-24">
        <div class="bg-white rounded-lg shadow-sm border w-[800px] overflow-hidden">
            <!-- カードのタイトルバー -->
            <div class="bg-gray-50 px-6 py-3 border-b text-sm text-gray-700">
                Login
            </div>

            <div class="p-10">
                <!-- エラーメッセージの表示 -->
                @if ($errors->any())
                    <div class="mb-6 p-3 bg-red-100 text-red-700 rounded text-sm">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>・{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- フォームのアクションも route() に変更する場合はここ（POST /login なのでそのままでもOKです） -->
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="max-w-xl mx-auto">
                        <!-- Email Address -->
                        <div class="mb-5 flex items-center">
                            <label class="w-44 text-right pr-8 text-sm text-gray-700 flex-shrink-0" for="email">Email Address</label>
                            <input class="flex-1 px-3 py-2 border rounded text-sm focus:outline-none focus:ring focus:border-blue-300" 
                                    type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        </div>

                        <!-- Password -->
                        <div class="mb-5 flex items-center">
                            <label class="w-44 text-right pr-8 text-sm text-gray-700 flex-shrink-0" for="password">Password</label>
                            <input class="flex-1 px-3 py-2 border rounded text-sm focus:outline-none focus:ring focus:border-blue-300" 
                                    type="password" id="password" name="password" required>
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-6 flex pl-44">
                            <label class="flex items-center text-sm text-gray-600 cursor-pointer">
                                <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-300 mr-2">
                                Remember Me
                            </label>
                        </div>

                        <!-- ログインボタンとパスワード忘れリンク -->
                        <div class="flex items-center pl-44 space-x-4">
                            <button class="bg-blue-600 text-white text-sm font-medium py-2 px-6 rounded hover:bg-blue-700 transition duration-200" type="submit">
                                Login
                            </button>
                            <a href="/password/reset" class="text-sm text-blue-500 hover:underline">Forgot Your Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>