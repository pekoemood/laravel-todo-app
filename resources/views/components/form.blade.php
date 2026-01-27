<div class="border p-2">
    <form action="/todos" method="POST">
        @csrf
        <div class="mt-2">
            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" placeholder="追加するtodoを入力" class="border px-2 block">
        </div>
        <div class="mt-2">
            <label for="description">内容</label>
            <input type="textarea" id="description" name="description" class="border px-2 block w-full h-20">
        </div>
        <button type="submit" class="mt-2 border px-2">追加</button>
    </form>
</div>
