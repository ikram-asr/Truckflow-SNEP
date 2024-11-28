<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class inscriptionadmin extends Controller
{
    /**
     * Affiche la vue d'inscription des admins.
     */
    public function inscription()
    {
        return view('auth.admin-register');
    }

    /**
     * Gère la soumission du formulaire d'inscription des admins.
     */
    public function register(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'Nom' => 'required|string|max:255',
            'Prénom' => 'required|string|max:255',
            'nom_utilisateur' => 'required|string|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Création de l'admin
        $admin = Admin::create([
            'Nom' => $request->Nom,
            'Prénom' => $request->Prénom,
            'nom_utilisateur' => $request->nom_utilisateur,
            'password' => $request->password,
        ]);

        // Redirection après inscription
        return view('Admin.acceuil-admin');
    }
}
