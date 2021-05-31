<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
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
                        if (!isset($personne)) {
                            $personne = null;
                        }
                        $redirect = array($redirect, $type);
                    @endphp
                    {!! Form::open(['route' => $redirect]) !!}
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <div class="col-12 col-md-4">
                                {{ Form::label('nom', 'Nom') }}
                                {{ Form::text('nom', $personne ? $personne->nom : null, ['placeholder' => 'Nom']) }}
                            </div>
                            <div class="col-12 col-md-4">
                                {{ Form::label('prenom', 'Prénom') }}
                                {{ Form::text('prenom', $personne ? $personne->prenom : null, ['placeholder' => 'Prénom']) }}
                            </div>
                            <div class="col-12 col-md-4">
                                {{ Form::label('permis', 'Permis') }}
                                {{ Form::text('permis', $personne ? $personne->permis : null, ['placeholder' => 'N° permis']) }}
                            </div>
                            @if ($type == 'conducteur')
                                <div class="col-12 col-md-6">
                                    {{ Form::label('societe', 'Société') }}
                                    {{ Form::select('societe', $societes, $personne && $personne->personneMorale ? $personne->personneMorale->id_personne_morale : null) }}
                                </div>
                            @endif
                        </div>
                        <h3 class="mt-10 mb-4">Coordonnées :</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="col-12 col-md-6">
                                {{ Form::label('email', 'Email') }}
                                {{ Form::text('email', $personne && $personne->coordonnee ? $personne->coordonnee->email : null, ['placeholder' => 'Email']) }}
                            </div>
                            <div class="col-12 col-md-6">
                                {{ Form::label('telephone', 'Téléphone') }}
                                {{ Form::text('telephone', $personne && $personne->coordonnee ? $personne->coordonnee->telephone : null, ['placeholder' => 'Téléphone']) }}
                            </div>
                            <div class="col-12 col-md-6">
                                {{ Form::label('pays', 'Pays') }}
                                {{ Form::text('pays', $personne && $personne->coordonnee ? $personne->coordonnee->pays : null, ['placeholder' => 'Pays']) }}
                            </div>
                            <div class="col-12 col-md-6">
                                {{ Form::label('ville', 'Ville') }}
                                {{ Form::text('ville', $personne && $personne->coordonnee ? $personne->coordonnee->ville : null, ['placeholder' => 'Ville']) }}
                            </div>
                            <div class="col-12 col-md-6">
                                {{ Form::label('adresse', 'Adresse') }}
                                {{ Form::text('adresse', $personne && $personne->coordonnee ? $personne->coordonnee->adresse : null, ['placeholder' => 'Adresse']) }}
                            </div>
                            <div class="col-12 col-md-6">
                                {{ Form::label('complement', 'Complément d\'adresse') }}
                                {{ Form::text('complement', $personne && $personne->coordonnee ? $personne->coordonnee->complement : null, ['placeholder' => 'Étage, porte, ...']) }}
                            </div>
                            <div class="col-12 col-md-6">
                                {{ Form::label('codePostal', 'Code postal') }}
                                {{ Form::number('codePostal', $personne && $personne->coordonnee ? $personne->coordonnee->codePostal : null) }}
                            </div>
                        </div>
                        <div class="text-center w-full">
                            {{ Form::submit($btn) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
