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
                        if ($redirect == 'modifierEmploye') {
                            $redirect = array($redirect, $employe->id_employe);
                        }
                        if (!isset($employe)) {
                            $employe = null;
                        }
                    @endphp
                    {!! Form::open(['route' => $redirect]) !!}
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <div class="col-12 col-md-4">
                                {{ Form::label('nom', 'Nom') }}
                                {{ Form::text('nom', $employe ? $employe->nom : null, ['placeholder' => 'Nom']) }}
                            </div>
                            <div class="col-12 col-md-4">
                                {{ Form::label('prenom', 'Pr??nom') }}
                                {{ Form::text('prenom', $employe ? $employe->prenom : null, ['placeholder' => 'Pr??nom']) }}
                            </div>
                            <div class="col-12 col-md-4">
                                {{ Form::label('permis', 'Permis') }}
                                {{ Form::text('permis', $employe ? $employe->permis : null, ['placeholder' => 'N?? permis']) }}
                            </div>
                            <div class="col-12 col-md-6">
                                {{ Form::label('poste', 'Poste') }}
                                {{ Form::text('poste', $employe ? $employe->poste : null, ['placeholder' => 'Poste']) }}
                            </div>
                        </div>
                        <h3 class="mt-10 mb-4">Coordonn??es :</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="col-12 col-md-6">
                                {{ Form::label('email', 'Email') }}
                                {{ Form::text('email', $employe && $employe->coordonnee ? $employe->coordonnee->email : null, ['placeholder' => 'Email']) }}
                            </div>
                            <div class="col-12 col-md-6">
                                {{ Form::label('telephone', 'T??l??phone') }}
                                {{ Form::text('telephone', $employe && $employe->coordonnee ? $employe->coordonnee->telephone : null, ['placeholder' => 'T??l??phone']) }}
                            </div>
                            <div class="col-12 col-md-6">
                                {{ Form::label('pays', 'Pays') }}
                                {{ Form::text('pays', $employe && $employe->coordonnee ? $employe->coordonnee->pays : null, ['placeholder' => 'Pays']) }}
                            </div>
                            <div class="col-12 col-md-6">
                                {{ Form::label('ville', 'Ville') }}
                                {{ Form::text('ville', $employe && $employe->coordonnee ? $employe->coordonnee->ville : null, ['placeholder' => 'Ville']) }}
                            </div>
                            <div class="col-12 col-md-6">
                                {{ Form::label('adresse', 'Adresse') }}
                                {{ Form::text('adresse', $employe && $employe->coordonnee ? $employe->coordonnee->adresse : null, ['placeholder' => 'Adresse']) }}
                            </div>
                            <div class="col-12 col-md-6">
                                {{ Form::label('complement', 'Compl??ment d\'adresse') }}
                                {{ Form::text('complement', $employe && $employe->coordonnee ? $employe->coordonnee->complement : null, ['placeholder' => '??tage, porte, ...']) }}
                            </div>
                            <div class="col-12 col-md-6">
                                {{ Form::label('codePostal', 'Code postal') }}
                                {{ Form::number('codePostal', $employe && $employe->coordonnee ? $employe->coordonnee->codePostal : null) }}
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
