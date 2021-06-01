<?php

namespace App\Http\Controllers;

use App\Models\ControleTechnique;
use App\Models\Vehicule;
use App\Models\VehiculeLeger;
use App\Models\VehiculeUtilitaire;
use Illuminate\Http\Request;

class ControleTechniqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/controles-technique', ['controlesTechnique' => ControleTechnique::paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicules = [];

        foreach (array_merge(VehiculeLeger::all()->toArray(), VehiculeUtilitaire::all()->toArray()) as $vehicule) {
          $vehicules[$vehicule['immatriculation']] = $vehicule['marque'].' '.$vehicule['modele'].' imat : '.$vehicule['immatriculation'];
        }

        return view(
          'components/forms/form-controle-technique',
          [
            'redirect' => 'ajouterControleTechnique',
            'controleTechnique' => null,
            'vehicules' => $vehicules
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
          'dateControle' => 'required|min:1',
          'commentaire' => 'required|min:1',
          'immatriculation' => 'required|min:1'
        ]);


        $controle = new ControleTechnique;
        $controle->conforme = ($request->conforme === 'on') ? 1 : 0;
        $controle->date_controle = $request->dateControle;
        $controle->contre_visite = ($request->contreVisite === 'on') ? 1 : 0;
        $controle->date_contre_visite = $request->dateContreVisite;
        $controle->commentaire = $request->commentaire;
        $controle->id_vehicule = $request->immatriculation;

        $vehicule = VehiculeLeger::where('immatriculation', '=', $request->immatriculation)->get();
        if (sizeof($vehicule) < 1) {
          $vehicule = VehiculeUtilitaire::where('immatriculation', '=', $request->immatriculation)->get();
        }

        if (sizeof($vehicule) > 0) {
          $vehicule[0]->controles_technique()->save($controle);
        }

        return redirect()->route('controlesTechnique');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ControleTechnique  $controleTechnique
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $controle = ControleTechnique::find($id);
        return view('/components/single', ['single' => $controle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ControleTechnique  $controleTechnique
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicules = [];

        foreach (array_merge(VehiculeLeger::all()->toArray(), VehiculeUtilitaire::all()->toArray()) as $vehicule) {
          $vehicules[$vehicule['immatriculation']] = $vehicule['marque'].' '.$vehicule['modele'].' imat : '.$vehicule['immatriculation'];
        }

        return view(
          'components/forms/form-controle-technique',
          [
            'redirect' => 'modifierControleTechnique',
            'controleTechnique' => ControleTechnique::find($id),
            'vehicules' => $vehicules
          ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ControleTechnique  $controleTechnique
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validated = $request->validate([
        'dateControle' => 'required|min:1',
        'commentaire' => 'required|min:1',
        'immatriculation' => 'required|min:1'
      ]);


      $controle = ControleTechnique::find($id);
      $controle->conforme = ($request->conforme === 'on') ? 1 : 0;
      $controle->date_controle = $request->dateControle;
      $controle->contre_visite = ($request->contreVisite === 'on') ? 1 : 0;
      $controle->date_contre_visite = $request->dateContreVisite;
      $controle->commentaire = $request->commentaire;
      $controle->id_vehicule = $request->immatriculation;

      $vehicule = VehiculeLeger::where('immatriculation', '=', $request->immatriculation)->get();
      if (sizeof($vehicule) < 1) {
        $vehicule = VehiculeUtilitaire::where('immatriculation', '=', $request->immatriculation)->get();
      }

      if (sizeof($vehicule) > 0) {
        $vehicule[0]->controles_technique()->save($controle);
      }

      return redirect()->route('controlesTechnique');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ControleTechnique  $controleTechnique
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ControleTechnique::find($id)->delete();

        return redirect()->route('controlesTechnique');
    }
}
