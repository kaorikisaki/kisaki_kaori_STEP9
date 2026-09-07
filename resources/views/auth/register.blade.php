<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規ユーザ登録画面</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- 上部ヘッダー -->
    <header class="w-full py-6 px-12 flex justify-between items-center">
        <span class="text-xl text-gray-800">Laravel</span>
        <div class="space-x-6 text-sm text-gray-600">
            <a href="/login" class="hover:underline">Login</a>
            <a href="/register" class="hover:underline">Register</a>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="flex items-center justify-center flex-grow pb-24">
        <div class="bg-white rounded-lg shadow-sm border w-[800px] overflow-hidden">
            <!-- カードのタイトルバー -->
            <div class="bg-gray-50 px-6 py-3 border-b text-sm text-gray-700">
                Register
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

                <form action="/register" method="POST">
                    @csrf

                    <!-- 800px幅の中で綺麗に収まるよう調整 -->
                    <div class="max-w-xl mx-auto">
                        <!-- Name（ユーザ名） -->
                        <div class="mb-5 flex items-center">
                            <label class="w-44 text-right pr-8 text-sm text-gray-700 flex-shrink-0" for="name">Name（ユーザ名）</label>
                            <input class="flex-1 px-3 py-2 border rounded text-sm focus:outline-none focus:ring focus:border-blue-300" 
                                    type="text" id="name" name="name" value="{{ old('name') }}" required>
                        </div>

                        <!-- 名前（漢字） -->
                        <div class="mb-5 flex items-center">
                            <label class="w-44 text-right pr-8 text-sm text-gray-700 flex-shrink-0" for="name_kanji">名前（漢字）</label>
                            <input class="flex-1 px-3 py-2 border rounded text-sm focus:outline-none focus:ring focus:border-blue-300" 
                                    type="text" id="name_kanji" name="name_kanji" value="{{ old('name_kanji') }}" required>
                        </div>

                        <!-- 名前（カナ） -->
                        <!-- 名前（カナ） -->
        <div class="mb-5 flex items-center">
            <label class="w-44 text-right pr-8 text-sm text-gray-700 flex-shrink-0" for="name_kana">名前（カナ）</label>
            <input class="flex-1 px-3 py-2 border rounded text-sm focus:outline-none focus:ring focus:border-blue-300" 
                    type="text" id="name_kana" name="name_kana" value="{{ old('name_kana') }}" required>
        </div>

                        <!-- Email Address -->
                        <div class="mb-5 flex items-center">
                            <label class="w-44 text-right pr-8 text-sm text-gray-700 flex-shrink-0" for="email">Email Address</label>
                            <input class="flex-1 px-3 py-2 border rounded text-sm focus:outline-none focus:ring focus:border-blue-300" 
                                    type="email" id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-5 flex items-center">
                            <label class="w-44 text-right pr-8 text-sm text-gray-700 flex-shrink-0" for="password">Password</label>
                            <input class="flex-1 px-3 py-2 border rounded text-sm focus:outline-none focus:ring focus:border-blue-300" 
                                    type="password" id="password" name="password" required>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-6 flex items-center">
                            <label class="w-44 text-right pr-8 text-sm text-gray-700 flex-shrink-0" for="password_confirmation">Confirm Password</label>
                            <input class="flex-1 px-3 py-2 border rounded text-sm focus:outline-none focus:ring focus:border-blue-300" 
                                    type="password" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <!-- 登録ボタン -->
                        <div class="flex pl-44">
                            <button class="bg-blue-600 text-white text-sm font-medium py-2 px-6 rounded hover:bg-blue-700 transition duration-200" type="submit">
                                Register
                            </button> 
                        </div>
                    </div>
                </form>
            </div>
        </div> 
    </main>
</body>
</html>