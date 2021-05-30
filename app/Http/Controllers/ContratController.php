<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
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
        return view(
          'components/forms/form-contrat',
          [
            'redirect' => 'ajouterContrat',
            'contrat' => null,
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
          'vehiculeId' => 'required|min:1',
          'conducteurId' => 'required|min:1',
          'employeId' => 'required|min:1'
        ]);

        $contrat = new Contrat;
        $contrat->vehicule_id = $request->vehiculeId;
        $contrat->conducteur_id = $request->conducteurId;
        $contrat->employe_id = $request->employeId;
        $contrat->save();
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
        return view('/contrats', ['contrat' => $contrat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contrat  $contrat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view(
          'components/forms/form-contrat',
          [
            'redirect' => 'modifierContrat',
            'contrat' => Contrat::find($id)
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
          'vehiculeId' => 'required|min:1',
          'conducteurId' => 'required|min:1',
          'employeId' => 'required|min:1'
        ]);

        $contrat = Contrat::find($id);
        $contrat->vehicule_id = $request->vehiculeId;
        $contrat->conducteur_id = $request->conducteurId;
        $contrat->employe_id = $request->employeId;
        $contrat->save();
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
        Contrat::find($id);

        return redirect()->route('contrats');
    }
}
