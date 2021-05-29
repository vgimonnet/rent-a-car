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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('/controles-technique', ['controleTechnique' => $controle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ControleTechnique  $controleTechnique
     * @return \Illuminate\Http\Response
     */
    public function edit(ControleTechnique $controleTechnique)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ControleTechnique  $controleTechnique
     * @return \Illuminate\Http\Response
     */
    public function destroy(ControleTechnique $controleTechnique)
    {
        //
    }
}
