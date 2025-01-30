<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\AlertController;

// Rota inicial para teste
Route::get('/', function () {
    return 'FinanceControl está funcionando!';
});

// Rotas para UserController
Route::resource('users', UserController::class);

// Rotas para IncomeController
Route::resource('incomes', IncomeController::class);

// Rotas para ExpenseController
Route::resource('expenses', ExpenseController::class);

// Rotas para GoalController
Route::resource('goals', GoalController::class);

// Rotas para AlertController
Route::resource('alerts', AlertController::class);

// Rota para gerar o token CSRF
Route::get('/generate-token', function () {
    return csrf_token();
});
