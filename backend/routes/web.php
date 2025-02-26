<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\AuthController;

// Rota inicial para teste
Route::get('/', function () {
    return 'FinanceControl está funcionando!';
});

// Rotas de autenticação
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('web.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rota para criar novo usuário (sem autenticação)
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Outras rotas protegidas
Route::middleware('auth')->group(function () {
    // Rota do Dashboard
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    })->name('dashboard');

    // Rotas para UserController
    Route::get('/users', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users', [UserController::class, 'destroy'])->name('users.destroy');

    // Rotas para IncomeController
    Route::resource('incomes', IncomeController::class)->except(['index', 'show']);

    // Rotas para ExpenseController
    Route::resource('expenses', ExpenseController::class)->except(['index', 'show']);

    // Rotas para GoalController
    Route::resource('goals', GoalController::class);

    // Rotas para AlertController
    Route::resource('alerts', AlertController::class);

});

// Rota para gerar o token CSRF
Route::get('/generate-token', function () {
    return csrf_token();
})->middleware('disable_csrf');
