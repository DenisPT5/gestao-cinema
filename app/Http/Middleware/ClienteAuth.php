<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClienteAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('cliente_id')) {
            return redirect()->route('cliente.login')
                ->with('error', 'Por favor faz login para continuares.');
        }
        return $next($request);
    }
}
