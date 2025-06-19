<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use app\Models\User ;
class ProfileController extends Controller
{
    /**
     * Afficher le formulaire de modification du profil.
     */
    public function edit()
    {
        $user = Auth::user(); // Récupérer l'utilisateur connecté
        return view('profile.edit', compact('user'));
    }

    /**
     * Mettre à jour les informations du profil.
     */
    public function update(Request $request)
    {
     // Vérifiez si l'utilisateur est connecté
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vous devez être connecté pour modifier votre profil.');
    }

    $user = Auth::id(); 

    // Valider les données
    $request->validate([
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user,
        'password' => 'nullable|min:8|confirmed',
    ]);

    // Mettre à jour directement dans la base de données
    User::where('id', $user)->update([
        'name' => $request->name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : Auth::user()->password,
    ]);

    return redirect()->route('profile.edit')->with('success', 'Profil mis à jour avec succès.');
}
}