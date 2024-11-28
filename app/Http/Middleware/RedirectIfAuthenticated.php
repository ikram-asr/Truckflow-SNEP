<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
     public function handle(Request $request, Closure $next)
     {
         // Vérifiez si l'utilisateur est authentifié en tant qu'admin ou agent
         if (Auth::guard('admin')->check() || Auth::guard('agent')->check()) {
             // Déconnectez l'utilisateur
             Auth::guard('admin')->logout();
             Auth::guard('agent')->logout();
 
             // Redirigez l'utilisateur vers la page d'accueil ou une autre route
             return redirect('/')->with('status', 'Vous avez été déconnecté car vous avez tenté d\'accéder à une page réservée aux non-authentifiés.');
         }
 
         // Si l'utilisateur n'est pas authentifié, continuez la requête
         return $next($request);
     }
}
