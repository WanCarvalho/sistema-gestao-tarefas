<?php

use App\Http\Controllers\EquipeController;
use Illuminate\Support\Facades\Route;

Route::prefix('equipes')->controller(EquipeController::class)->group(function () {
    Route::get('/', 'index')->name('equipes.index');
    Route::get('/visualizar/{equipe:id}', 'show')->name('equipes.show');
    Route::get('/create', 'create')->name('equipes.create');
    Route::post('/', 'store')->name('equipes.store');
    Route::put('/update/{equipe:id}', 'update')->name('equipes.update');
    Route::delete('/{equipe:id}', 'delete')->name('equipes.delete');

    // Membro na equipe
    Route::get('/{equipe}/membros/create', [EquipeController::class, 'createMembro'])->name('equipes.membros.create');
    Route::post('/{equipe}/membros', [EquipeController::class, 'storeMembro'])->name('equipes.membros.store');
    Route::delete('/{equipe}/membros/{membro}', [EquipeController::class, 'destroyMembro'])->name('equipes.membros.destroy');

    // Criar gestor na equipe
    Route::get('/{equipe}/gestores/create', [EquipeController::class, 'createGestor'])->name('equipes.gestores.create');
    Route::post('/{equipe}/gestores', [EquipeController::class, 'storeGestor'])->name('equipes.gestores.store');
    Route::delete('/{equipe}/gestores/{gestor}', [EquipeController::class, 'destroyGestor'])->name('equipes.gestores.destroy');
});
