<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/vehicules', ['vehicules' => Vehicule::paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
          'components/forms/form-vehicule',
          [
            'redirect' => 'ajouterVehicule',
            'vehicule' => null,
          ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
          'immatriculation' => 'required|min:7',
          'marque' => 'required|min:1',
          'modele' => 'required|min:1',
          'couleur' => 'required|min:1',
          'poids' => 'required|integer',
          'hauteur' => 'required|integer',
          'places' => 'required|integer',
          'coutParJour' => 'required|min:1',
          'dateAchat' => 'required|min:1',
          'contenanceCoffre' => 'required|integer',
        ]);

        $vehicule = new Vehicule;
        $vehicule->disponible = true;
        $vehicule->immatriculation = $request->immatriculation;
        $vehicule->marque = $request->marque;
        $vehicule->modele = $request->modele;
        $vehicule->couleur = $request->couleur;
        $vehicule->poids = $request->poids;
        $vehicule->hauteur = $request->hauteur;
        $vehicule->places = $request->places;
        $vehicule->cout_par_jour = $request->coutParJour;
        $vehicule->date_achat = $request->dateAchat;
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
    public function edit($id)
    {
        return view(
          'components/forms/form-vehicule',
          [
            'redirect' => 'modifierVehicule',
            'vehicule' => Vehicule::find($id)
          ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validated = $request->validate([
          'immatriculation' => 'required|min:7',
          'marque' => 'required|min:1',
          'modele' => 'required|min:1',
          'couleur' => 'required|min:1',
          'poids' => 'required|integer',
          'hauteur' => 'required|integer',
          'places' => 'required|integer',
          'coutParJour' => 'required|min:1',
          'dateAchat' => 'required|min:1',
          'contenanceCoffre' => 'required|integer',
        ]);

        $vehicule = Vehicule::find($id);
        $vehicule->disponible = true;
        $vehicule->immatriculation = $request->immatriculation;
        $vehicule->marque = $request->marque;
        $vehicule->modele = $request->modele;
        $vehicule->couleur = $request->couleur;
        $vehicule->poids = $request->poids;
        $vehicule->hauteur = $request->hauteur;
        $vehicule->places = $request->places;
        $vehicule->cout_par_jour = $request->coutParJour;
        $vehicule->date_achat = $request->dateAchat;
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
    public function destroy($id)
    {
        Vehicule::find($id)->delete();

        return redirect()->route('vehicules');
    }
}
