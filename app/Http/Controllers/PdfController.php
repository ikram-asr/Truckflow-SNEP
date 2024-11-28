<?php

namespace App\Http\Controllers;
use App\Models\Camion;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function exportPDF(Request $request)
{
    // Récupérer les dates de début et de fin de la requête
    $startDate = $request->input('search_date_start');
    $endDate = $request->input('search_date_end');

    // Vérifier si les dates de recherche sont présentes
    if ($startDate && $endDate) {
        // Rechercher les camions par plage de dates
        $camions = Camion::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->get();
    } else {
        // Si aucune date n'est fournie, récupérer tous les camions
        $camions = Camion::all();
    }

    // Préparer les données avec le calcul du séjour
    $camionsWithSejour = $camions->map(function ($camion) {
        // Utiliser Carbon pour vérifier et formater les dates et heures
        try {
            $heureEnregistrement = Carbon::parse($camion->heure_enregistrement);
        } catch (\Exception $e) {
            // Si l'heure d'enregistrement a un problème, mettre une valeur par défaut
            $heureEnregistrement = Carbon::now(); // Tu peux ajuster cette valeur selon tes besoins
        }

        // Calcul du séjour en heures si `Sejour` est manquant ou incorrect
        if (!$camion->Sejour || $camion->Sejour == '----') {
            $heureSortie = $camion->heure_sortie ? Carbon::parse($camion->heure_sortie) : Carbon::now();
            $sejour = $heureSortie->diffInHours($heureEnregistrement);
            $camion->Sejour = $sejour . ' heures'; // Formatage
        }

        // Vérification et formatage de l'heure d'affectation du BL (si c'est le problème)
        if ($camion->heure_affectation_bl) {
            try {
                // Essayer de parser l'heure d'affectation du BL en utilisant le format correct
                $camion->heure_affectation_bl = Carbon::createFromFormat('d/m/Y H:i:s', $camion->heure_affectation_bl)
                    ->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                // Si une erreur survient lors du parsing, stocker un message ou une valeur par défaut
                $camion->heure_affectation_bl = 'Format invalide'; // Ou tu peux choisir une autre approche
            }
        }

        return $camion;
    });

    // Générer le PDF avec les données mises à jour
    $pdf = PDF::loadView('camionspdf', ['camions' => $camionsWithSejour])
        ->setPaper('a3', 'landscape'); // Définir le format de la page

    return $pdf->download('camions.pdf');
}

public function exportPDF1(Request $request)
{
    // Récupérer les dates de début et de fin de la requête
    $startDate = $request->input('search_date_start');
    $endDate = $request->input('search_date_end');

    // Filtrer les camions selon les dates et conditions spécifiées
    $camions = Camion::whereNull('Numero_Bl')
        ->whereNull('heure_sortie')
        ->when($startDate, function ($query) use ($startDate) {
            return $query->whereDate('created_at', '>=', $startDate);
        })
        ->when($endDate, function ($query) use ($endDate) {
            return $query->whereDate('created_at', '<=', $endDate);
        })
        ->get();

    // Calculer le séjour pour chaque camion filtré
    foreach ($camions as $camion) {
        if ($camion->Sejour == '----') {
            if (!empty($camion->heure_enregistrement)) {
                $enregistrement = Carbon::parse($camion->heure_enregistrement);
                $heureActuelle = Carbon::now();
                $diff = $enregistrement->diff($heureActuelle);
                $camion->Sejour = $diff->format('%H:%I:%S');
                $camion->save();  // Enregistrer les modifications dans la base de données
            } else {
                $camion->Sejour = '----';
            }
        }
    }

    // Générer le PDF avec les camions filtrés
    $pdf = PDF::loadView('camionspdf', compact('camions'))
        ->setPaper('a3', 'landscape'); 
    
    return $pdf->download('camions.pdf');
}
public function exportPDF2(Request $request)
{
    // Récupérer les dates de début et de fin depuis la requête
    $startDate = $request->input('search_date_start');
    $endDate = $request->input('search_date_end');

    // Filtrer les camions avec un BL mais sans heure de sortie
    $camions = Camion::whereNotNull('Numero_Bl')
        ->whereNull('heure_sortie')
        ->when($startDate, function ($query) use ($startDate) {
            return $query->whereDate('created_at', '>=', $startDate);
        })
        ->when($endDate, function ($query) use ($endDate) {
            return $query->whereDate('created_at', '<=', $endDate);
        })
        ->get();

    // Calculer le séjour pour chaque camion filtré
    foreach ($camions as $camion) {
        if ($camion->Sejour === '----') {
            if (!empty($camion->heure_enregistrement)) {
                try {
                    $enregistrement = Carbon::parse($camion->heure_enregistrement);
                    $heureActuelle = Carbon::now();
                    $diff = $enregistrement->diff($heureActuelle);
                    $camion->Sejour = $diff->format('%H:%I:%S');
                    $camion->save(); // Enregistrer les modifications
                } catch (\Exception $e) {
                    $camion->Sejour = 'Format invalide';
                    $camion->save();
                }
            } else {
                $camion->Sejour = '----';
            }
        }
    }

    // Vérifier si des camions sont disponibles
    if ($camions->isEmpty()) {
        return redirect()->back()->with('message', 'Aucun camion à exporter.');
    }

    // Générer le PDF avec les camions filtrés
    $pdf = PDF::loadView('camionspdf', compact('camions'))
        ->setPaper('a3', 'landscape');

    return $pdf->download('camions.pdf');
}



   /* public function exportPDF2()
    {
        // Récupérer les camions avec BL mais sans heure de sortie
        $camions = Camion::whereNotNull('Numero_Bl')->whereNull('heure_sortie')->get();
    
        foreach ($camions as $camion) {
            // Vérifier si le champ 'Sejour' contient '----'
            if ($camion->Sejour == '----') {
                // Vérifier que 'heure_enregistrement' n'est pas vide
                if (!empty($camion->heure_enregistrement)) {
                    try {
                        // Parser 'heure_enregistrement' en utilisant Carbon
                        $enregistrement = Carbon::parse($camion->heure_enregistrement);
                        $heureActuelle = Carbon::now();
    
                        // Calculer la différence en heures, minutes et secondes
                        $diff = $enregistrement->diff($heureActuelle);
                        $camion->Sejour = $diff->format('%H:%I:%S');
    
                        // Enregistrer les modifications dans la base de données
                        $camion->save();
                    } catch (\Exception $e) {
                        // Gérer les erreurs de parsing ou de formatage
                        $camion->Sejour = 'Format invalide';
                        $camion->save();
                    }
                } else {
                    // Si 'heure_enregistrement' est vide, garder '----'
                    $camion->Sejour = '----';
                }
            }
        }
    
        // Générer le PDF avec les données des camions
        $pdf = PDF::loadView('camionspdf', compact('camions'))
            ->setPaper('a3', 'landscape');  // Définir la taille et l'orientation du papier
    
        return $pdf->download('camions.pdf');
    }*/
    



}
