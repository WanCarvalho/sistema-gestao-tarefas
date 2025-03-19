<?php

use App\Http\Controllers\ProfileController;
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

    // Importa o conjunto de rotas das tarefas
    Route::group([], base_path('routes/tarefas.php'));

    // Importa o conjunto de rotas das equipes
    Route::group([], base_path('routes/equipes.php'));

    // Importa o conjunto de rotas dos usuários
    Route::group([], base_path('routes/usuarios.php'));
});

require __DIR__ . '/auth.php';
