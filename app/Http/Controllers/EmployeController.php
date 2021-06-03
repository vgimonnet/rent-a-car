<?php

namespace App\Http\Controllers;

use App\Models\Coordonnee;
use App\Models\Employe;
use App\Models\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/employes', ['employes' => Employe::paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
          'components/forms/form-employe',
          [
            'redirect' => 'ajouterEmploye',
            'employe' => null,
            'btn' => 'Ajouter',
            'title' => 'Création d\'un employé'
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
          'poste' => 'required|min:1',
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

        $employe = new Employe;
        $employe->poste = $request->poste;
        $employe->prenom = $request->prenom;
        $employe->nom = $request->nom;
        $employe->permis = $request->permis;

        $coordonnee = new Coordonnee();
        $coordonnee->email = $request->email;
        $coordonnee->telephone = $request->telephone;
        $coordonnee->pays = $request->pays;
        $coordonnee->ville = $request->ville;
        $coordonnee->adresse = $request->adresse;
        $coordonnee->complement = $request->complement ? $request->complement : '';
        $coordonnee->codePostal = $request->codePostal;

        DB::transaction(function() use($employe, $coordonnee) {
            $employe->save();
            // $employe->coordonnee()->save($coordonnee);
            $coordonnee->personne()->associate($coordonnee)->save();
        });

        return redirect()->route('employes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employe = Employe::find($id);
        return view('/employes', ['employe' => $employe]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return view(
        'components/forms/form-employe',
        [
          'redirect' => 'modifierEmploye',
          'employe' => Employe::find($id),
          'btn' => 'Ajouter',
          'title' => 'Création d\'un employé'
        ]
      );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
          'poste' => 'required|min:1',
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

        $employe = Employe::find($id);
        $employe->poste = $request->poste;
        $employe->prenom = $request->prenom;
        $employe->nom = $request->nom;
        $employe->permis = $request->permis;

        $coordonnee = $employe->coordonnee;
        $coordonnee->email = $request->email;
        $coordonnee->telephone = $request->telephone;
        $coordonnee->pays = $request->pays;
        $coordonnee->ville = $request->ville;
        $coordonnee->adresse = $request->adresse;
        $coordonnee->complement = $request->complement;
        $coordonnee->codePostal = $request->codePostal;

        DB::transaction(function() use($employe, $coordonnee) {
            $employe->save();
            $employe->coordonnee()->save($coordonnee);
        });
        
        return redirect()->route('employes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employe::find($id)->delete();

        return redirect()->route('employes');
    }
}
