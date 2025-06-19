<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        //verifier si l'user est connecter et verifier si le role est dans la db 
        //...$role tres important car Laravel convertit automatiquement :1,2 en [1, 2] cad en tableau
        if(Auth::check() && in_array(Auth::user()->role_id, $roles)) {
            return $next($request);
        }

        abort(403,'Accès non autorise');//sinon erreur 
    }
}
