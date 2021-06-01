<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Controles Technique') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="text-center">
                        <x-nav-link :href="route('ajouterControleTechnique')">
                            {{ __('Ajouter un controle technique') }}
                        </x-nav-link>
                    </nav>
                    <h3 class="mt-10 mb-5">Controles technique :</h3>
                    <ul class="grid grid-cols-1 gap-10">
                        @foreach($controlesTechnique as $controle)
                            <li class="flex">
                                <a href="{{ route('controleTechnique', $controle->id_controle_technique) }}">
                                    {{ $controle->getVehicule() ? $controle->getVehicule()->getInfoVehicule() : 'Véhicule non trouvé' }}
                                    {{ $controle->date_controle }}
                                </a>                                
                                <div class="ml-auto">
                                    <a href="{{ route('modifierControleTechnique', $controle->id_controle_technique) }}">Modifier</a>
                                    <a href="{{ route('supprimerControleTechnique', $controle->id_controle_technique) }}">Supprimer</a>
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
