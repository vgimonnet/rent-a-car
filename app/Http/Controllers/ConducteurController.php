<?php

namespace App\Http\Controllers;

use App\Models\Conducteur;
use App\Models\Personne;
use App\Models\PersonneMorale;
use Illuminate\Http\Request;

class ConducteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/conducteurs', ['conducteurs' => Conducteur::paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personnes = [];

        foreach (Personne::all() as $personne) {
          $personnes[$personne->id_personne] = $personne->id_personne;
        }

        $personnesMorale = [];

        foreach (PersonneMorale::all() as $personne) {
          $personnesMorale[$personne->id_personne_morale] = $personne->id_personne_morale;
        }

        return view(
          'components/forms/form-conducteur',
          [
            'redirect' => 'ajouterConducteur',
            'conducteur' => null,
            'personnes' => $personnes,
            'personnesMorale' => $personnesMorale
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
          'est_particulier' => 'required|min:1'
        ]);

        $conducteur = new Conducteur;
        if ($request->est_particulier === 'on') {
          $conducteur->est_particulier = 1;
          $conducteur->id_personne = $request->id_personne;
        } else {
          $conducteur->est_particulier = 0;
          $conducteur->id_personne = $request->id_personne_morale;
        }
        $conducteur->save();
        return redirect()->route('conducteurs');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conducteur  $conducteur
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conducteur = Conducteur::find($id);
        return view('/conducteurs', ['conducteur' => $conducteur]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conducteur  $conducteur
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $personnes = [];

        foreach (Personne::all() as $personne) {
          $personnes[$personne->id_personne] = $personne->id_personne;
        }

        $personnesMorale = [];

        foreach (PersonneMorale::all() as $personne) {
          $personnesMorale[$personne->id_personne_morale] = $personne->id_personne_morale;
        }

        return view(
          'components/forms/form-conducteur',
          [
            'redirect' => 'modifierConducteur',
            'conducteur' => Conducteur::find($id),
            'personnes' => $personnes,
            'personnesMorale' => $personnesMorale
          ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conducteur  $conducteur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
          'est_particuler' => 'required|min:1'
        ]);

        $conducteur = Conducteur::find($id);
        if ($request->est_particulier === 'on') {
          $conducteur->est_particulier = 1;
          $conducteur->id_personne = $request->id_personne;
        } else {
          $conducteur->est_particulier = 0;
          $conducteur->id_personne = $request->id_personne_morale;
        }
        $conducteur->save();
        return redirect()->route('conducteurs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conducteur  $conducteur
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Conducteur::find($id)->delete();

        return redirect()->route('conducteurs');
    }
}
