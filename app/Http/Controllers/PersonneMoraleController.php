<?php

namespace App\Http\Controllers;

use App\Models\Coordonnee;
use App\Models\PersonneMorale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonneMoraleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'components/forms/form-personne-morale', 
            [
                'redirect' => 'AjouterPersonneMorale', 
                'personne' => null, 
                'btn' => 'Ajouter',
                'title' => 'Création d\'une personne morale'
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
            'societe' => 'required|min:1',
            'siret' => 'required|min:1', // Check detail about this field
            'email' => 'required|min:4|email:rfc,dns',
            'telephone' => 'required|min:10',
            'pays' => 'required|min:1',
            'ville' => 'required|min:1',
            'adresse' => 'required|min:1',
            'codePostal' => 'required|integer',
        ]);

        $personneMorale = new PersonneMorale();
        $personneMorale->societe = $request->societe;
        $personneMorale->siret = $request->siret;


        $coordonnee = new Coordonnee();
        $coordonnee->email = $request->email;
        $coordonnee->telephone = $request->telephone;
        $coordonnee->pays = $request->pays;
        $coordonnee->ville = $request->ville;
        $coordonnee->adresse = $request->adresse;
        $coordonnee->complement = $request->complement;
        $coordonnee->codePostal = $request->codePostal;

        DB::transaction(function() use($personneMorale, $coordonnee) {
            $personneMorale->save();
            $personneMorale->coordonnee()->save($coordonnee);
        });

        return redirect()->route('client');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersonneMorale  $personneMorale
     * @return \Illuminate\Http\Response
     */
    public function show(PersonneMorale $personneMorale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view(
            'components/forms/form-personne-morale', 
            [
                'redirect' => 'ModifierPersonneMorale', 
                'personne' => PersonneMorale::find($id),
                'btn' => 'Modifier',
                'title' => 'Modification d\'une personne morale'
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonneMorale  $personneMorale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'societe' => 'required|min:1',
            'siret' => 'required|min:1', // Check detail about this field
            'email' => 'required|min:4|email:rfc,dns',
            'telephone' => 'required|min:10',
            'pays' => 'required|min:1',
            'ville' => 'required|min:1',
            'adresse' => 'required|min:1',
            'codePostal' => 'required|integer',
        ]);
        
        $personneMorale = PersonneMorale::find($id);
        $personneMorale->societe = $request->societe;
        $personneMorale->siret = $request->siret;

        $coordonnee = $personneMorale->coordonnee;
        $coordonnee->email = $request->email;
        $coordonnee->telephone = $request->telephone;
        $coordonnee->pays = $request->pays;
        $coordonnee->ville = $request->ville;
        $coordonnee->adresse = $request->adresse;
        $coordonnee->complement = $request->complement;
        $coordonnee->codePostal = $request->codePostal;

        DB::transaction(function() use($personneMorale, $coordonnee) {
            $personneMorale->save();
            $personneMorale->coordonnee()->save($coordonnee);
        });

        return redirect()->route('client');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonneMorale  $personneMorale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PersonneMorale::find($id)->delete();

        return redirect()->route('client');
    }
}
