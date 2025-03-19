<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('usuarios')->controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('usuarios.index');
    Route::get('/create', 'create')->name('usuarios.create');
    Route::post('/', 'store')->name('usuarios.store');
    Route::get('/{user}/edit', 'edit')->name('usuarios.edit');
    Route::put('/{user}', 'update')->name('usuarios.update');
    Route::delete('/{user}', 'destroy')->name('usuarios.destroy');
});
