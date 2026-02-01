<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h2 class="text-lg font-semibold text-gray-900 mb-4">新しいTodoを追加</h2>
    <form action="/todos" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                タイトル <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                id="title"
                name="title"
                placeholder="例：買い物に行く"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror"
                value="{{ old('title') }}"
            >
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                説明
            </label>
            <textarea
                id="description"
                name="description"
                rows="3"
                placeholder="詳細を入力（任意）"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror"
            >{{ old('description') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <button
            type="submit"
            class="w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
            追加する
        </button>
    </form>
</div>
