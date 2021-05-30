<?php

namespace App\Http\Controllers;

use App\Models\ControleTechnique;
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
        return view(
          'components/forms/form-controle-technique',
          [
            'redirect' => 'ajouterControleTechnique',
            'controleTechnique' => null,
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
          'conforme' => 'accepted',
          'dateControle' => 'required|min:1',
          'contreVisite' => 'accepted',
          'dateContreVisite' => 'required|min:1',
          'commentaire' => 'required|min:1',
        ]);

        $controle = new ControleTechnique;
        $controle->conforme = ($request->conforme === 'on') ? 1 : 0;
        $controle->date_controle = $request->dateControle;
        $controle->contre_visite = ($request->contreVisite === 'on') ? 1 : 0;
        $controle->date_contre_visite = $request->dateContreVisite;
        $controle->commentaire = $request->commentaire;
        $controle->save();
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
        return view(
          'components/forms/form-controle-technique',
          [
            'redirect' => 'modifierControleTechnique',
            'controleTechnique' => ControleTechnique::find($id)
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
    public function update(Request $request, ControleTechnique $controleTechnique)
    {
        $validated = $request->validate([
          'conforme' => 'required|integer',
          'date_controle' => 'required|min:1',
          'contre_visite' => 'required|integer',
          'date_contre_visite' => 'required|min:1',
          'commentaire' => 'required|min:1',
        ]);

        $controle = new ControleTechnique;
        $controle->conforme = $request->conforme;
        $controle->dateControle = $request->dateControle;
        $controle->contreVisite = $request->contreVisite;
        $controle->dateContreVisite = $request->dateContreVisite;
        $controle->commentaire = $request->commentaire;
        $controle->save();
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
