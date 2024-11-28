<?php

namespace App\Http\Controllers;

use App\Models\bl;
use App\Models\Camion;
use Illuminate\Http\Request;

class blController extends Controller
{

    // Méthode pour enregistrer un nouveau BL dans la base de données
    public function store(Request $request)
    {
        // Valide les données du formulaire
        $request->validate([
            'NumeroBl' => 'nullable|string|max:255',  // Numéro de BL peut être null et doit être une chaîne de caractères
            'IdPassage' => 'required|exists:camions,IdPassage',  // IdPassage doit exister dans la table camions
        ]);

        // Crée un nouveau BL avec les données validées
        Bl::create([
            'NumeroBl' => $request->input('NumeroBl'),  // Récupère le numéro de BL du formulaire
        ]);

        // Redirige vers la liste des BL avec un message de succès
        return redirect()->route('bl.index')->with('success', 'BL ajouté avec succès.');
    }
}
