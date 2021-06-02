<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\ControleEtat;
use App\Models\Employe;
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
        $employes = [];
        foreach (Employe::all() as $employe) {
          $employes[$employe->id_employe] = $employe->nom.' '.$employe->prenom.' ('.$employe->poste.')';
        }

        $contrats = [];
        foreach (Contrat::all() as $contrat) {
          $contrats[$contrat->id_contrat] = $contrat->getInfo();
        }

        return view(
          'components/forms/form-controle-etat',
          [
            'redirect' => 'ajouterControleEtat',
            'controle' => null,
            'employes' => $employes,
            'contrats' => $contrats
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
          'id_contrat' => 'required',
          'id_employe' => 'required',
          'date' => 'required|min:1',
          'kilometrage' => 'required|min:1',
          'etatExterieur' => 'required|min:1',
          'etatInterieur' => 'required|min:1',
        ]);

        $controle = new ControleEtat;
        $controle->date = $request->date;
        $controle->kilometrage = $request->kilometrage;
        $controle->etat_exterieur = $request->etatExterieur;
        $controle->etat_interieur = $request->etatInterieur;
        $controle->frais_a_prevoir = $request->fraisAPrevoir ? 1 : 0;
        $controle->type = $request->type;
        
        $employe = Employe::find($request->id_employe);
        $controle->id_employe = $request->id_employe;
        $employe->controles_etat()->save($controle);
        
        $contrat = Contrat::find($request->id_contrat);
        $controle->id_contrat = $request->id_contrat;
        if ($request->type == 'entree') {
          $contrat->controle_etat_entree()->save($controle);
        } else if ($request->type == 'sortie') {
          $contrat->controle_etat_sortie()->save($controle);
        }

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
        $employes = [];
        foreach (Employe::all() as $employe) {
          $employes[$employe->id_employe] = $employe->nom.' '.$employe->prenom.' ('.$employe->poste.')';
        }

        $contrats = [];
        foreach (Contrat::all() as $contrat) {
          $contrats[$contrat->id_contrat] = $contrat->getInfo();
        }

        return view(
          'components/forms/form-controle-etat',
          [
            'redirect' => 'modifierControleEtat',
            'controle' => ControleEtat::find($id),
            'employes' => $employes,
            'contrats' => $contrats
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
        'id_contrat' => 'required',
        'id_employe' => 'required',
        'date' => 'required|min:1',
        'kilometrage' => 'required|min:1',
        'etatExterieur' => 'required|min:1',
        'etatInterieur' => 'required|min:1',
      ]);

      $controle = ControleEtat::find($id);
      $controle->date = $request->date;
      $controle->kilometrage = $request->kilometrage;
      $controle->etat_exterieur = $request->etatExterieur;
      $controle->etat_interieur = $request->etatInterieur;
      $controle->frais_a_prevoir = $request->fraisAPrevoir ? 1 : 0;
      $controle->type = $request->type;
      
      $employe = Employe::find($request->id_employe);
      $controle->id_employe = $request->id_employe;
      $employe->controles_etat()->save($controle);
      
      $contrat = Contrat::find($request->id_contrat);
      $controle->id_contrat = $request->id_contrat;
      if ($request->type == 'entree') {
        $contrat->controle_etat_entree()->save($controle);
      } else if ($request->type == 'sortie') {
        $contrat->controle_etat_sortie()->save($controle);
      }

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
