<?php
namespace App\Http\Controllers\Agent;

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;


use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class AgentController extends Controller
{
    public function retour()
    {
        if(Auth::guard('admin')->check()){

        return view('Admin.acceuil-admin');}
        else{return view('Agent.acceuil');}
    }
    
    
    public function lister_agents()
    {
        $agents = Agent::with('admin')->get();
		        $admins = Admin::all();


        //$agents = Agent::all();
        return view('Admin.listeagents', compact('agents'),compact('admins'));
    }
	


   /* public function modifier(Request $request, $Agent_id)
{
  
    $agent = Agent::findOrFail($Agent_id);

    // Valider les données
    $request->validate([
        'Nom' => 'string|max:255',
        'Prenom' => 'string|max:255',
        'nomutilisateur' => 'string|max:255',
        'password' => 'string|max:255',
    ]);

    // Mettre à jour les données de l'agent uniquement pour les champs fournis
    $agent->fill($request->only([
        'Nom',
        'Prenom',
        'nomutilisateur',
        'password'
    ]));


    // Enregistrer les modifications
    $agent->save();

    // Rediriger avec un message de succès
    return redirect()->route('listeagents')->with('success', 'Les données de l\'agent ont été mises à jour avec succès.');

}*/
    public function modifier(Request $request, $Agent_id)
                    {
                        // Trouver le camion par son ID
                        $agent = Agent::findOrFail($Agent_id);
                    
                        // Validation conditionnelle
                        $request->validate([
                             'Nom' => 'nullable|string|max:255',
        'Prenom' => 'nullable|string|max:255',
'nomutilisateur' => 'nullable|string|max:255|unique:agents,nomutilisateur,' . $Agent_id . ',Agent_id',
        'password' => 'nullable|string|min:8',
                        ]);
                    
                        // Mettre à jour les données du camion uniquement pour les champs fournis
                        $agent->update($request->only([
                            'Nom',
                            'Prenom',
                            'nomutilisateur',
                            'password',
                        
                        ]));
                    
                        // Enregistrer les modifications
                        $agent->save();
                    
                        // Rediriger avec un message de succès
                        return redirect()->route('listeagents')->with('success', 'Les données du camion ont été mises à jour avec succès.');
                    }



/* public function modifier(Request $request, $Agent_id)
{
    // Trouver l'agent par ID
    $agent = Agent::findOrFail($Agent_id);

    // Validation des données
    $request->validate([
        'Nom' => 'nullable|string|max:255',
        'Prenom' => 'nullable|string|max:255',
        'nomutilisateur' => 'nullable|string|max:255|unique:agents,nomutilisateur,' . $Agent_id . ',Agent_id',
        'MotdePasse' => 'nullable|string|min:8',
    ]);

    // Mettre à jour les données de l'agent uniquement pour les champs fournis
    $agent->Nom = $request->input('Nom', $agent->Nom);
    $agent->Prenom = $request->input('Prenom', $agent->Prenom);
    $agent->nomutilisateur = $request->input('nomutilisateur', $agent->nomutilisateur);

    // Mettre à jour le mot de passe seulement s'il est fourni
    if ($request->filled('MotdePasse')) {
        $agent->password = Hash::make($request->input('MotdePasse'));
    }

    // Enregistrer les modifications
    $agent->save();

    // Rediriger avec un message de succès
    return redirect()->route('listeagents')->with('success', 'Les données de l\'agent ont été mises à jour avec succès.');
}*/
public function modifieragent($Agent_id)
{
    $agent = Agent::findOrFail($Agent_id);
    return view('Admin.modifieragent', compact('agent'));
}


public function modifieradmin($id)
{
    $admin = Admin::findOrFail($id);
    return view('Admin.modifieradmin', compact('admin'));
	
}
/*public function mod(Request $request, $id)
{
    // Trouver l'admin par ID
    $admin = Admin::findOrFail($id);

    // Validation conditionnelle
    $request->validate([
        'Nom' => 'nullable|string|max:255',
        'Prénom' => 'nullable|string|max:255',
        'nom_utilisateur' => 'nullable|string|max:255|unique:admins,nom_utilisateur,' . $id . ',id',
        'password' => 'nullable|string|min:8',
    ]);

    // Mettre à jour les données de l'admin uniquement pour les champs fournis
    $admin->Nom = $request->input('Nom', $admin->Nom);
    $admin->Prénom = $request->input('Prénom', $admin->Prénom);
    $admin->nom_utilisateur = $request->input('nom_utilisateur', $admin->nom_utilisateur);

    // Mettre à jour le mot de passe seulement s'il est fourni
    if ($request->filled('password')) {
        $admin->password = Hash::make($request->input('password'));
    }

    // Enregistrer les modifications
    $admin->save();

    // Rediriger avec un message de succès
    return redirect()->route('listeagents')->with('success', 'Les données de l\'agent ont été mises à jour avec succès.');
}*/

                    public function mod(Request $request, $id)
                    {
                        // Trouver le camion par son ID
                        $admin = Admin::findOrFail($id);
                    
                        // Validation conditionnelle
                        $request->validate([
                             'Nom' => 'nullable|string|max:255',
        'Prénom' => 'nullable|string|max:255',
        'nom_utilisateur' => 'nullable|string|max:255|unique:admins,nom_utilisateur,' . $id . ',id',
        'password' => 'nullable|string|min:8',
                        ]);
                    
                        // Mettre à jour les données du camion uniquement pour les champs fournis
                        $admin->update($request->only([
                            'Nom',
                            'Prénom',
                            'nom_utilisateur',
                            'password',
                        
                        ]));
                    
                        // Enregistrer les modifications
                        $admin->save();
                    
                        // Rediriger avec un message de succès
                        return redirect()->route('listeagents')->with('success', 'Les données du camion ont été mises à jour avec succès.');
                    }


 /*public function mod(Request $request, $id)
{
    // Trouver l'agent par ID
    $admin = Admin::findOrFail($id);

    // Validation des données
    $request->validate([
        'Nom' => 'nullable|string|max:255',
        'Prénom' => 'nullable|string|max:255',
        'nom_utilisateur' => 'nullable|string|max:255|unique:admins,nom_utilisateur,' . $id . ',id',
        'password' => 'nullable|string|min:8',
    ]);

    // Mettre à jour les données de l'agent uniquement pour les champs fournis
    $admin->Nom = $request->input('Nom', $admin->Nom);
    $admin->Prénom = $request->input('Prénom', $admin->Prénom);
    $admin->nom_utilisateur = $request->input('nom_utilisateur', $admin->nom_utilisateur);

    // Mettre à jour le mot de passe seulement s'il est fourni
    if ($request->filled('password')) {
        $admin->password = Hash::make($request->input('password'));
    }

    // Enregistrer les modifications
    $admin->save();

    // Rediriger avec un message de succès
    return redirect()->route('listeagents')->with('success', 'Les données de l\'agent ont été mises à jour avec succès.');
}*/

public function supprimer($Agent_id)
{
    $agent = Agent::findOrFail($Agent_id);
    $agent->delete();

    return redirect()->route('listeagents')->with('success', 'L\'agent a été supprimé avec succès.');
}
public function supprimerad($id)
{
    $admin = Admin::findOrFail($id);
    $admin->delete();

    return redirect()->route('listeagents')->with('success', 'L\'agent a été supprimé avec succès.');
}

public function connecter(Request $request)
{
    // Validation des données
    $validator = Validator::make($request->all(), [
        'nomutilisateur' => 'required|string|max:255',
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Trouver l'agent par nom d'utilisateur
    $agent = Agent::where('nomutilisateur', $request->nomutilisateur)->first();

    // Vérifier si l'agent existe et si le mot de passe est correct
    if ($agent && Hash::check($request->password, $agent->password)) {
        // Authentifier l'agent
        Auth::guard('agent')->login($agent);

        // Redirection après une connexion réussie avec un message de succès
        return view('Agent.acceuil')->with('success', 'Connexion réussie!');
    }

    // Connexion échouée
    return redirect()->back()->withErrors(['nomutilisateur' => 'Les informations de connexion ne sont pas correctes.'])->withInput();
}


public function connex()
{
    return view('auth.agent-login');
}
public function logoutagent(Request $request)
{
    Auth::guard('agent')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/'); // Redirection vers la page WELCOME
}
}

