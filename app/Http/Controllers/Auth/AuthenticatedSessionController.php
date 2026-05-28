<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
public function store(LoginRequest $request): RedirectResponse
{
    // Tentar login como cliente primeiro
    $cliente = \App\Models\Espectador::where('email', $request->email)->first();
    
    if ($cliente && $cliente->password && \Illuminate\Support\Facades\Hash::check($request->password, $cliente->password)) {
        session([
            'cliente_id'    => $cliente->cod_espectador,
            'cliente_nome'  => $cliente->nome,
            'cliente_email' => $cliente->email,
        ]);
        return redirect()->route('cliente.dashboard');
    }

    // Senão tenta login como admin
    $request->authenticate();
    $request->session()->regenerate();
    return redirect()->intended(route('dashboard'));
}

    /**
     * Destroy an authenticated session.
     */
public function destroy(Request $request): RedirectResponse
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
}
