<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function login(): RedirectResponse|View
    {
        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'email' => 'required|string|email',
                'password' => 'required|string|min:3|max:50',
            ],
            [
                'email.required' => 'E-mail é obrigatório',
                'email.email' => 'E-mail inválido',
                'password.required' => 'Senha é obrigatório',
                'password.min' => 'A senha deve ter no mínimo :min caracteres',
                'password.max' => 'A senha deve ter no máximo :max caracteres'
            ]
        );

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)
            ->whereNull('deleted_at')
            ->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'E-mail e/ou senha incorretos. Cód. #003');
        }

        $user->last_login = now();
        $user->save();

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->intended();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
