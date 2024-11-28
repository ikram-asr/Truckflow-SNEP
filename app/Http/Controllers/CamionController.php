<?php

namespace App\Http\Controllers;
use App\Models\Transporteur;
use App\Models\Camion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\TypeVehicule;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;




class CamionController extends Controller
{

    public function filtredate(Request $request)
    {
        // Récupérer les dates de début et de fin de la requête
        $startDate = $request->input('search_date_start');
        $endDate = $request->input('search_date_end');
    
        // Rechercher les camions par plage de dates en comparant uniquement la date (sans l'heure) de created_at
        $camions = Camion::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->get();
                            
                            $filtered = true;

        // Retourner la vue avec les camions filtrés
        return view('Admin.testdashboard', compact('camions','filtered'));
    }
    public function filtrerpardate(Request $request)
    {
        // Récupérer les dates de début et de fin de la requête
        $startDate = $request->input('search_date_start');
        $endDate = $request->input('search_date_end');
    
        // Rechercher les camions par plage de dates en comparant uniquement la date (sans l'heure) de created_at
        $camions = Camion::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->get();
                            $filtered = true;

        // Retourner la vue avec les camions filtrés
        return view('Agent.listecamions', compact('camions','filtered'));
    }
    public function filtredatefa(Request $request)
    {
        // Récupérer les dates de début et de fin de la requête
        $startDate = $request->input('search_date_start');
        $endDate = $request->input('search_date_end');
    
        // Rechercher les camions par plage de dates en comparant uniquement la date (sans l'heure) de created_at
        $camions = Camion::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->whereNull('Numero_Bl')
                            ->get();
    
        // Retourner la vue avec les camions filtrés
        return view('Admin.camionsenregistresadmin', compact('camions'));
    }
    public function filtrerpardatefl(Request $request)
    {
        // Récupérer les dates de début et de fin de la requête
        $startDate = $request->input('search_date_start');
        $endDate = $request->input('search_date_end');
    
        // Rechercher les camions par plage de dates en comparant uniquement la date (sans l'heure) de created_at
        $camions = Camion::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->whereNull('Numero_Bl')
                            ->get();
    
        // Retourner la vue avec les camions filtrés
        return view('Agent.fileattente', compact('camions'));
    }
    public function filtrerpardateca(Request $request)
    {
        // Récupérer les dates de début et de fin de la requête
        $startDate = $request->input('search_date_start');
        $endDate = $request->input('search_date_end');
    
        // Rechercher les camions par plage de dates en comparant uniquement la date (sans l'heure) de created_at
        $camions = Camion::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->whereNotNull('Numero_Bl')
                            ->whereNull('heure_sortie')
                            ->get();
    
        // Retourner la vue avec les camions filtrés
        return view('Agent.camionsenaction', compact('camions'));
    }
    public function filtredatema(Request $request)
    {
        // Récupérer les dates de début et de fin de la requête
        $startDate = $request->input('search_date_start');
        $endDate = $request->input('search_date_end');
    
        // Rechercher les camions par plage de dates en comparant uniquement la date (sans l'heure) de created_at
        $camions = Camion::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->whereNotNull('Numero_Bl')
                            ->whereNull('heure_sortie')
                            ->get();
    
        // Retourner la vue avec les camions filtrés
        return view('Admin.camionenactionadmin', compact('camions'));
    }
    

    public function afficher($id)
    {
        $camion = Camion::find($id);
        if (!$camion) {
            return redirect()->route('home')->with('error', 'Camion non trouvé');
        }
        return view('affecterbl', compact('camion'));
    }


    public function lister_camions()  //pour lister tous les camions
    {
        $camions = Camion::all();

        return view('Agent.listecamions', compact('camions'));
    }
    public function listercamions()  //pour lister tous les camions
    {
        //$camions = Camion::all();
        $camions = Camion::with('type')->get();

        return view('Admin.testdashboard', compact('camions'));
    }
    public function fiche()
    {
        // Récupération des données PDF depuis la session
        $data = session()->get('pdf_data');
    
        // Si aucune donnée pour générer le PDF, rediriger avec un message d'erreur
        if (!$data) {
            return redirect()->route('camions')->with('error', 'Aucune donnée pour générer le PDF.');
        }
    
        // Générer le PDF
        $pdf = Pdf::loadView('fichecamion', $data);
    
        // Effacer les données de la session pour éviter des téléchargements répétitifs
        session()->forget('pdf_data');
    
        // Télécharger le PDF
        return $pdf->download('fiche_enregistrement.pdf');
    }
    
public function fichecam()
{
    $data = session()->get('pdfdata');

    if (!$data) {
        return redirect()->route('listecamions')->with('error', 'Aucune donnée pour générer le PDF.');
    }

    // Générer le PDF
    $pdf = Pdf::loadView('fichecamion', $data);
    session()->forget('pdfdata');

    // Télécharger le PDF
    return $pdf->download('fiche_enregistrement.pdf');
}


    public function fileattente()  //pour lister tous les camions
    {
        $camions = Camion::whereNull('Numero_Bl')->get();

        return view('Agent.fileattente', compact('camions'));
    }
    public function fileattenteadmin()  //pour lister tous les camions
    {
        $camions = Camion::whereNull('Numero_Bl')->get();

        return view('Admin.fileattenteadmin', compact('camions'));
    }
    
    

    public function camionsenregistres()  //pour lister tous les camions
    {
        $camions = Camion::whereNull('Numero_Bl')->get();

        return view('Agent.camionsenregistres', compact('camions'));
    }
    public function camionsenregistresadmin()  //pour lister tous les camions
    {
        $camions = Camion::whereNull('Numero_Bl')->get();

        return view('Admin.camionsenregistresadmin', compact('camions'));
    }
    
    public function camionsenaction()  //pour lister tous les camions
    {
        $camions = Camion::whereNull('heure_sortie')
        ->whereNotNull('Numero_Bl')
        ->get();

        return view('Agent.camionsenaction', compact('camions'));
    }
    public function camionsenactionadmin()  //pour lister tous les camions
    {
        $camions = Camion::whereNull('heure_sortie')
        ->whereNotNull('Numero_Bl')
        ->get();

        return view('Admin.camionenactionadmin', compact('camions'));
    }

    public function enregistrercamion() //pour ouvrir form d'enregistrement d'un camion
    {   
        $types_vehicule = TypeVehicule::all();

        // Obtenir le prochain ID auto-incrémenté
        $nextId = Camion::max('IdPassage') + 1;
        return view('Agent.enregistrercamion',['nextId'=>$nextId],compact('types_vehicule')); 

    }

    public function annoncesortie(Request $request, $IdPassage)
{
    // Si la requête est un POST, nous traitons la soumission du formulaire
    if ($request->isMethod('post')) {
        // Validation des données du formulaire
        $request->validate([
            'heure_sortie'=>['required'],
        ]);

        // Enregistrer les données dans la table BL
        $camion = Camion::find($IdPassage);

        if ($camion) {
            // Debugging: Vérifiez la valeur actuelle
            //Log::info('Valeur actuelle de Numero_Bl pour le camion avec ID ' . $IdPassage . ': ' . $camion->heure_sortie);

            $camion->heure_sortie = $request->heure_sortie;
            $camion->save();

            // Debugging: Vérifiez la nouvelle valeur
            //Log::info('Nouvelle valeur de Numero_Bl pour le camion avec ID ' . $IdPassage . ': ' . $camion->heure_sortie);
        } 

        return redirect()->route('camions')->with('success', 'heure enregistrée avec succès');
    }

    // Si la requête est un GET, nous affichons le formulaire
    //$heure_sortie = now()->format('H:i:s.000');
    $camion = Camion::findOrFail($IdPassage);
    return view('Admin.annoncersortie',compact('camion'));
}
    public function annoncersortie(Request $request, $IdPassage)
{
    // Si la requête est un POST, nous traitons la soumission du formulaire
    if ($request->isMethod('post')) {
        // Validation des données du formulaire
        $request->validate([
            'heure_sortie'=>['required'],
        ]);

        // Enregistrer les données dans la table BL
        $camion = Camion::find($IdPassage);

        if ($camion) {
            // Debugging: Vérifiez la valeur actuelle
            //Log::info('Valeur actuelle de Numero_Bl pour le camion avec ID ' . $IdPassage . ': ' . $camion->heure_sortie);

            $camion->heure_sortie = $request->heure_sortie;
            $camion->save();

            // Debugging: Vérifiez la nouvelle valeur
            //Log::info('Nouvelle valeur de Numero_Bl pour le camion avec ID ' . $IdPassage . ': ' . $camion->heure_sortie);
        } 

        return redirect()->route('camionsenaction')->with('success', 'heure enregistrée avec succès');
    }

    // Si la requête est un GET, nous affichons le formulaire
    //$heure_sortie = now()->format('H:i:s.000');
    $camion = Camion::findOrFail($IdPassage);
    return view('Agent.annoncersortie',compact('camion'));
}

    public function affecterbl(Request $request, $Id)
{
    if ($request->isMethod('post')) {
        // Validation des données du formulaire
         $request->validate([
            'Numero_Bl' => [
                'required',
                function ($attribute, $value, $fail) use ($Id) {
                    if (Camion::where('Numero_Bl', $value)->where('IdPassage', '!=', $Id)->exists()) {
                        $fail('Le numéro BL saisi existe déjà pour un autre camion.');
                    }
                }
            ],
            'heure_affectation_bl' => ['required'], // Validation de l'heure d'affectation BL

        ]);

        // Enregistrer les données dans la table BL
        $camion = Camion::find($Id);

        if ($camion) {
            // Debugging: Vérifiez la valeur actuelle
            //Log::info('Valeur actuelle de Numero_Bl pour le camion avec ID ' . $Id . ': ' . $camion->Numero_Bl);

            // Mettre à jour le champ Numero_Bl avec la nouvelle valeur
            $camion->Numero_Bl = $request->Numero_Bl;
            $camion->heure_affectation_bl = $request->heure_affectation_bl;
            $camion->save();

            // Debugging: Vérifiez la nouvelle valeur
            //Log::info('Nouvelle valeur de Numero_Bl pour le camion avec ID ' . $Id . ': ' . $camion->Numero_Bl);
        } else {
            Log::error('Camion non trouvé avec l\'ID: ' . $Id);
        }

        return redirect()->route('camionsenregistrés')->with('success', 'BL enregistré avec succès');
    }

    // Si la requête est un GET, nous affichons le formulaire
    $camion = Camion::findOrFail($Id);
    return view('Agent.affecterbl', compact('camion'));
}
public function affectbl(Request $request, $Id)
{
    // Si la requête est un POST, nous traitons la soumission du formulaire
    if ($request->isMethod('post')) {
        // Validation des données du formulaire
         $request->validate([
            'Numero_Bl' => [
                'required',
                function ($attribute, $value, $fail) use ($Id) {
                    if (Camion::where('Numero_Bl', $value)->where('IdPassage', '!=', $Id)->exists()) {
                        $fail('Le numéro BL saisi existe déjà pour un autre camion.');
                    }
                }
            ],
            'heure_affectation_bl' => ['required'], 

        ]);


        // Enregistrer les données dans la table BL
        $camion = Camion::find($Id);

        if ($camion) {
            // Debugging: Vérifiez la valeur actuelle
            //Log::info('Valeur actuelle de Numero_Bl pour le camion avec ID ' . $Id . ': ' . $camion->Numero_Bl);

            // Mettre à jour le champ Numero_Bl avec la nouvelle valeur
            $camion->Numero_Bl = $request->Numero_Bl;
            $camion->heure_affectation_bl = $request->heure_affectation_bl; // Mise à jour de l'heure d'affectation

            $camion->save();

            // Debugging: Vérifiez la nouvelle valeur
            //Log::info('Nouvelle valeur de Numero_Bl pour le camion avec ID ' . $Id . ': ' . $camion->Numero_Bl);
        } else {
            Log::error('Camion non trouvé avec l\'ID: ' . $Id);
        }

        return redirect()->route('camions')->with('success', 'BL enregistré avec succès');
    }

    // Si la requête est un GET, nous affichons le formulaire
    $camion = Camion::findOrFail($Id);
    return view('Admin.affecterbl', compact('camion'));
}


public function bonlivraison(Request $request)
{
    $camion = null;

    // Si l'ID de Passage est présent dans la requête, récupérez les détails du camion
    if ($request->filled('IdPassage')) {
        $camion = Camion::where('IdPassage', $request->input('IdPassage'))->first();
    }

    return view('Agent.affecterbldirect', compact('camion'));
}

public function bonliv(Request $request)
{
    $camion = null;

    // Si l'ID de Passage est présent dans la requête, récupérez les détails du camion
    if ($request->filled('IdPassage')) {
        $camion = Camion::where('IdPassage', $request->input('IdPassage'))->first();
    }

    return view('Admin.affecterbldirect-admin', compact('camion'));
}


public function affecterbldirect(Request $request)
{
    // Validation des données du formulaire
    $request->validate([
		         'IdPassage' => ['required', 'exists:camions,IdPassage'], // Assurez-vous que l'ID existe dans la table des camions
            'Numero_Bl' => [
            'required',
            function ($attribute, $value, $fail) use ($request) {
                // Utiliser $request->IdPassage pour vérifier les conflits de numéro BL
                if (Camion::where('Numero_Bl', $value)->where('IdPassage', '!=', $request->IdPassage)->exists()) {
                    $fail('Le numéro BL saisi existe déjà pour un autre camion.');
                    }
                }
            ],
            'heure_affectation_bl' => ['required'], // Validation de l'heure d'affectation BL

        ]);
    // Trouver le camion basé sur l'IdPassage
    $camion = Camion::where('IdPassage', $request->IdPassage)->first();
    if (!$camion) {
        return redirect()->route('bonlivraison')->with('error', 'Camion non trouvé');
    }

    // Mettre à jour le champ Numero_Bl avec la nouvelle valeur
    $camion->Numero_Bl = $request->Numero_Bl;
        $camion->heure_affectation_bl = $request->heure_affectation_bl; // Mise à jour de l'heure d'affectation

    $camion->save();

    // Rediriger avec un message de succès
    return redirect()->route('listecamions')->with('success', 'BL enregistré avec succès');
}
public function affecterbld(Request $request)
{

	        // Validation des données du formulaire
         $request->validate([
		         'IdPassage' => ['required', 'exists:camions,IdPassage'], // Assurez-vous que l'ID existe dans la table des camions
            'Numero_Bl' => [
            'required',
            function ($attribute, $value, $fail) use ($request) {
                // Utiliser $request->IdPassage pour vérifier les conflits de numéro BL
                if (Camion::where('Numero_Bl', $value)->where('IdPassage', '!=', $request->IdPassage)->exists()) {
                    $fail('Le numéro BL saisi existe déjà pour un autre camion.');
                    }
                }
            ],
            'heure_affectation_bl' => ['required'], // Validation de l'heure d'affectation BL

        ]);


    // Trouver le camion basé sur l'IdPassage
    $camion = Camion::where('IdPassage', $request->IdPassage)->first();
    if (!$camion) {
        return redirect()->route('bonlivraison')->with('error', 'Camion non trouvé');
    }

    // Mettre à jour le champ Numero_Bl avec la nouvelle valeur
    $camion->Numero_Bl = $request->Numero_Bl;
    $camion->heure_affectation_bl = $request->heure_affectation_bl; // Mise à jour de l'heure d'affectation

    $camion->save();

    // Rediriger avec un message de succès
    return redirect()->route('camions')->with('success', 'BL enregistré avec succès');
}

public function annoncersortiedirect(Request $request)
{
    // Validation des données du formulaire
    $request->validate([
        'heure_sortie' => ['required'],
        'IdPassage' => ['required', 'exists:camions,IdPassage'], // Assurez-vous que l'ID existe dans la table des camions
    ]);

    // Trouver le camion basé sur l'IdPassage
    $camion = Camion::where('IdPassage', $request->IdPassage)->first();


    // Mettre à jour le champ Numero_Bl avec la nouvelle valeur
    $camion->heure_sortie = $request->heure_sortie;
    $camion->save();

    // Rediriger avec un message de succès
    return redirect()->route('listecamions')->with('success', 'BL enregistré avec succès');
}

public function annoncersortied(Request $request)
{
    // Validation des données du formulaire
    $request->validate([
        'heure_sortie' => ['required'],
        'IdPassage' => ['required', 'exists:camions,IdPassage'], // Assurez-vous que l'ID existe dans la table des camions
    ]);

    // Trouver le camion basé sur l'IdPassage
    $camion = Camion::where('IdPassage', $request->IdPassage)->first();


    // Mettre à jour le champ Numero_Bl avec la nouvelle valeur
    $camion->heure_sortie = $request->heure_sortie;
    $camion->save();

    // Rediriger avec un message de succès
    return redirect()->route('camions')->with('success', 'BL enregistré avec succès');
}


    
    public function sortir(Request $request) //pour ouvrir form de sortie
{  
    $camion = null;

    // Si l'ID de Passage est présent dans la requête, récupérez les détails du camion
    if ($request->filled('IdPassage')) {
        $camion = Camion::find($request->input('IdPassage'));
    }
    //$heure_sortie = now()->format('H:i:s.000');
    return view('Agent.annoncersortiedirect', compact('camion')); 
     
}
public function sort(Request $request) //pour ouvrir form de sortie
{  
    $camion = null;

    // Si l'ID de Passage est présent dans la requête, récupérez les détails du camion
    if ($request->filled('IdPassage')) {
        $camion = Camion::find($request->input('IdPassage'));
    }
    //$heure_sortie = now()->format('H:i:s.000');
    return view('Admin.annoncersortiedirect', compact('camion')); 
     
}


   
    public function enregistrer(Request $request) //pour faire un enregistrement
    {       

        $request->validate([ 
            'IdPassage' => ['required','integer'],
            'Immatriculation' => ['required'],
            'Type' => ['required'],
            'Operation' => ['required'],
            'heure_enregistrement' => ['required'],
            'Cin_transporteur'=> ['required'],
            'Nom_transporteur'=> ['required'],
            'Prenom_transporteur'=> ['required'],

            //'heure_sortie'=>['required']
        ]);


 
        Camion::create([
            'IdPassage' => $request->input('IdPassage'),
            'Immatriculation' => $request->input('Immatriculation'),
            'Type' => $request->input('Type'),
            'Operation' => $request->input('Operation'),
            'heure_enregistrement' => $request->input('heure_enregistrement'), 
            'Cin_transporteur'=> $request->input('Cin_transporteur'),
            'Nom_transporteur'=> $request->input('Nom_transporteur'),
            'Prenom_transporteur'=> $request->input('Prenom_transporteur'),
            'agent_id' => auth()->guard('agent')->id(),

        ]);
        $data = [
            'IdPassage' => $request->input('IdPassage'),
            'Immatriculation' => $request->input('Immatriculation'),
            'Type' => $request->input('Type'),
            'Operation' => $request->input('Operation'),
            'heure_enregistrement' => $request->input('heure_enregistrement'),
            'Cin_transporteur' => $request->input('Cin_transporteur'),
            'Nom_transporteur' => $request->input('Nom_transporteur'),
            'Prenom_transporteur' => $request->input('Prenom_transporteur'),
        ];
        session()->put('pdfdata', $data);

        return redirect()->route('listecamions')->with('success', 'Camion et transporteur enregistrés avec succès.');
            }
           
    public function enregistrercamionadmin() //pour ouvrir form d'enregistrement d'un camion
     {
        
        $types_vehicule = TypeVehicule::all();
		    $camion = Camion::orderBy('IdPassage', 'desc')->first();

    $nextId = $camion ? $camion->IdPassage + 1 : 1;
     return view('Admin.enregistrercamion-admin',['nextId'=>$nextId],compact('types_vehicule')); 
        
            }           
           
           /* public function enregistrerpouradmin(Request $request) //pour faire un enregistrement
            {       
                $request->validate([ 
                    'IdPassage' => ['required','integer'],
                    'Immatriculation' => ['required'],
                    'Type' => ['required'],
                    'Operation' => ['required'],
                    'heure_enregistrement' => ['required'],
                    'Cin_transporteur'=> ['required'],
                    'Nom_transporteur'=> ['required'],
                    'Prenom_transporteur'=> ['required'],
        
                    //'heure_sortie'=>['required']
                ]);
                Camion::create([
                    'IdPassage' => $request->input('IdPassage'),
                    'Immatriculation' => $request->input('Immatriculation'),
                    'Type' => $request->input('Type'),
                    'Operation' => $request->input('Operation'),
                    'heure_enregistrement' => $request->input('heure_enregistrement'), 
                    'Cin_transporteur'=> $request->input('Cin_transporteur'),
                    'Nom_transporteur'=> $request->input('Nom_transporteur'),
                    'Prenom_transporteur'=> $request->input('Prenom_transporteur'),
                    'admin_id' => auth()->guard('admin')->id(),
        
                ]);
                // telecharger la fiche d'un camion à l'enregistrement
                $data = [
                    'IdPassage' => $request->input('IdPassage'),
                    'Immatriculation' => $request->input('Immatriculation'),
                    'Cin_transporteur' => $request->input('Cin_transporteur'),
                    'Nom_transporteur' => $request->input('Nom_transporteur'),
                    'Prenom_transporteur' => $request->input('Prenom_transporteur'),
                    'Type' => $request->input('Type'),
                    'Operation' => $request->input('Operation'),
                    'heure_enregistrement' => $request->input('heure_enregistrement')
                ];
                $pdf = Pdf::loadView('fichecamion', $data);
            
                return $pdf->download('fiche_enregistrement.pdf');

                return redirect()->route('camions')->with('success', 'Camion et transporteur enregistrés avec succès.');
                    }*/

                    public function enregistrerpouradmin(Request $request)
                    {       
                        // Validation des données d'entrée
                        $request->validate([ 
                            'IdPassage' => ['required','integer'],
                            'Immatriculation' => ['required'],
                            'Type' => ['required'],
                            'Operation' => ['required'],
                            'heure_enregistrement' => ['required'],
                            'Cin_transporteur'=> ['required'],
                            'Nom_transporteur'=> ['required'],
                            'Prenom_transporteur'=> ['required'],
                        ]);
                    
                        // Création du camion
                        Camion::create([
                            'IdPassage' => $request->input('IdPassage'),
                            'Immatriculation' => $request->input('Immatriculation'),
                            'Type' => $request->input('Type'),
                            'Operation' => $request->input('Operation'),
                            'heure_enregistrement' => $request->input('heure_enregistrement'), 
                            'Cin_transporteur'=> $request->input('Cin_transporteur'),
                            'Nom_transporteur'=> $request->input('Nom_transporteur'),
                            'Prenom_transporteur'=> $request->input('Prenom_transporteur'),
                            'admin_id' => auth()->guard('admin')->id(),
                        ]);
                    
                        // Génération des données pour le PDF
                        $data = [
                            'IdPassage' => $request->input('IdPassage'),
                            'Immatriculation' => $request->input('Immatriculation'),
                            'Cin_transporteur' => $request->input('Cin_transporteur'),
                            'Nom_transporteur' => $request->input('Nom_transporteur'),
                            'Prenom_transporteur' => $request->input('Prenom_transporteur'),
                            'Type' => $request->input('Type'),
                            'Operation' => $request->input('Operation'),
                            'heure_enregistrement' => $request->input('heure_enregistrement')
                        ];
                    
                        // Stockage des données dans la session pour générer le PDF après redirection
                        session()->put('pdf_data', $data);
                    
                        // Redirection vers la liste des camions
                        return redirect()->route('camions')->with('success', 'Camion et transporteur enregistrés avec succès.');
                    }
                    
                    
            
            public function sortie(Request $request) //pour faire une sortie
            {       
                $request->validate([ 
                    'IdPassage' => ['required','integer'],
                    'Immatriculation' => ['required'],
                    'Type' => ['required'],
                    'Operation' => ['required'],
                    'heure_enregistrement' => ['required'],
                    'Cin_transporteur'=> ['required'],
                    'Nom_transporteur'=> ['required'],
                    'Prenom_transporteur'=> ['required'],
                    'heure_sortie'=>['required']
                ]);
         
                Camion::create([
                    'IdPassage' => $request->input('IdPasage'),
                    'Immatriculation' => $request->input('Immatriculation'),
                    'Type' => $request->input('Type'),
                    'Operation' => $request->input('Operation'),
                    'heure_enregistrement' => $request->input('heure_enregistrement'), 
                    'Cin_transporteur'=> $request->input('Cin_transporteur'),
                    'Nom_transporteur'=> $request->input('Nom_transporteur'),
                    'Prenom_transporteur'=> $request->input('Prenom_transporteur'),
                    'heure_sortie' => $request->input('heure_sortie'), 
        
                ]);

                return redirect()->route('listecamions')->with('success', 'Camion et transporteur enregistrés avec succès.');
                    }

                    public function modifier(Request $request, $IdPassage)
                    {
                        // Trouver le camion par son ID
                        $camion = Camion::findOrFail($IdPassage);
                    
                        // Validation conditionnelle
                        $request->validate([
                            'Immatriculation' => ['required'],
                            'Type' => ['required'],
                            'Operation' => ['required'],
                            'heure_enregistrement' => ['required'],
                            'Cin_transporteur' => ['required'],
                            'Nom_transporteur' => ['required'],
                            'Prenom_transporteur' => ['required'],
                            'heure_sortie' => ['nullable'], // Autoriser null si non fourni
                            'Numero_Bl' => ['nullable'], // Autoriser null si non fourni
                        ]);
                    
                        // Mettre à jour les données du camion uniquement pour les champs fournis
                        $camion->update($request->only([
                            'Immatriculation',
                            'Type',
                            'Operation',
                            'heure_enregistrement',
                            'Cin_transporteur',
                            'Nom_transporteur',
                            'Prenom_transporteur',
                            'heure_sortie', // Autoriser la mise à jour uniquement si fourni
                            'Numero_Bl' // Autoriser la mise à jour uniquement si fourni
                        ]));
                    
                        // Enregistrer les modifications
                        $camion->save();
                    
                        // Rediriger avec un message de succès
                        return redirect()->route('camions')->with('success', 'Les données du camion ont été mises à jour avec succès.');
                    }
                    
public function modifiercamion($IdPassage)
{
    $types_vehicule = TypeVehicule::all();

    $camion = Camion::findOrFail($IdPassage);
    return view('Admin.modifiercamion', compact('camion'), compact('types_vehicule'));
}


public function supprimer($IdPassage)
{
    $camion = Camion::findOrFail($IdPassage);
    $camion->delete();

    return redirect()->route('camions')->with('success', 'L\'agent a été supprimé avec succès.');
}
public function supprimer1($IdPassage)
{
    $camion = Camion::findOrFail($IdPassage);
    $camion->delete();

    return redirect()->route('camenregistrés')->with('success', 'L\'agent a été supprimé avec succès.');
}
public function supprimer2($IdPassage)
{
    $camion = Camion::findOrFail($IdPassage);
    $camion->delete();

    return redirect()->route('camionsaction')->with('success', 'L\'agent a été supprimé avec succès.');
}

public function supprimerbl($IdPasage)
{

    // Trouver le camion par son ID
    $camion = Camion::findOrFail($IdPasage);
  if ($camion->Numero_Bl !== null) {
        // Supprimer le numéro de BL en le remplaçant par null
        $camion->Numero_Bl = null;
		$camion->heure_sortie = null;
        $camion->save();
        
      
    }

    // Rediriger avec un message de succès
    return redirect()->back()->with('success', 'Le numéro de BL a été supprimé avec succès.');
}

public function supprimersortie($IdPasage)
{

    // Trouver le camion par son ID
    $camion = Camion::findOrFail($IdPasage);

    // Supprimer le numéro de BL
    $camion->heure_sortie = null;
    $camion->save();

    // Rediriger avec un message de succès
    return redirect()->back()->with('success', 'heure de sortie a été supprimé avec succès.');
}





}

