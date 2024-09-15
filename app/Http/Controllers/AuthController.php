<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('login');
    }

    public function authenticate(Request $request): void
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6|max:50',
        ],[
            'email.required' => 'E-mail é obrigatório',
            'email.email' => 'E-mail inválido',
            'password.required' => 'Senha é obrigatório',
            'password.min' => 'A senha deve ter no mínimo :min caracteres',
            'password.max' => 'A senha deve ter no máximo :max caracteres'
        ]);

        echo "OK";

    }

    public function logout(): void
    {
        echo 'logout';
    }
}
