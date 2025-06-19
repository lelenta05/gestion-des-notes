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
        // Vérifie les règles, le throttling, et tente déjà l'authentification
        $request->authenticate();

         // Regénère l'ID de session pour la sécurité
         $request->session()->regenerate();
         //recuperer l'utilisateur authentifier
         $user=Auth::user();
         switch($user->role_id){
            case 1:
                return redirect()->intended(route('admin.dashboard'));
            case 2:
                return redirect()->intended(route('assistant.dashboard'));
            case 3:
                return redirect()->intended(route('etudiant.mesNotes'));
            default:
            Auth::logout();
            return redirect()->route('login')->withErrors(['email'=> 'Role non reconnu.']);
         }

        
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
