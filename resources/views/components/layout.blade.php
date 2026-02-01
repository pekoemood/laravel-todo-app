<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todoリスト</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow-sm">
            <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
                <a href="/" class="text-xl font-bold text-indigo-600 hover:text-indigo-700 transition-colors">
                    Todoアプリ
                </a>
                <div class="flex items-center gap-4">
                    @auth
                        <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-md transition-colors">
                                ログアウト
                            </button>
                        </form>
                    @else
                        <a href="/register" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-md transition-colors">
                            登録
                        </a>
                        <a href="/login" class="px-4 py-2 text-sm text-white bg-indigo-600 hover:bg-indigo-700 rounded-md transition-colors">
                            ログイン
                        </a>
                    @endauth
                </div>
            </nav>
        </header>

        <main class="flex-1 container mx-auto px-4 py-8">
            {{ $slot }}
        </main>

        <footer class="bg-white border-t border-gray-200">
            <div class="container mx-auto px-4 py-4 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Todoアプリ
            </div>
        </footer>
    </div>
</body>
</html>
