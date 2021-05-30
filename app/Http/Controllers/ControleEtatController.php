<?php

namespace App\Http\Controllers;

use App\Models\ControleEtat;
use Illuminate\Http\Request;

class ControleEtatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/controles-etat', ['controlesEtat' => ControleEtat::paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
          'components/forms/form-controle-etat',
          [
            'redirect' => 'ajouterControleEtat',
            'controle' => null
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
          'date' => 'required|min:1',
          'kilometrage' => 'required|min:1',
          'etatExterieur' => 'required|min:1',
          'etatInterieur' => 'required|min:1',
          'fraisAPrevoir' => 'required|min:1',
        ]);

        $controle = new ControleEtat;
        $controle->date = $request->date;
        $controle->kilometrage = $request->kilometrage;
        $controle->etat_exterieur = $request->etatExterieur;
        $controle->etat_interieur = $request->etatInterieur;
        $controle->frais_a_prevoir = $request->fraisAPrevoir;
        $controle->save();
        return redirect()->route('controlesEtat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ControleEtat  $controleEtat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $controle = ControleEtat::find($id);
        return view('/controles-etat', ['controleEtat' => $controle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ControleEtat  $controleEtat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view(
          'components/forms/form-controle-etat',
          [
            'redirect' => 'modifierControleEtat',
            'controle' => ControleEtat::find($id)
          ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ControleEtat  $controleEtat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
          'date' => 'required|min:1',
          'kilometrage' => 'required|min:1',
          'etatExterieur' => 'required|min:1',
          'etatInterieur' => 'required|min:1',
          'fraisAPrevoir' => 'required|min:1',
        ]);

        $controle = ControleEtat::find($id);
        $controle->date = $request->date;
        $controle->kilometrage = $request->kilometrage;
        $controle->etatExterieur = $request->etatExterieur;
        $controle->etatInterieur = $request->etatInterieur;
        $controle->fraisAPrevoir = $request->fraisAPrevoir;
        $controle->save();
        return redirect()->route('controlesEtat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ControleEtat  $controleEtat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ControleEtat::find($id)->delete();

        return redirect()->route('controlesEtat');
    }
}
