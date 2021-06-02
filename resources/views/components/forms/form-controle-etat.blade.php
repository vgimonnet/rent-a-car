<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajout d'un controle d'état
        </h2>
    </x-slot>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $error }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endforeach
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @php
                        if ($redirect == 'modifierControleEtat') {
                            $redirect = array($redirect, $controle->id_controle_etat);
                        }
                        if (!isset($controle)) {
                            $controle = null;
                        }
                    @endphp
                    {!! Form::open(['route' => $redirect]) !!}
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            {{ Form::label('id_contrat', 'Contrat') }}
                            {{ Form::select('id_contrat', $contrats, $controle ? $controle->id_contrat : null) }}
                            {{ Form::label('id_employe', 'Employé') }}
                            {{ Form::select('id_employe', $employes, $controle ? $controle->id_employe : null) }}
                            {{ Form::label('type', 'Entrée ou sortie') }}
                            {{ Form::select('type', ['entree' => 'Entrée', 'sortie' => 'Sortie']) }}
                            {{ Form::label('date', 'Date') }}
                            {{ Form::date('date', $controle ? $controle->date : null, ['placeholder' => 'Date']) }}
                            {{ Form::label('kilometrage', 'Kilométrage') }}
                            {{ Form::text('kilometrage', $controle ? $controle->kilometrage : null, ['placeholder' => 'Kilometrage']) }}
                            {{ Form::label('etatExterieur', 'Etat extérieur') }}
                            {{ Form::text('etatExterieur', $controle ? $controle->etat_exterieur : null, ['placeholder' => 'état extérieur']) }}
                            {{ Form::label('etatInterieur', 'Etat intérieur') }}
                            {{ Form::text('etatInterieur', $controle ? $controle->etat_interieur : null, ['placeholder' => 'état intérieur']) }}
                            {{ Form::label('fraisAPrevoir', 'Frais à prévoir') }}
                            {{ Form::checkbox('fraisAPrevoir', $controle ? $controle->frais_a_prevoir : null, ['checked' => $controle ? $controle->fraisAPrevoir : false]) }}
                        </div>
                        <div class="text-center w-full">
                            {{ Form::submit($controle ? 'Modifier' : 'Ajouter') }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
