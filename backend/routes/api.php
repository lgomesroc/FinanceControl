<?php

use App\Http\Controllers\AlertController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store'])->name('api.users.store');
Route::put('/users/{user}', [UserController::class, 'updateApi'])->name('api.users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('api.users.destroy');
Route::get('/alerts', [AlertController::class, 'index']);
Route::post('/alerts', [AlertController::class, 'store']);
Route::get('/expenses', [ExpenseController::class, 'index']);
Route::post('/expenses', [ExpenseController::class, 'store']);
Route::get('/goals', [GoalController::class, 'index']);
Route::post('/goals', [GoalController::class, 'store']);
Route::get('/incomes', [IncomeController::class, 'index']);
Route::post('/incomes', [IncomeController::class, 'store']);
Route::get('/categories', [CategoryController::class, 'index'])->name('api.category.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('api.category.store');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('api.category.destroy');
