<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\bl;

use App\Models\Camion;

class AdminController extends Controller
{
    // Afficher la liste des agents
    public function indexAgents()
    {
        $agents = Agent::all();
        return view('admin.agents.index', compact('agents'));
    }

    // Afficher le formulaire de création d'un nouvel agent
    public function createAgent()
    {
        return view('admin.agents.create');
    }

    // Enregistrer un nouvel agent
    public function storeAgent(Request $request)
    {
        $request->validate([
            'Nom' => 'required|string|max:255',
            'Prénom' => 'required|email|unique:agents,email',
            'nom_utilisateur' => 'required|email|unique:agents,email',
            'Motdepasse' => 'required|string|min:6',
        ]);

        $agent = new Agent();
        $agent->Nom = $request->input('Nom');
        $agent->Prénom = $request->input('Prénom');
        $agent->email = $request->input('email');
        $agent->password = bcrypt($request->input('password'));
        $agent->save();

        return redirect()->route('admin.agents.index')->with('success', 'Agent créé avec succès.');
    }

    // Afficher le formulaire de modification d'un agent
    public function editAgent($id)
    {
        $agent = Agent::findOrFail($id);
        return view('admin.agents.edit', compact('agent'));
    }

    // Mettre à jour les informations d'un agent
    public function updateAgent(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $agent = Agent::findOrFail($id);
        $agent->name = $request->input('name');
        $agent->email = $request->input('email');

        if ($request->input('password')) {
            $request->validate([
                'password' => 'string|min:6',
            ]);
            $agent->password = bcrypt($request->input('password'));
        }

        $agent->save();

        return redirect()->route('admin.agents.index')->with('success', 'Agent mis à jour avec succès.');
    }

    // Supprimer un agent
    public function destroyAgent($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->delete();

        return redirect()->route('admin.agents.index')->with('success', 'Agent supprimé avec succès.');
    }

    // Afficher la liste des camions
    public function indexCamions()
    {
        $camions = Camion::all();
        return view('admin.camions.index', compact('camions'));
    }

    // Afficher le formulaire de création d'un camion
    public function createCamion()
    {
        return view('admin.camions.create');
    }

    // Enregistrer un nouveau camion
    public function storeCamion(Request $request)
    {
        $request->validate([
            'model' => 'required|string|max:255',
            'license_plate' => 'required|string|max:10|unique:camions,license_plate',
        ]);

        $camion = new Camion();
        $camion->model = $request->input('model');
        $camion->license_plate = $request->input('license_plate');
        $camion->save();

        return redirect()->route('admin.camions.index')->with('success', 'Camion créé avec succès.');
    }

    // Afficher le formulaire de modification d'un camion
    public function editCamion($id)
    {
        $camion = Camion::findOrFail($id);
        return view('admin.camions.edit', compact('camion'));
    }

    // Mettre à jour les informations d'un camion
    public function updateCamion(Request $request, $id)
    {
        $request->validate([
            'model' => 'required|string|max:255',
            'license_plate' => 'required|string|max:10',
        ]);

        $camion = Camion::findOrFail($id);
        $camion->model = $request->input('model');
        $camion->license_plate = $request->input('license_plate');
        $camion->save();

        return redirect()->route('admin.camions.index')->with('success', 'Camion mis à jour avec succès.');
    }

    // Supprimer un camion
    public function destroyCamion($id)
    {
        $camion = Camion::findOrFail($id);
        $camion->delete();

        return redirect()->route('admin.camions.index')->with('success', 'Camion supprimé avec succès.');
    }
    // Afficher le formulaire pour affecter un BL à un camion
public function assignBlForm($camionId)
{
    $camion = Camion::findOrFail($camionId);
    // Vous pouvez obtenir une liste des BLs disponibles ici si nécessaire
    return view('admin.camions.assign_bl', compact('camion'));
}

// Affecter un BL à un camion
public function assignBl(Request $request, $camionId)
{
    $request->validate([
        'bl_id' => 'required|exists:bls,id', // Assurez-vous que le BL existe
    ]);

    $camion = Camion::findOrFail($camionId);
    $bl = Bl::findOrFail($request->input('bl_id'));

    // Affecter le BL au camion
    $camion->bl_id = $bl->id;
    $camion->save();

    return redirect()->route('admin.camions.index')->with('success', 'BL affecté au camion avec succès.');
}
// Lancer la sortie d'un camion
public function launchDeparture($camionId)
{
    $camion = Camion::findOrFail($camionId);

    // Mettre à jour l'état du camion pour indiquer qu'il est en sortie
    $camion->status = 'en sortie'; // Assurez-vous d'avoir un champ 'status' dans votre modèle Camion
    $camion->departure_time = now(); // Enregistrez l'heure de départ si nécessaire
    $camion->save();

    return redirect()->route('admin.camions.index')->with('success', 'Camion est en sortie.');
}


}

