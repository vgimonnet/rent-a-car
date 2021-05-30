<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajout de véhicule
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
                        if ($redirect == 'modifierVehicule') {
                            $redirect = array($redirect, $vehicule->immatriculation);
                        }
                        if (!isset($vehicule)) {
                            $vehicule = null;
                        }
                    @endphp
                    {!! Form::open(['route' => $redirect]) !!}
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            {{ Form::text('immatriculation', $vehicule ? $vehicule->immatriculation : null, ['placeholder' => 'Immatriculation']) }}
                            {{ Form::text('marque', $vehicule ? $vehicule->marque : null, ['placeholder' => 'Marque']) }}
                            {{ Form::text('modele', $vehicule ? $vehicule->modele : null, ['placeholder' => 'Modèle']) }}
                            {{ Form::text('couleur', $vehicule ? $vehicule->couleur : null, ['placeholder' => 'Couleur']) }}
                            {{ Form::text('poids', $vehicule ? $vehicule->poids : null, ['placeholder' => 'Poids']) }}
                            {{ Form::text('hauteur', $vehicule ? $vehicule->hauteur : null, ['placeholder' => 'Hauteur']) }}
                            {{ Form::text('places', $vehicule ? $vehicule->places : null, ['placeholder' => 'Places']) }}
                            {{ Form::text('coutParJour', $vehicule ? $vehicule->cout_par_jour : null, ['placeholder' => 'Cout par jour']) }}
                            {{ Form::date('dateAchat', $vehicule ? $vehicule->date_achat : null, ['placeholder' => 'Date Achat']) }}
                            {{ Form::text('contenanceCoffre', $vehicule ? $vehicule->contenance_coffre : null, ['placeholder' => 'Contenance coffre']) }}
                        </div>
                        <div class="text-center w-full">
                            {{ Form::submit($vehicule ? 'Modifier' : 'Ajouter') }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
