<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Rota para a página inicial
Route::get('/', function () {
    return view('welcome');
});

// Rota para atualizar um usuário específico
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

// Rota para deletar um usuário específico
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
