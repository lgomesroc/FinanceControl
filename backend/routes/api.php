<?php

use Illuminate\Http\Request;
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
Route::resource('expenses', ExpenseController::class);
Route::resource('goals', GoalController::class);
Route::resource('users', UserController::class);
Route::resource('alerts', AlertController::class);
Route::resource('incomes', IncomeController::class);

