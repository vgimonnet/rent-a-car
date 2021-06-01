<?php

namespace App\Http\Controllers;

use App\Models\Conducteur;
use App\Models\Personne;
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
        /*$personnes = [];

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
          );*/
          
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

        /*if ($request->est_particulier === 'on') {
          $conducteur->est_particulier = 1;
          $conducteur->id_personne = $request->id_personne;
        } else {
          $conducteur->est_particulier = 0;
          $conducteur->id_personne = $request->id_personne_morale;
        }
        $conducteur->save();
        return redirect()->route('conducteurs');*/
        $conducteur = new Conducteur();
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
    public function edit($id, $type = 'personne_physique')
    {

        /*$personnes = [];

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
          );*/

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
                'redirect' => 'ModifierPersonnePhysique', 
                'personne' => Conducteur::find($id),
                'btn' => 'Modifier'
            ])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conducteur  $conducteur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $type = 'personne_physique')
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

        $conducteur = Conducteur::find($id);
        /*if ($request->est_particulier === 'on') {
          $conducteur->est_particulier = 1;
          $conducteur->id_personne = $request->id_personne;
        } else {
          $conducteur->est_particulier = 0;
          $conducteur->id_personne = $request->id_personne_morale;
        }
        $conducteur->save();
        return redirect()->route('conducteurs');*/
        
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

        $coordonnee = $conducteur->coordonnee;
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

        return redirect()->route('client');
    }

    private function generationTableauSocietes($societes) {
        $societesArray = [];
        foreach ($societes as $societe) {
            $societesArray[$societe->id_personne_morale] = $societe->societe;
        }

        return $societesArray;
    }
}
