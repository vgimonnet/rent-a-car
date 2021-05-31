<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Véhicules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="text-center">
                        <x-nav-link :href="route('ajouterConducteur')">
                            {{ __('Ajouter un conducteur') }}
                        </x-nav-link>
                    </nav>
                    <h3 class="mt-10 mb-5">Conducteurs :</h3>
                    <ul class="grid grid-cols-1 gap-10">
                        @foreach($conducteurs as $conducteur)
                            <li class="flex">
                                <a href="{{ route('conducteur', $conducteur->id_conducteur) }}">{{ $conducteur->id_conducteur }}</a>
                                <div class="ml-auto">
                                    <a href="{{ route('modifierConducteur', $conducteur->id_conducteur) }}">Modifier</a>
                                    <a href="{{ route('supprimerConducteur', $conducteur->id_conducteur) }}">Supprimer</a>
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
