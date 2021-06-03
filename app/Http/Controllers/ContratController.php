<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Vehicule;
use App\Models\Conducteur;
use App\Models\Employe;
use App\Models\VehiculeLeger;
use App\Models\VehiculeUtilitaire;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/contrats', ['contrats' => Contrat::paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conducteurs = [];

        foreach (Conducteur::all() as $conducteur) {
          $conducteurs[$conducteur->id_conducteur] = strtoupper($conducteur->nom).' '.$conducteur->prenom.(!$conducteur->estParticulier?:' ('.$conducteur->personneMorale->societe.')');
        }

        $employes = [];

        foreach (Employe::all() as $employe) {
          $employes[$employe->id_employe] = strtoupper($employe->nom).' '.$employe->prenom.' ('.$employe->poste.')';
        }

        $vehicules = [];
        foreach (VehiculeLeger::where('disponible', '=', 1)->get() as $vehicule) {
          $vehicules[$vehicule->id_vehicule.'@vehicule_leger'] = strtoupper($vehicule->marque).' '.$vehicule->model.' ('.$vehicule->immatriculation.')';
        }
        foreach (VehiculeUtilitaire::where('disponible', '=', 1)->get() as $vehicule) {
          $vehicules[$vehicule->id_vehicule.'@vehicule_utilitaire'] = strtoupper($vehicule->marque).' '.$vehicule->model.' ('.$vehicule->immatriculation.')';
        }

        return view(
          'components/forms/form-contrat',
          [
            'redirect' => 'ajouterContrat',
            'contrat' => null,
            'conducteurs' => $conducteurs,
            'employes' => $employes,
            'vehicules' => $vehicules
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
          'conducteurId' => 'required|min:1',
          'employeId' => 'required|min:1',
          'vehiculeId' => 'required|min:1',
          'dateDebut' => 'required',
          'dateFin' => 'required|gte:dateDebut',
          'motif' => 'required|min:1',
          'montantPaye' => 'required|min:1'
        ]);

        $diff = abs(strtotime($request->dateFin) - strtotime($request->dateDebut));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)) + 1;
        


        $vehiculeInfo = explode('@', $request->vehiculeId);

        $contrat = new Contrat;

        $contrat->date_debut = $request->dateDebut;
        $contrat->date_fin = $request->dateFin;
        $contrat->date_retour = $request->dateRetour;
        $contrat->motif = $request->motif;
        $contrat->montant_paye = $request->montantPaye;

        $contrat->id_conducteur = $request->conducteurId;
        $conducteur = Conducteur::find($request->conducteurId);
        $contrat->conducteur()->associate($conducteur);

        $contrat->id_employe = $request->employeId;
        $employe = Employe::find($request->employeId);
        $contrat->employe()->associate($employe);

        $contrat->id_vehicule = $vehiculeInfo[0];
        if ($vehiculeInfo[1] == 'leger') {
          $vehicule = VehiculeLeger::find($vehiculeInfo[0]);
          $vehicule->est_disponible = false;
          $contrat->type_vehicule = 'vehicule_leger';
          $contrat->montant = $days * $vehicule->cout_par_jour;
        } else {
          $vehicule = VehiculeUtilitaire::find($vehiculeInfo[0]);
          $vehicule->est_disponible = false;
          $contrat->type_vehicule = 'vehicule_utilitaire';
          $contrat->montant = $days * $vehicule->cout_par_jour;
        }
        $vehicule->contrats()->save($contrat);
        
        return redirect()->route('contrats');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contrat  $contrat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrat = Contrat::find($id);
        return view('/contrat', ['contrat' => $contrat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contrat  $contrat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conducteurs = [];

        foreach (Conducteur::all() as $conducteur) {
          $conducteurs[$conducteur->id_conducteur] = strtoupper($conducteur->nom).' '.$conducteur->prenom.(!$conducteur->estParticulier?:' ('.$conducteur->personneMorale->societe.')');
        }

        $employes = [];

        foreach (Employe::all() as $employe) {
          $employes[$employe->id_employe] = strtoupper($employe->nom).' '.$employe->prenom.' ('.$employe->poste.')';
        }

        $vehicules = [];
        foreach (VehiculeLeger::all() as $vehicule) {
          $vehicules[$vehicule->id_vehicule.'@vehicule_leger'] = strtoupper($vehicule->marque).' '.$vehicule->model.' ('.$vehicule->immatriculation.')';
        }
        foreach (VehiculeUtilitaire::all() as $vehicule) {
          $vehicules[$vehicule->id_vehicule.'@vehicule_utilitaire'] = strtoupper($vehicule->marque).' '.$vehicule->model.' ('.$vehicule->immatriculation.')';
        }
        return view(
          'components/forms/form-contrat',
          [
            'redirect' => 'modifierContrat',
            'contrat' => Contrat::find($id),
            'conducteurs' => $conducteurs,
            'employes' => $employes,
            'vehicules' => $vehicules
          ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contrat  $contrat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validated = $request->validate([
        'conducteurId' => 'required|min:1',
        'employeId' => 'required|min:1',
        'vehiculeId' => 'required|min:1',
        'dateDebut' => 'required',
        'dateFin' => 'required|gte:dateDebut',
        'motif' => 'required|min:1',
        'montantPaye' => 'required|min:1'
      ]);

      $diff = abs(strtotime($request->dateFin) - strtotime($request->dateDebut));
      $years = floor($diff / (365*60*60*24));
      $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
      $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)) + 1;
      


      $vehiculeInfo = explode('@', $request->vehiculeId);

      $contrat = Contrat::find($id);

      $contrat->date_debut = $request->dateDebut;
      $contrat->date_fin = $request->dateFin;
      $contrat->date_retour = $request->dateRetour;
      $contrat->motif = $request->motif;
      $contrat->montant_paye = $request->montantPaye;

      $contrat->id_conducteur = $request->conducteurId;
      $conducteur = Conducteur::find($request->conducteurId);
      $contrat->conducteur()->associate($conducteur);

      $contrat->id_employe = $request->employeId;
      $employe = Employe::find($request->employeId);
      $contrat->employe()->associate($employe);

      $contrat->id_vehicule = $vehiculeInfo[0];
      if ($vehiculeInfo[1] == 'leger') {
        $vehicule = VehiculeLeger::find($vehiculeInfo[0]);
        $contrat->type_vehicule = 'vehicule_leger';
        $contrat->montant = $days * $vehicule->cout_par_jour;
      } else {
        $vehicule = VehiculeUtilitaire::find($vehiculeInfo[0]);
        $contrat->type_vehicule = 'vehicule_utilitaire';
        $contrat->montant = $days * $vehicule->cout_par_jour;
      }
      $vehicule->contrats()->save($contrat);
      
      return redirect()->route('contrats');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contrat  $contrat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contrat::find($id)->delete();

        return redirect()->route('contrats');
    }
}
