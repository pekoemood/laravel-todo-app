<x-layout>
    <x-form />
    <div class="mt-6">
        @forelse ($todos as $todo )
        <div class="mt-4">
            <div class="flex items-center gap-4">
                <label for="is_complete">
                    {{ $todo['title'] }}
                </label>
                <input type="checkbox" name="is_complete" id="is_complete">
            </div>
            <p>{{ $todo['description'] }}</p>
            <div class="flex gap-2">
                <button class="border px-2">編集</button>
                <form action="/todos/{{ $todo->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border px-2">削除</button>
                </form>

            </div>
        </div>
        @empty
        <p>Todoがありません</p>
        @endforelse
    </div>
</x-layout>
