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
        <h1 class="text-4xl text-center mt-6">Todoリスト</h1>
        <div>
            {{ $slot }}
        </div>
    </main>
</body>
</html>
