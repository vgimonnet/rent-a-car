<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\VehiculeLeger;
use App\Models\VehiculeUtilitaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/vehicules', [
          'vehiculesLeger' => VehiculeLeger::paginate(15),
          'vehiculesUtilitaire' => VehiculeUtilitaire::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type = 'vehicule_leger')
    {
      if ($type == 'vehicule_leger') {
          $params = [
              'type' => 'vehicule_leger',
              'title' => 'Création d\'un véhicule léger'
          ];
      } else {
          $params = [
              'type' => 'vehicule_utilitaire',
              'title' => 'Création d\'un véhicule utilitaire',
          ];
      }

      return view(
          'components/forms/form-vehicule', 
          array_merge($params, [
              'redirect' => 'AjouterVehicule', 
              'vehicule' => null,
              'btn' => 'Ajouter'
          ])
      );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type = 'vehicule_leger')
    {
      $validated = $request->validate([
        'immatriculation' => 'required|min:1',
        'marque' => 'required|min:1',
        'modele' => 'required|min:1',
        'couleur' => 'required|min:1',
        'poid' => 'required|integer',
        'hauteur' => 'required|integer',
        'places' => 'required|integer',
        'coutParJour' => 'required|min:1',
        'dateAnciennete' => 'required|date',
        'contenanceCoffre' => 'required|integer',
      ]);

      if ($type == 'vehicule_leger') {
        $vehicule = new VehiculeLeger();        
      } else {
        $vehicule = new VehiculeUtilitaire();
        $vehicule->benne = $request->benne ? true : false;
      }
      $vehicule->disponible = $request->disponible ? true : false;
      $vehicule->immatriculation = $request->immatriculation;
      $vehicule->marque = $request->marque;
      $vehicule->modele = $request->modele;
      $vehicule->couleur = $request->couleur;
      $vehicule->poid = $request->poid;
      $vehicule->hauteur = $request->hauteur;
      $vehicule->places = $request->places;
      $vehicule->cout_par_jour = $request->coutParJour;
      $vehicule->date_anciennete = $request->dateAnciennete;
      $vehicule->contenance_coffre = $request->contenanceCoffre;
      $vehicule->save();

      return redirect()->route('vehicules');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicule = Vehicule::find($id);
        return view('components/single', ['single' => $vehicule]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $type = 'vehicule_leger')
    {
      if ($type == 'vehicule_leger') {
        $params = [
            'type' => 'vehicule_leger',
            'title' => 'Modification d\'un véhicule léger',
            'vehicule' => VehiculeLeger::find($id)
        ];
      } else {
        $params = [
            'type' => 'vehicule_utilitaire',
            'title' => 'Modification d\'un véhicule utilitaire',
            'vehicule' => VehiculeUtilitaire::find($id)
        ];
      }

      return view(
        'components/forms/form-vehicule', 
        array_merge($params, [
          'redirect' => 'ModifierVehicule', 
          'btn' => 'Modifier'
        ])
      );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $type = 'vehicule_leger')
    {
        
        $validated = $request->validate([
          'immatriculation' => 'required|min:1',
          'marque' => 'required|min:1',
          'modele' => 'required|min:1',
          'couleur' => 'required|min:1',
          'poid' => 'required|integer',
          'hauteur' => 'required|integer',
          'places' => 'required|integer',
          'coutParJour' => 'required|min:1',
          'dateAnciennete' => 'required|date',
          'contenanceCoffre' => 'required|integer',
        ]);

        if ($type == 'vehicule_leger') {
          $vehicule = VehiculeLeger::find($id);
        } else {
          $vehicule = VehiculeUtilitaire::find($id);
          $vehicule->benne = $request->benne ? true : false;
        }

        $vehicule->disponible = $request->disponible ? true : false;
        $vehicule->immatriculation = $request->immatriculation;
        $vehicule->marque = $request->marque;
        $vehicule->modele = $request->modele;
        $vehicule->couleur = $request->couleur;
        $vehicule->poid = $request->poid;
        $vehicule->hauteur = $request->hauteur;
        $vehicule->places = $request->places;
        $vehicule->cout_par_jour = $request->coutParJour;
        $vehicule->date_anciennete = $request->dateAnciennete;
        $vehicule->contenance_coffre = $request->contenanceCoffre;
        $vehicule->save();

        return redirect()->route('vehicules');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $type = 'vehicule_leger')
    {
        if ($type == 'vehicule_leger') {
          VehiculeLeger::find($id)->delete();
        } else {
          VehiculeUtilitaire::find($id)->delete();
        }

        return redirect()->route('vehicules');
    }
}
