<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Exibe o dashboard do usuário com todas as suas informações.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Carrega o usuário atual com suas relações
        $user = Auth::user()->load(['incomes', 'expenses', 'goals', 'alerts']);

        return view('dashboard', compact('user'));
    }
}
