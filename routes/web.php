<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\Admin\inscriptionadmin;
use App\Http\Controllers\Admin\inscrireagent;
use App\Http\Controllers\Admin\loginadmin;

use App\Http\Controllers\blController;
use App\Models\Camion;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PdfController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//ROUTE POUR LES ADMINS AUTH
/*Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [App\Http\Controllers\Admin\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [App\Http\Controllers\Admin\AuthenticatedSessionController::class, 'store'])->name('login.submit');
    Route::post('logout', [App\Http\Controllers\Admin\AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
});*/
Route::middleware('guest')->group(function () {
Route::get('/', function () {
    return view('welcome');
})->name('home');

//aut
Route::get('register', [inscriptionadmin::class, 'inscription'])
                ->name('inscription');
    
Route::post('register', [inscriptionadmin::class, 'register']);

Route::get('seconnecter', [loginadmin::class, 'connexion'])
                ->name('loginadmin');
    
Route::post('seconnecter', [loginadmin::class, 'connect']);

Route::get('loginagent', [AgentController::class, 'connex'])
                ->name('loginagent');
                
Route::post('loginagent', [AgentController::class, 'connecter']);

});
//Route admin
//Route::middleware(['auth:admin'])->group(function () {
	


Route::middleware(['adminauth'])->prefix('admin')->group(function () {

	
Route::get('/camions/filtredate', [CamionController::class, 'filtredate'])->name('filtredate');
Route::get('e', [CamionController::class, 'filtredatefa'])->name('filtredatefa');
Route::get('ate', [CamionController::class, 'filtredatema'])->name('filtredatema');

	Route::delete('/camion/{IdPassage}/supprimerNumeroBl', [CamionController::class, 'supprimerNumeroBl'])->name('supprimerNumeroBl');

    Route::post('/logout', [loginadmin::class, 'logout'])->name('logoutadmin');
    Route::get('camions/pdf', [PdfController::class, 'exportPDF'])
->name('pdf');
Route::get('fileattente/pdf', [PdfController::class, 'exportPDF1'])
->name('pdf1');
Route::get('camionsenaction/pdf', [PdfController::class, 'exportPDF2'])
->name('pdf2');

	Route::post('/camion/{IdPassage}/supprimerNumeroBl', [CamionController::class, 'supprimerbl'])->name('supprimerbl');
	Route::post('/camion/{IdPassage}/supprimersortie', [CamionController::class, 'supprimersortie'])->name('supprimersortie');

Route::get('/telecharger-pdf', [CamionController::class, 'fiche'])->name('fiche');

    Route::get('listercamion', [CamionController::class, 'listercamions'])
    ->name('camions');
    //acceuil
    Route::get('/Acceuil', function () {
        return view('Admin.acceuil-admin');
    })->name('acceuil');
    //agents gestion
    Route::get('inscrireagent', [inscrireagent::class, 'inscrireagent'])
    ->name('inscrireagent');
    Route::post('inscrireagent', [inscrireagent::class, 'inscrire'])
        ->name('inscrire');

    Route::get('inscrireadmin', [inscrireagent::class, 'inscrireadmin'])
    ->name('inscrireadmin');
    Route::post('inscrireadmin', [inscrireagent::class, 'inscr'])
        ->name('inscr');


    Route::get('listeagents', [AgentController::class, 'lister_agents'])
    ->name('listeagents');

    Route::put('/agent/{Agent_id}', [AgentController::class, 'modifier'])->name('modifieragent');
    Route::get('/agent/{Agent_id}/edit', [AgentController::class, 'modifieragent'])->name('modif');
	
	 Route::put('/admin/{id}', [AgentController::class, 'mod'])->name('modifieradmin');
    Route::get('/admin/{id}/edit', [AgentController::class, 'modifieradmin'])->name('mod');

    Route::delete('/admin/listeagents/{Agent_id}', [AgentController::class, 'supprimer'])->name('supprimeragent');
    Route::delete('/admin/listeadmin/{id}', [AgentController::class, 'supprimerad'])->name('supprimeradmin');
   

   //gestion camions
    Route::get('enregicamion', [CamionController::class, 'enregistrercamionadmin'])
    ->name('enregistrercamionadmin');

    Route::post('/enregistrercamion', [CamionController::class, 'enregistrerpouradmin'])
    ->name('enregistrerparadmin');

    Route::put('/camion/{IdPassage}', [CamionController::class, 'modifier'])->name('modifiercamion');
    Route::get('/camion/{IdPassage}/edit', [CamionController::class, 'modifiercamion'])->name('modifier');
	
    Route::delete('/camion/listecamions/{IdPassage}', [CamionController::class, 'supprimer'])
    ->name('supprimercamion');
    Route::delete('/camions/{IdPassage}', [CamionController::class, 'supprimer1'])
    ->name('supprimercamion1');
    Route::delete('/camion/{IdPassage}', [CamionController::class, 'supprimer2'])
    ->name('supprimercamion2');


    Route::get('/fleattente', [CamionController::class, 'fileattenteadmin'])
    ->name('fattente');
    Route::get('camenregistrés', [CamionController::class, 'camionsenregistresadmin'])
    ->name('camenregistrés');
    Route::get('camionsaction', [CamionController::class, 'camionsenactionadmin'])
    ->name('camionsaction');

    Route::match(['get', 'post'], 'affect/{Id}', [CamionController::class, 'affectbl'])
    ->name('bonl');
    Route::match(['get', 'post'], 'annoncesortie/{IdPassage}', [CamionController::class, 'annoncesortie'])
    ->name('annoncesortie');
    Route::get('sortie', [CamionController::class, 'sort'])
    ->name('sort');
    Route::post('sortie', [CamionController::class, 'annoncersortied'])
    ->name('annoncersortied');
     Route::get('affecterbld', [CamionController::class, 'bonliv'])
    ->name('bonliv');
    Route::post('affecterbldi', [CamionController::class, 'affecterbld'])
    ->name('affecterbld');

});

	 Route::get('camions/pdff', [PdfController::class, 'exportPDF'])
->name('pdfag');
Route::get('fileattente/pdff', [PdfController::class, 'exportPDF1'])
->name('pdf1ag');
Route::get('camionsenaction/pdff', [PdfController::class, 'exportPDF2'])
->name('pdf2ag');
	
Route::middleware(['agentauth'])->prefix('agent')->group(function () {
    
    Route::get('/telechargerpdf', [CamionController::class, 'fichecam'])->name('fichecam');

    Route::match(['get', 'post'], 'annoncersortie/{IdPassage}', [CamionController::class, 'annoncersortie'])
    ->name('annoncersortie');
    
    Route::match(['get', 'post'], 'affecter/{Id}', [CamionController::class, 'affecterbl'])
    ->name('bl');
    Route::post('/déconnexion', [AgentController::class, 'logoutagent'])->name('logoutagent');

    Route::get('/acceuil', function () {
        return view('Agent.acceuil');
    })->name('acceuilagent');
    
    Route::get('/retour', [AgentController::class, 'retour'])->name('retour');
    //datatables
    Route::get('fileattente', [CamionController::class, 'fileattente'])
    ->name('fileattente');
    Route::get('camionsenregistrés', [CamionController::class, 'camionsenregistres'])
    ->name('camionsenregistrés');
    Route::get('camionsenregistrésaction', [CamionController::class, 'camionsenaction'])
    ->name('camionsenaction');
    Route::post('enregistrercam', [CamionController::class, 'enregistrer'])
    ->name('enregistrer');

    Route::get('/camions/date', [CamionController::class, 'filtrerpardate'])->name('filtre');
    Route::get('/camidate', [CamionController::class, 'filtrerpardatefl'])->name('filtrefl');
    Route::get('/camiate', [CamionController::class, 'filtrerpardateca'])->name('filtreca');


    Route::get('lister_camions', [CamionController::class, 'lister_camions'])
    ->name('listecamions');
    Route::get('annoncersortie', [CamionController::class, 'sortir'])
        ->name('sortir');
        Route::post('annoncersortie', [CamionController::class, 'annoncersortiedirect'])
        ->name('annoncersortiedirect');
    Route::get('affecterbldirect', [CamionController::class, 'bonlivraison'])
    ->name('bonlivraison');
    Route::post('affecterbldirect', [CamionController::class, 'affecterbldirect'])
        ->name('affecterbldirect');
    Route::get('enregistrercamion', [CamionController::class, 'enregistrercamion'])
    ->name('enregistrercamion');
});

//test dashboard
Route::get('/test', function () {
    return view('Admin.testdashboard');
}); 

//hors 
require __DIR__.'/auth.php';
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
    
})->middleware(['auth'])->name('dashboard');
