<x-layout>
    <h1 class="text-4xl text-center my-6">Todoリスト</h1>
    <x-form />
    <div class="mt-6">
        @forelse ($todos as $todo )
        <div class="mt-4" data-todo-id="{{ $todo->id }}">
            <div class="view-mode">
                <div class="flex items-center gap-4">
                    <label for="todo-{{ $todo->id }}" class="{{ $todo->is_complete ? 'line-through text-gray-400' : '' }}">
                        {{ $todo->title }}
                    </label>
                    <input type="checkbox" name="is_complete" id="todo-{{ $todo->id }}" {{ $todo->is_complete ? 'checked' : '' }}
                    onchange="toggleComplete({{ $todo->id }}, this.checked)">
                </div>
                <p>{{ $todo->description }}</p>
                <div class="flex gap-2 mt-2">
                    <button class="border px-2 edit-btn" onclick="enterEditMode({{ $todo->id }})">編集</button>
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border px-2" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                </div>
            </div>

            <form action="{{ route('todos.update', $todo) }}" method="POST" class="edit-mode hidden">
                @csrf
                @method('PUT')
                <div class="space-y-2">
                    <input
                        type="text"
                        name="title"
                        class="border px-2 py-1 w-full"
                        value="{{ $todo->title }}"
                        >
                    <textarea name="description" rows="3" class="border px-2 py-1 w-full">{{ $todo->description }}</textarea>
                    <div class="flex gap-2">
                        <button type="submit" class="border px-2 py-1 bg-blue-500 text-white">保存</button>
                        <button type="button" class="border px-2 py-1 cancel-btn" onclick="cancelEdit({{ $todo->id }})">キャンセル</button>
                    </div>
                </div>
            </form>
        </div>

        @empty
        <p>Todoがありません</p>
        @endforelse
    </div>

    <script>
        function enterEditMode(todoId) {
            const todoItem = document.querySelector(`[data-todo-id="${todoId}"]`);
            todoItem.querySelector('.view-mode').classList.add('hidden');
            todoItem.querySelector('.edit-mode').classList.remove('hidden');
        }

        function cancelEdit(todoId) {
            const todoItem = document.querySelector(`[data-todo-id="${todoId}"]`);
            todoItem.querySelector('.edit-mode').classList.add('hidden');
            todoItem.querySelector('.view-mode').classList.remove('hidden');
        }

        function toggleComplete(todoId, isComplete) {
            const label = document.querySelector(`label[for="todo-${todoId}"]`);
            if (isComplete) {
                label.classList.add('line-through', 'text-gray-400');
            } else {
                label.classList.remove('line-through', 'text-gray-400');
            }

            fetch(`/todos/${todoId}/toggle`, {
                method: 'PATCH',
                headers: {
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ is_complete: isComplete })
            })
            .then((response) => {
                if (!response.ok) alert('通信エラーが発生しました');
            });
        }
    </script>


</x-layout>
