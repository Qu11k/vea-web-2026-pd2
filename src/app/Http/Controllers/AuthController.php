<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login', [
            'title' => 'Pieslēgties'
        ]);
    }

    // authenticate user
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Redirect to fighters page after login
            return redirect('/fighters');
        }

        return back()->withErrors([
            'name' => 'Autentifikācija neveiksmīga',
        ]);
    }
    // logout
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}