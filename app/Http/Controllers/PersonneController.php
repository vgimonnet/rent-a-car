<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use Illuminate\Http\Request;

class PersonneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/personnes', ['personnes' => Personne::paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view(
          'components/forms/form-personne',
          [
            'redirect' => 'ajouterPersonne',
            'employe' => null
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
          'prenom' => 'required|min:1',
          'permis' => 'required|min:1',
        ]);

        $personne = new Personne;
        $personne->prenom = $request->prenom;
        $personne->permis = $request->permis;

        $personne->save();
        return redirect()->route('personnes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employe  $personne
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personne = Personne::find($id);
        return view('/personnes', ['personne' => $personne]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view(
          'components/forms/form-personne',
          [
            'redirect' => 'modifierPersonne',
            'personne' => Personne::find($id),
          ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
          'prenom' => 'required|min:1',
          'permis' => 'required|min:1',
        ]);

        $personne = Personne::find($id);
        $personne->prenom = $request->prenom;
        $personne->permis = $request->permis;
        $personne->save();

        return redirect()->route('personnes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Personne::find($id)->delete();

        return redirect()->route('personnes');
    }
}
