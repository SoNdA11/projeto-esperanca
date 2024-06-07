<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// GET - Retorna todos os usuários
Route::get('/users', [UserController::class, 'index']);  //http://localhost:8000/api/users?page=1

// Visualizar um usuário
Route::get('/users/{user}', [UserController::class, 'show']); // GET - http://localhost:8000/api/users/2 //mudando o valor de 2 para 1 ou qualquer outro, muda o usuário do banco de dados

// Cria um novo usuário ou Cadastrar
Route::post('/users', [UserController::class, 'store']); // POST - http://localhost:8000/api/users

// Atualizar um usuário
Route::put('/users/{user}', [UserController::class, 'update']); // PUT - http://localhost:8000/api/users/2    -> nessa parte adicione o id do usuário que deseja atualizar

// Deletar um usuário
Route::delete('/users/{user}', [UserController::class, 'destroy']); // DELETE - http://localhost:8000/api/users/2
