<?php

namespace App\Http\Controllers;

use App\Models\Conducteur;
use Illuminate\Http\Request;

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
    public function create()
    {
        return view(
          'components/forms/form-conducteur',
          [
            'redirect' => 'ajouterConducteur',
            'conducteur' => null,
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
          'est_particulier' => 'required|min:1'
        ]);

        $conducteur = new Conducteur;
        $conducteur->est_particulier = ($request->est_particulier === 'on') ? 1 : 0;
        $conducteur->save();
        return redirect()->route('conducteurs');

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
    public function edit($id)
    {
        return view(
          'components/forms/form-conducteur',
          [
            'redirect' => 'modifierConducteur',
            'conducteur' => Conducteur::find($id)
          ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conducteur  $conducteur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
          'est_particuler' => 'required|min:1'
        ]);

        $conducteur = Conducteur::find($id);
        $conducteur->est_particulier = ($request->est_particulier === 'on') ? 1 : 0;
        $conducteur->save();
        return redirect()->route('conducteurs');
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

        return redirect()->route('conducteurs');
    }
}
