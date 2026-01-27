<div>
    <h1>Todoリスト</h1>

    <div>
        <form action="/todo" method="POST">
        @csrf
        <div>
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title">
        </div>
        <div>
            <label for="description">内容</label>
            <input type="text" name="description" id="description">
        </div>
    </form>
    </div>


    @forelse ($todos as $todo )
    <div>
        <p>{{ $todo['title'] }}</p>
        <span>{{ $todo['description'] }}</span>
        <input type="checkbox" @checked($todo->is_complete) >
    </div>

    @empty
        <p>Todoがひとつもありません</p>
    @endforelse
</div>
