<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('agent')->check()) {
            return $next($request);
        }

        return redirect()->route('loginagent'); // Redirige vers la page de login agent si non authentifié
    }
}
