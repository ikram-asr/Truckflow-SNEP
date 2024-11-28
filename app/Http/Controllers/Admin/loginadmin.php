<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class loginadmin extends Controller
{
    /**
     * Affiche la vue d'inscription des admins.
     */
    public function connexion()
    {
        return view('auth.admin-login');
    }

    /**
     * Gère la soumission du formulaire d'inscription des admins.
     
	 public function connect(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nom_utilisateur' => 'required|string|max:255',
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Vérifier si l'administrateur existe avec le nom d'utilisateur fourni
    $admin = Admin::where('nom_utilisateur', $request->nom_utilisateur)->first();

    if ($admin && Hash::check($request->password, $admin->password)) {
        // Authentification réussie
        Auth::guard('admin')->login($admin);
        return view('Admin.acceuil-admin');
    }

    // Redirection après une connexion échouée
    return redirect()->back()->withErrors(['nom_utilisateur' => 'Les informations de connexion ne sont pas correctes.'])->withInput();
}*/
	 
  public function connect(Request $request)
  
    {

        $validator = Validator::make($request->all(), [
            'nom_utilisateur' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $admin = Admin::where('nom_utilisateur', $request->nom_utilisateur)->first();
        
    if ($admin && Hash::check($request->password, $admin->password)) {
            // Authentification réussie
            Auth::guard('admin')->login($admin);
            return view('Admin.acceuil-admin');
        }
   
      // Redirection après une connexion échouée
        return redirect()->back()->withErrors(['nom_utilisateur' => 'Les informations de connexion ne sont pas correctes.'])->withInput();
    }
	

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirection vers la page WELCOME
    }
}