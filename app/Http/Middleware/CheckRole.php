<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // SuperAdmin tem acesso a tudo
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // Verifica se o role do utilizador está nos roles permitidos
        if (!in_array($user->role, $roles)) {
            abort(403, 'Não tens permissão para aceder a esta página.');
        }

        return $next($request);
    }
}
