<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contrats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="text-center">
                        <x-nav-link :href="route('ajouterContrat')">
                            {{ __('Ajouter un contrat') }}
                        </x-nav-link>
                    </nav>
                    <h3 class="mt-10 mb-5">Contrats :</h3>
                    <ul class="grid grid-cols-1 gap-10">
                        @foreach($contrats as $contrat)
                            <li class="flex">
                                <a href="{{ route('contrat', $contrat->id_contrat) }}">{{ $contrat->getInfo() }}</a>
                                <div class="ml-auto">
                                    <a href="{{ route('modifierContrat', $contrat->id_contrat) }}">Modifier</a>
                                    <a href="{{ route('supprimerContrat', $contrat->id_contrat) }}">Supprimer</a>
                                    <!-- TODO : ajouter garde fou, modal de confirmation ? -->
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
