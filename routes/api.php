<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rota para cadastrar um novo usuário
Route::post('/cadastrar', [UserController::class, 'store'])->name('users.store');

// Grupo de rotas com prefixo '/user'
Route::prefix('/user')->group(function () {
    // Rota para listar todos os usuários
    Route::get('/', [UserController::class, 'index'])->name('users.index');

    // Rota para atualizar um usuário específico
    Route::put('/{user}', [UserController::class, 'update'])->name('users.update');

    // Rota para deletar um usuário específico
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
