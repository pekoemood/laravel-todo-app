<x-layout>
    <div class="flex min-h-screen items-center justify-center">
        <div class="border p-8 w-96">
            <h1 class="text-center text-2xl mb-4 font-bold">ログイン</h1>
            <form action="/login" method="POST">
            @csrf
            <div>
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" placeholder="test@gmail.com" required class="block border w-full mt-2" value="{{ old('email') }}">
            </div>

            <div>
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" placeholder="******" required class="block border w-full mt-2" value="{{ old('password') }}">
            </div>

            <button type="submit" class="mt-2 border px-2 rounded-md bg-blue-500 text-white">登録</button>
        </form>
        </div>
    </div>
</x-layout>

