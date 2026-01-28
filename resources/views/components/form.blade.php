<div class="border p-2">
    <form action="/todos" method="POST">
        @csrf
        <div class="mt-2">
            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" placeholder="追加するtodoを入力" class="border px-2 block" value="{{ old('title') }}">
            @error('title')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-2">
            <label for="description">内容</label>
            <input type="textarea" id="description" name="description" class="border px-2 block w-full h-20" value="{{ old('description') }}">
            @error('description')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="mt-2 border px-2">追加</button>
    </form>
</div>
