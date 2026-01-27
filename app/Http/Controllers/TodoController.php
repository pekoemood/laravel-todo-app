<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request) {
        $todos = Todo::all();
        return view('components.todo', compact('todos'));
    }

    public function store(Request $request): RedirectResponse {
        $title = $request->input('title');
        $description = $request->input('description');

        // $todo = new Todo();
        // $todo->title = $title;
        // $todo->description = $description;
        // $todo->save();

        Todo::create([
            'title' => $title,
            'description' => $description
        ]);

        return redirect('/');
    }

    public function destroy(Request $request, int $id) {
        Todo::destroy($id);
        return redirect('/');
    }
}
