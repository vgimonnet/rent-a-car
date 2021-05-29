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

<<<<<<< HEAD
Route::get('/client', function () {
    return view('client', ['personnesMorales' => PersonneMorale::all(), 'personnesPhysiques' => Conducteur::where('estParticulier', true)]);
})->middleware(['auth'])->name('client');

Route::get('/ajouter/client/personne_morale', [PersonneMoraleController::class, 'create'])->middleware(['auth'])->name('AjouterPersonneMorale');
Route::post('/ajouter/client/personne_morale', [PersonneMoraleController::class, 'store'])->middleware(['auth'])->name('AjouterPersonneMorale');

Route::get('/modifier/client/personne_morale/{id}', [PersonneMoraleController::class, 'edit'])->middleware(['auth'])->name('ModifierPersonneMorale');
Route::post('/modifier/client/personne_morale/{id}', [PersonneMoraleController::class, 'update'])->middleware(['auth'])->name('ModifierPersonneMorale');

Route::get('/supprimer/client/personne_morale/{id}', [PersonneMoraleController::class, 'destroy'])->middleware(['auth'])->name('SupprimerPersonneMorale');
=======
Route::get('/contrats', [ContratController::class, 'index']);

Route::get('/contrats/{id}', [ContratController::class, 'show']);

Route::get('/vehicules', [VehiculeController::class, 'index']);

Route::get('/vehicules/{id}', [VehiculeController::class, 'show']);

Route::post('/vehicules/new', [VehiculeController::class, 'store']);

Route::get('/conducteurs', [ConducteurController::class, 'index']);

Route::get('/conducteurs/{id}', [ConducteurController::class, 'show']);

Route::get('/controles-technique', [ControleTechniqueController::class, 'index']);

Route::get('/controles-technique/{id}', [ControleTechniqueController::class, 'show']);

Route::get('/controles-etat', [ControleEtatController::class, 'index']);

Route::get('/controles-etat/{id}', [ControleEtatController::class, 'show']);

Route::get('/employes', [EmployeController::class, 'index']);

Route::get('/employes/{id}', [EmployeController::class, 'show']);
>>>>>>> origin/main

require __DIR__.'/auth.php';
