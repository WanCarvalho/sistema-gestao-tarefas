<?php

use App\Http\Controllers\TarefaController;
use Illuminate\Support\Facades\Route;

Route::prefix('tarefas')->controller(TarefaController::class)->group(function () {
    Route::get('/', 'index')->name('tarefas.index');
    Route::get('/create', 'create')->name('tarefas.create');
    Route::get('edit', 'edit')->name('tarefas.edit');
    Route::post('/', 'store')->name('tarefas.store');
    Route::put('/{tarefa:slug}', 'update')->name('tarefas.update');
    Route::put('/{tarefa:slug}', 'concluir')->name('tarefas.concluir');
    Route::delete('/{tarefa:slug}', 'delete')->name('tarefas.delete');
});
