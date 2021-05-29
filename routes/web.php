<?php

use App\Http\Controllers\PersonneMoraleController;
use App\Models\Conducteur;
use App\Models\PersonneMorale;
use Illuminate\Support\Facades\Route;

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
    return view('client', ['personnesMorales' => PersonneMorale::all(), 'personnesPhysiques' => Conducteur::where('estParticulier', true)]);
})->middleware(['auth'])->name('client');

Route::get('/ajouter/client/personne_morale', [PersonneMoraleController::class, 'create'])->middleware(['auth'])->name('AjouterPersonneMorale');
Route::post('/ajouter/client/personne_morale', [PersonneMoraleController::class, 'store'])->middleware(['auth'])->name('AjouterPersonneMorale');

Route::get('/modifier/client/personne_morale/{id}', [PersonneMoraleController::class, 'edit'])->middleware(['auth'])->name('ModifierPersonneMorale');
Route::post('/modifier/client/personne_morale/{id}', [PersonneMoraleController::class, 'update'])->middleware(['auth'])->name('ModifierPersonneMorale');

Route::get('/supprimer/client/personne_morale/{id}', [PersonneMoraleController::class, 'destroy'])->middleware(['auth'])->name('SupprimerPersonneMorale');

require __DIR__.'/auth.php';
