<?php

use App\Http\Controllers\Register;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [TodoController::class, 'index'])->name('todo.index');
Route::post('/todos', [TodoController::class, 'store']);
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
Route::put('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');
Route::patch('/todos/{todo}/toggle', [TodoController::class, 'toggle']);


Route::view('/register', 'components.register');
Route::post('/register', Register::class);
