<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// GET - Retorna todos os usuários
Route::get('/users', [UserController::class, 'index']);  //http://localhost:8000/api/users?page=1

// Visualizar um usuário
Route::get('/users/{email}', [UserController::class, 'show']); // GET - http://localhost:8000/api/users/user@example.com

// Cria um novo usuário ou Cadastrar
Route::post('/users', [UserController::class, 'store']); // POST - http://localhost:8000/api/users

// Atualizar um usuário
Route::put('/users/{email}', [UserController::class, 'update']); // PUT - http://localhost:8000/api/users/user@example.com

// Deletar um usuário
Route::delete('/users/{email}', [UserController::class, 'destroy']); // DELETE - http://localhost:8000/api/users/user@example.com
