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
    public function edit(ControleEtat $controleEtat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ControleEtat  $controleEtat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ControleEtat $controleEtat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ControleEtat  $controleEtat
     * @return \Illuminate\Http\Response
     */
    public function destroy(ControleEtat $controleEtat)
    {
        //
    }
}