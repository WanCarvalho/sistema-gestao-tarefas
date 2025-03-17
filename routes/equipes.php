<?php

use App\Http\Controllers\EquipeController;
use Illuminate\Support\Facades\Route;

Route::prefix('equipes')->controller(EquipeController::class)->group(function () {
    Route::get('/', 'index')->name('equipes.index');
    Route::get('/{equipe:id}', 'show')->name('equipes.show');
    Route::get('/create', 'create')->name('equipes.create');
    Route::get('/edit/{equipe:id}', 'edit')->name('equipes.edit');
    Route::post('/', 'store')->name('equipes.store');
    Route::put('/update/{equipe:id}', 'update')->name('equipes.update');
    Route::delete('/{equipe:id}', 'delete')->name('equipes.delete');
});
