<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\IncomeController;

// Define a rota para criação de usuário
Route::post('/users', [UserController::class, 'store']);
Route::get('/alerts', [AlertController::class, 'index']);
Route::post('/alerts', [AlertController::class, 'store']);
Route::get('/expenses', [ExpenseController::class, 'index']);
Route::post('/expenses', [ExpenseController::class, 'store']);
Route::get('/goals', [GoalController::class, 'index']);
Route::post('/goals', [GoalController::class, 'store']);
Route::get('/incomes', [IncomeController::class, 'index']);
Route::post('/incomes', [IncomeController::class, 'store']);
Route::apiResource('expenses', ExpenseController::class);
Route::apiResource('goals', GoalController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('alerts', AlertController::class);
Route::apiResource('incomes', IncomeController::class);

// Rota da API para gerar o token CSRF
Route::get('/generate-token', function () {
    return csrf_token();
});
