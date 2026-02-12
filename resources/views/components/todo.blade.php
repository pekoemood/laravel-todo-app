<x-layout>
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Todoリスト</h1>

        <x-form />

        <div class="mt-8 space-y-4">
            @forelse ($todos as $todo)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4" data-todo-id="{{ $todo->id }}">
                    <div class="view-mode">
                        <div class="flex items-start gap-3">
                            <input
                                type="checkbox"
                                name="is_complete"
                                id="todo-{{ $todo->id }}"
                                class="mt-1 h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer"
                                {{ $todo->is_complete ? 'checked' : '' }}
                                onchange="toggleComplete({{ $todo->id }}, this.checked)"
                            >
                            <div class="flex-1 min-w-0">
                                <label
                                    for="todo-{{ $todo->id }}"
                                    class="block text-lg font-medium cursor-pointer {{ $todo->is_complete ? 'line-through text-gray-400' : 'text-gray-900' }}"
                                >
                                    {{ $todo->title }}
                                </label>
                                @if($todo->description)
                                    <p class="mt-1 text-sm {{ $todo->is_complete ? 'text-gray-300' : 'text-gray-600' }}">
                                        {{ $todo->description }}
                                    </p>
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <span>期日</span>
                                <span>{{ $todo->due_date?->format('Y/m/d') ?? '未設定' }}</span>
                            </div>
                        </div>
                        <div class="flex gap-2 mt-4 pt-3 border-t border-gray-100">
                            <button
                                type="button"
                                class="px-3 py-1.5 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-md transition-colors"
                                onclick="enterEditMode({{ $todo->id }})"
                            >
                                編集
                            </button>
                            <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="px-3 py-1.5 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 rounded-md transition-colors"
                                    onclick="return confirm('本当に削除しますか？')"
                                >
                                    削除
                                </button>
                            </form>
                        </div>
                    </div>

                    <form action="{{ route('todos.update', $todo) }}" method="POST" class="edit-mode hidden">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <label for="edit-title-{{ $todo->id }}" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
                                <input
                                    type="text"
                                    name="title"
                                    id="edit-title-{{ $todo->id }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    value="{{ $todo->title }}"
                                >
                            </div>
                            <div>
                                <label for="edit-desc-{{ $todo->id }}" class="block text-sm font-medium text-gray-700 mb-1">説明</label>
                                <textarea
                                    name="description"
                                    id="edit-desc-{{ $todo->id }}"
                                    rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                >{{ $todo->description }}</textarea>
                            </div>
                            <div class="flex gap-2 pt-2">
                                <button
                                    type="submit"
                                    class="px-4 py-2 text-sm text-white bg-indigo-600 hover:bg-indigo-700 rounded-md transition-colors"
                                >
                                    保存
                                </button>
                                <button
                                    type="button"
                                    class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-md transition-colors"
                                    onclick="cancelEdit({{ $todo->id }})"
                                >
                                    キャンセル
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-500">Todoがありません</p>
                    <p class="text-sm text-gray-400 mt-1">上のフォームから新しいTodoを追加してください</p>
                </div>
            @endforelse
        </div>
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
