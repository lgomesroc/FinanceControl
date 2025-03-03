<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        // Verificar o reCAPTCHA
        $recaptchaResponse = $request->input('recaptcha');
        $recaptchaSecret = env('RECAPTCHA_SECRET_KEY');
        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse,
        ]);

        if (!$recaptcha->json('success')) {
            return response()->json(['message' => 'Falha no reCAPTCHA.'], 422);
        }

        // Autenticar o usuário
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['user' => Auth::user()]);
        }

        return response()->json(['message' => 'Credenciais inválidas.'], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }
}
