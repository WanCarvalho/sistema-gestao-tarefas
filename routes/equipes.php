<?php

use App\Http\Controllers\EquipeController;
use Illuminate\Support\Facades\Route;

Route::prefix('equipes')->controller(EquipeController::class)->group(function () {
    Route::get('/', 'index')->name('equipes.index');
    Route::get('/{equipe:id}', 'show')->name('equipes.show');
    Route::get('/create', 'create')->name('equipes.create');
    Route::post('/', 'store')->name('equipes.store');
    Route::put('/update/{equipe:id}', 'update')->name('equipes.update');
    Route::delete('/{equipe:id}', 'delete')->name('equipes.delete');

    // Membro na equipe
    Route::get('/equipes/{equipe}/membros/create', [EquipeController::class, 'createMembro'])->name('equipes.membros.create');
    Route::post('/equipes/{equipe}/membros', [EquipeController::class, 'storeMembro'])->name('equipes.membros.store');
    Route::delete('/equipes/{equipe}/membros/{membro}', [EquipeController::class, 'destroyMembro'])->name('equipes.membros.destroy');

    // Criar gestor na equipe
    Route::get('/equipes/{equipe}/gestores/create', [EquipeController::class, 'createGestor'])->name('equipes.gestores.create');
    Route::post('/equipes/{equipe}/gestores', [EquipeController::class, 'storeGestor'])->name('equipes.gestores.store');
    Route::delete('/equipes/{equipe}/gestores/{gestor}', [EquipeController::class, 'destroyGestor'])->name('equipes.gestores.destroy');
});
