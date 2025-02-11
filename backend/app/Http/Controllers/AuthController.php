<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['message' => 'Invalid login credentials']);
        }

        return redirect()->intended('dashboard');
    }

       public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login')->with('message', 'Logged out successfully');
    }
}
