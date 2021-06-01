<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Personne;
use Illuminate\Http\Request;

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
        $personnes = [];

        foreach (Personne::all() as $personne) {
          $personnes[$personne->id_personne] = $personne->prenom;
        }
        
        return view(
          'components/forms/form-employe',
          [
            'redirect' => 'ajouterEmploye',
            'employe' => null,
            'personnes' => $personnes
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
          'id_personne' => 'required|min:1',
          'poste' => 'required|min:1',
        ]);

        $employe = new Employe;
        $employe->id_personne = $request->id_personne;
        $employe->poste = $request->poste;

        $employe->save();
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
        $personnes = [];

        foreach (Personne::all() as $personne) {
          $personnes[$personne->id_personne] = $personne->prenom;
        }

        return view(
          'components/forms/form-employe',
          [
            'redirect' => 'modifierEmploye',
            'employe' => Employe::find($id),
            'personnes' => $personnes
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
          'id_personne' => 'required|min:1',
          'poste' => 'required|min:1',
        ]);

        $employe = Employe::find($id);
        $employe->id_personne = $request->id_personne;
        $employe->poste = $request->permis;
        $employe->save();

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
