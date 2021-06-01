<?php

use App\Http\Controllers\PersonneMoraleController;
use App\Models\Conducteur;
use App\Models\PersonneMorale;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\ConducteurController;
use App\Http\Controllers\ControleTechniqueController;
use App\Http\Controllers\ControleEtatController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PersonneController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/client', function () {
    return view('client', [
        'personnesMorale' => PersonneMorale::all(), 
        'personnesPhysiques' => Conducteur::all()->where('est_particulier', '=', true),
        'conducteurs' => Conducteur::all()->where('est_particulier', '=', false)
    ]);
})->middleware(['auth'])->name('client');

Route::get('/ajouter/client/personne_morale', [PersonneMoraleController::class, 'create'])->middleware(['auth'])->name('AjouterPersonneMorale');
Route::post('/ajouter/client/personne_morale', [PersonneMoraleController::class, 'store'])->middleware(['auth'])->name('AjouterPersonneMorale');
Route::get('/modifier/client/personne_morale/{id}', [PersonneMoraleController::class, 'edit'])->middleware(['auth'])->name('ModifierPersonneMorale');
Route::post('/modifier/client/personne_morale/{id}', [PersonneMoraleController::class, 'update'])->middleware(['auth'])->name('ModifierPersonneMorale');
Route::get('/supprimer/client/personne_morale/{id}', [PersonneMoraleController::class, 'destroy'])->middleware(['auth'])->name('SupprimerPersonneMorale');

Route::get('/personnes', [PersonneController::class, 'index'])->name('personnes');
Route::get('/personnes/new', [PersonneController::class, 'create'])->middleware(['auth'])->name('ajouterPersonne');
Route::post('/personnes/new', [PersonneController::class, 'store'])->middleware(['auth'])->name('ajouterPersonne');
Route::get('/personnes/edit/{id}', [PersonneController::class, 'edit'])->middleware(['auth'])->name('modifierPersonne');
Route::post('/personnes/edit/{id}', [PersonneController::class, 'update'])->middleware(['auth'])->name('modifierPersonne');
Route::get('/personnes/delete/{id}', [PersonneController::class, 'destroy'])->middleware(['auth'])->name('supprimerPersonne');
Route::get('/personnes/{id}', [PersonneController::class, 'show'])->name('personne');

Route::get('/ajouter/client/{type}', [ConducteurController::class, 'create'])->middleware(['auth'])->name('AjouterPersonnePhysique');
Route::post('/ajouter/client/{type}', [ConducteurController::class, 'store'])->middleware(['auth'])->name('AjouterPersonnePhysique');
Route::get('/modifier/client/{id}/{type}', [ConducteurController::class, 'edit'])->middleware(['auth'])->name('ModifierPersonnePhysique');
Route::post('/modifier/client/{id}/{type}', [ConducteurController::class, 'update'])->middleware(['auth'])->name('ModifierPersonnePhysique');
Route::get('/supprimer/client/{id}/{type}', [ConducteurController::class, 'destroy'])->middleware(['auth'])->name('SupprimerPersonnePhysique');

Route::get('/vehicules', [VehiculeController::class, 'index'])->name('vehicules');
Route::get('/ajouter/vehicule/{type}', [VehiculeController::class, 'create'])->middleware(['auth'])->name('AjouterVehicule');
Route::post('/ajouter/vehicule/{type}', [VehiculeController::class, 'store'])->middleware(['auth'])->name('AjouterVehicule');
Route::get('/modifier/vehicule/{id}/{type}', [VehiculeController::class, 'edit'])->middleware(['auth'])->name('ModifierVehicule');
Route::post('/modifier/vehicule/{id}/{type}', [VehiculeController::class, 'update'])->middleware(['auth'])->name('ModifierVehicule');
Route::get('/supprimer/vehicule/{id}/{type}', [VehiculeController::class, 'destroy'])->middleware(['auth'])->name('SupprimerVehicule');
Route::get('/vehicules/{id}', [VehiculeController::class, 'show'])->name('vehicule');

Route::get('/contrats', [ContratController::class, 'index'])->name('contrats');
Route::get('/contrats/new', [ContratController::class, 'create'])->middleware(['auth'])->name('ajouterContrat');
Route::post('/contrats/new', [ContratController::class, 'store'])->middleware(['auth'])->name('ajouterContrat');
Route::get('/contrats/edit/{id}', [ContratController::class, 'edit'])->middleware(['auth'])->name('modifierContrat');
Route::post('/contrats/edit/{id}', [ContratController::class, 'update'])->middleware(['auth'])->name('modifierContrat');
Route::get('/contrats/delete/{id}', [ContratController::class, 'destroy'])->middleware(['auth'])->name('supprimerContrat');
Route::get('/contrats/{id}', [ContratController::class, 'show'])->name('contrat');

Route::get('/conducteurs', [ConducteurController::class, 'index'])->name('conducteurs');
Route::get('/conducteurs/new', [ConducteurController::class, 'create'])->middleware(['auth'])->name('ajouterConducteur');
Route::post('/conducteurs/new', [ConducteurController::class, 'store'])->middleware(['auth'])->name('ajouterConducteur');
Route::get('/conducteurs/edit/{id}', [ConducteurController::class, 'edit'])->middleware(['auth'])->name('modifierConducteur');
Route::post('/conducteurs/edit/{id}', [ConducteurController::class, 'update'])->middleware(['auth'])->name('modifierConducteur');
Route::get('/conducteurs/delete/{id}', [ConducteurController::class, 'destroy'])->middleware(['auth'])->name('supprimerConducteur');
Route::get('/conducteurs/{id}', [ConducteurController::class, 'show'])->name('conducteur');

Route::get('/controles-technique', [ControleTechniqueController::class, 'index'])->name('controlesTechnique');
Route::get('/controles-technique/new', [ControleTechniqueController::class, 'create'])->middleware(['auth'])->name('ajouterControleTechnique');
Route::post('/controles-technique/new', [ControleTechniqueController::class, 'store'])->middleware(['auth'])->name('ajouterControleTechnique');
Route::get('/controles-technique/edit/{id}', [ControleTechniqueController::class, 'edit'])->middleware(['auth'])->name('modifierControleTechnique');
Route::post('/controles-technique/edit/{id}', [ControleTechniqueController::class, 'update'])->middleware(['auth'])->name('modifierControleTechnique');
Route::get('/controles-technique/delete/{id}', [ControleTechniqueController::class, 'destroy'])->middleware(['auth'])->name('supprimerControleTechnique');
Route::get('/controles-technique/{id}', [ControleTechniqueController::class, 'show'])->name('controleTechnique');

Route::get('/controles-etat', [ControleEtatController::class, 'index'])->name('controlesEtat');
Route::get('/controles-etat/new', [ControleEtatController::class, 'create'])->middleware(['auth'])->name('ajouterControleEtat');
Route::post('/controles-etat/new', [ControleEtatController::class, 'store'])->middleware(['auth'])->name('ajouterControleEtat');
Route::get('/controles-etat/edit/{id}', [ControleEtatController::class, 'edit'])->middleware(['auth'])->name('modifierControleEtat');
Route::post('/controles-etat/edit/{id}', [ControleEtatController::class, 'update'])->middleware(['auth'])->name('modifierControleEtat');
Route::get('/controles-etat/delete/{id}', [ControleEtatController::class, 'destroy'])->middleware(['auth'])->name('supprimerControleEtat');
Route::get('/controles-etat/{id}', [ControleEtatController::class, 'show'])->name('controleEtat');

Route::get('/employes', [EmployeController::class, 'index'])->name('employes');
Route::get('/employes/new', [EmployeController::class, 'create'])->middleware(['auth'])->name('ajouterEmploye');
Route::post('/employes/new', [EmployeController::class, 'store'])->middleware(['auth'])->name('ajouterEmploye');
Route::get('/employes/edit/{id}', [EmployeController::class, 'edit'])->middleware(['auth'])->name('modifierEmploye');
Route::post('/employes/edit/{id}', [EmployeController::class, 'update'])->middleware(['auth'])->name('modifierEmploye');
Route::get('/employes/delete/{id}', [EmployeController::class, 'destroy'])->middleware(['auth'])->name('supprimerEmploye');
Route::get('/employes/{id}', [EmployeController::class, 'show'])->name('employe');

require __DIR__.'/auth.php';
