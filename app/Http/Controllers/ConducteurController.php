<?php

namespace App\Http\Controllers;

use App\Models\Conducteur;
use App\Models\Coordonnee;
use App\Models\PersonneMorale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function create($type = 'personne_physique')
    {
        if ($type == 'personne_physique') {
            $params = [
                'type' => 'personne_physique',
                'title' => 'Création d\'une personne physique'
            ];
        } else {
            $params = [
                'type' => 'conducteur',
                'title' => 'Création d\'un conducteur',
                'societes' => $this->generationTableauSocietes(PersonneMorale::all())
            ];
        }

        return view(
            'components/forms/form-personne-physique', 
            array_merge($params, [
                'redirect' => 'AjouterPersonnePhysique', 
                'personne' => null,
                'btn' => 'Ajouter'
            ])
        );
        // return view(
        //   'components/forms/form-conducteur',
        //   [
        //     'redirect' => 'ajouterConducteur',
        //     'conducteur' => null,
        //   ]
        // );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type = 'personne_physique')
    {
        $validated = $request->validate([
            'nom' => 'required|min:1',
            'prenom' => 'required|min:1',
            'permis' => 'required|min:1', // check detail about this field
            'email' => 'required|min:4|email:rfc,dns',
            'telephone' => 'required|min:10',
            'pays' => 'required|min:1',
            'ville' => 'required|min:1',
            'adresse' => 'required|min:1',
            'codePostal' => 'required|integer',
        ]);

        $conducteur = new Conducteur();
        $conducteur->nom = $request->nom;
        $conducteur->prenom = $request->prenom;
        $conducteur->permis = $request->permis;
        if ($type == 'personne_physique') {
            $conducteur->est_particulier = true;
        } else {
            $conducteur->est_particulier = false;
            $personneMorale = PersonneMorale::find($request->societe);
            $conducteur->personneMorale()->associate($personneMorale);
        }

        $coordonnee = new Coordonnee();
        $coordonnee->email = $request->email;
        $coordonnee->telephone = $request->telephone;
        $coordonnee->pays = $request->pays;
        $coordonnee->ville = $request->ville;
        $coordonnee->adresse = $request->adresse;
        $coordonnee->complement = $request->complement;
        $coordonnee->codePostal = $request->codePostal;

        DB::transaction(function() use($conducteur, $coordonnee) {
            $conducteur->save();
            $conducteur->coordonnee()->save($coordonnee);
        });

        return redirect()->route('client');
        
        // $validated = $request->validate([
        //     'est_particulier' => 'required|min:1'
        // ]);

        // $conducteur = new Conducteur;
        // $conducteur->est_particulier = ($request->est_particulier === 'on') ? 1 : 0;
        // $conducteur->save();
        // return redirect()->route('conducteurs');

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
        return view(
          'components/forms/form-conducteur',
          [
            'redirect' => 'modifierConducteur',
            'conducteur' => Conducteur::find($id)
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
        $conducteur->est_particulier = ($request->est_particulier === 'on') ? 1 : 0;
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

    private function generationTableauSocietes($societes) {
        $societesArray = [];
        foreach ($societes as $societe) {
            $societesArray[$societe->id_personne_morale] = $societe->societe;
        }

        return $societesArray;
    }
}
