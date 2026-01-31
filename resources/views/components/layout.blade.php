<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todoリスト</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="min-h-screen flex flex-col container mx-auto">
        <nav class="py-2 mt-4 flex justify-between">
            <div>Todoアプリ</div>
            <div class="flex gap-4">
                @auth
                    <p>{{ auth()->user()->name }}</p>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                @else
                    <a href="/register">登録画面</a>
                    <a href="/login">ログイン画面</a>
                @endauth
            </div>
        </nav>
        {{ $slot }}
    </main>
</body>
</html>
