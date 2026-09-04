<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン画面</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <div>
            <label>メールアドレス:</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label>パスワード:</label><br>
            <input type="password" name="password" required>
        </div>
        <button type="submit">ログイン</button>
    </form>
</body>
</html>