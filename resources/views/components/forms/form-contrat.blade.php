<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajout de contrat
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
                        if ($redirect == 'modifierContrat') {
                            $redirect = array($redirect, $contrat->id_contrat);
                        }
                        if (!isset($contrat)) {
                            $contrat = null;
                        }
                    @endphp
                    {!! Form::open(['route' => $redirect]) !!}
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            {{ Form::label('conducteurId', 'Conducteur') }}
                            {{ Form::select('conducteurId', $conducteurs, $contrat ? $contrat->id_conducteur : null) }}
                            {{ Form::label('employeId', 'Employé') }}
                            {{ Form::select('employeId', $employes, $contrat ? $contrat->id_employe : null) }}
                            {{ Form::label('vehiculeId', 'Véhicule') }}
                            {{ Form::select('vehiculeId', $vehicules, $contrat ? $contrat->id_vehicule.'@'.$contrat->type_vehicule : null) }}
                            {{ Form::label('dateDebut', 'Date de début') }}
                            {{ Form::date('dateDebut', $contrat ? $contrat->date_debut : null) }}
                            {{ Form::label('dateFin', 'Date de fin prévu') }}
                            {{ Form::date('dateFin', $contrat ? $contrat->date_fin : null) }}
                            {{ Form::label('dateRetour', 'Date de retour') }}
                            {{ Form::date('dateRetour', $contrat ? $contrat->date_retour : null) }}
                            {{ Form::label('motif', 'Motif') }}
                            {{ Form::text('motif', $contrat ? $contrat->motif : null) }}
                            {{ Form::label('montantPaye', 'Montant déjà payé') }}
                            {{ Form::number('montantPaye', $contrat ? $contrat->montant_paye : null) }}
                        </div>
                        <div class="text-center w-full">
                            {{ Form::submit($contrat ? 'Modifier' : 'Ajouter') }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
