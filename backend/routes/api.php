<?php

use App\Http\Controllers\AlertApiController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\ExpenseApiController;
use App\Http\Controllers\GoalApiController;
use App\Http\Controllers\IncomeApiController;
use App\Http\Controllers\UserApiController;
use Illuminate\Support\Facades\Route;

// Rotas públicas
Route::post('/login', [AuthApiController::class, 'login'])->name('api.login');
Route::post('/logout', [AuthApiController::class, 'logout'])->name('api.logout');

// Rotas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserApiController::class, 'index']);
    Route::post('/users', [UserApiController::class, 'store'])->name('api.users.store');
    Route::put('/users/{user}', [UserApiController::class, 'update'])->name('api.users.update');
    Route::delete('/users/{user}', [UserApiController::class, 'destroy'])->name('api.users.destroy');

    Route::get('/alerts', [AlertApiController::class, 'index']);
    Route::post('/alerts', [AlertApiController::class, 'store']);
    Route::put('/alerts/{alert}', [AlertApiController::class, 'update']);
    Route::delete('/alerts/{alert}', [AlertApiController::class, 'destroy']);

    Route::get('/expenses', [ExpenseApiController::class, 'index']);
    Route::post('/expenses', [ExpenseApiController::class, 'store']);
    Route::put('/expenses/{expense}', [ExpenseApiController::class, 'update']);
    Route::delete('/expenses/{expense}', [ExpenseApiController::class, 'destroy']);

    Route::get('/goals', [GoalApiController::class, 'index']);
    Route::post('/goals', [GoalApiController::class, 'store']);
    Route::put('/goals/{goal}', [GoalApiController::class, 'update']);
    Route::delete('/goals/{goal}', [GoalApiController::class, 'destroy']);

    Route::get('/incomes', [IncomeApiController::class, 'index']);
    Route::post('/incomes', [IncomeApiController::class, 'store']);
    Route::put('/incomes/{income}', [IncomeApiController::class, 'update']);
    Route::delete('/incomes/{income}', [IncomeApiController::class, 'destroy']);

    Route::get('/data', [ApiController::class, 'getData']);
    Route::post('/data', [ApiController::class, 'postData']);
});
