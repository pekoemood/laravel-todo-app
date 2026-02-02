<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    public function index(Request $request): View
    {
        $todos = $request->user()->todos()->get();

        return view('components.todo', compact('todos'));
    }

    public function store(StoreTodoRequest $request): RedirectResponse
    {
        $request->user()->todos()->create($request->validated());

        return redirect()->route('todo.index');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect('/');
    }

    public function update(Request $request, Todo $todo)
    {
        $validated = $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required', 'max:255'],
        ]);

        $todo->title = $validated['title'];
        $todo->description = $validated['description'];
        $todo->save();

        return redirect('/');
    }

    public function toggle(Request $request, Todo $todo)
    {
        $todo->update([
            'is_complete' => $request->is_complete,
        ]);

        return response()->json(['success' => true]);
    }
}
