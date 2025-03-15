<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TarefaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tarefas', [TarefaController::class, 'index'])->name('tarefas.index');
    Route::post('/tarefas', [TarefaController::class, 'store'])->name('tarefas.store');
    Route::put('/tarefas/{tarefa:slug}', [TarefaController::class, 'update'])->name('tarefas.update');
    Route::put('/tarefas/{tarefa:slug}', [TarefaController::class, 'concluir'])->name('tarefas.concluir');
    Route::delete('/tarefas/{tarefa:slug}', [TarefaController::class, 'delete'])->name('tarefas.delete');
});

require __DIR__ . '/auth.php';
