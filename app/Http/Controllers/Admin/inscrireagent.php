<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class inscrireagent extends Controller
{
    /**
     * Affiche la vue d'inscription des admins.
     */
    public function inscrireadmin()
    {
        return view('Admin.inscrireadmin');
    }

    public function inscr(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'Nom' => 'required|string|max:255',
            'Prénom' => 'required|string|max:255',
            'nom_utilisateur' => 'required|string|max:255|unique:admins',
            'password' => 'required|string|min:8',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Création de l'admin
            $admin=Admin::create([
            'Nom' => $request->Nom,
            'Prénom' => $request->Prénom,
            'nom_utilisateur' => $request->nom_utilisateur,
            'password' => ($request->password),
            //'admin_id' =>  auth('admin')->id(),

        ]);
        // Redirection après inscription
        return redirect()->route('listeagents')->with('success', 'Agent inscrit avec succès');
    }
	
	
	
	    public function inscrireagent()
    {
        return view('Admin.inscrireagent');
    }

    public function inscrire(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'Nom' => 'required|string|max:255',
            'Prenom' => 'required|string|max:255',
            'nomutilisateur' => 'required|string|max:255|unique:agents',
            'password' => 'required|string|min:8',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Création de l'agent
            $agent=Agent::create([
            'Nom' => $request->Nom,
            'Prenom' => $request->Prenom,
            'nomutilisateur' => $request->nomutilisateur,
            'password' => ($request->password),
            'admin_id' =>  auth('admin')->id(),

        ]);
        // Redirection après inscription
        return redirect()->route('listeagents')->with('success', 'Agent inscrit avec succès');
    }
}
