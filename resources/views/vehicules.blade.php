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
                        <x-nav-link :href="route('AjouterVehicule', ['type' => 'vehicule_leger'])">
                            {{ __('Ajouter un véhicule léger') }}
                        </x-nav-link>
                        <x-nav-link :href="route('AjouterVehicule', ['type' => 'vehicule_utilitaire'])">
                            {{ __('Ajouter un véhicule utilitaire') }}
                        </x-nav-link>
                    </nav>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">                    
                        <section>
                            <h3 class="mt-10 mb-5">Véhicules légers :</h3>
                            <ul>
                                @foreach($vehiculesLeger as $vehicule)
                                    <li class="flex">
                                        <a href="{{ route('vehicule', ['id' => $vehicule->id_vehicule, 'type' => 'vehicule_leger']) }}">
                                            {{ $vehicule->marque }} - {{ $vehicule->modele }} ({{ $vehicule->immatriculation }} )
                                        </a>
                                        <div class="ml-auto">
                                            <a href="{{ route('ModifierVehicule', ['id' => $vehicule->id_vehicule, 'type' => 'vehicule_leger']) }}">Modifier</a>
                                            <a href="{{ route('SupprimerVehicule', ['id' => $vehicule->id_vehicule, 'type' => 'vehicule_leger']) }}">Supprimer</a>
                                            <!-- TODO : ajouter garde fou, modal de confirmation ? -->
                                        </div>
                                    </li>
                                @endforeach
                            </ul>    
                        </section>

                        <section>
                            <h3 class="mt-10 mb-5">Véhicules utilitaires :</h3>
                            <ul>
                                @foreach($vehiculesUtilitaire as $vehicule)
                                    <li class="flex">
                                        <a href="{{ route('vehicule', ['id' => $vehicule->id_vehicule, 'type' => 'vehicule_utilitaire']) }}">
                                            {{ $vehicule->immatriculation }}
                                            {{ $vehicule->marque }} - {{ $vehicule->modele }}
                                        </a>
                                        <div class="ml-auto">
                                            <a href="{{ route('ModifierVehicule', ['id' => $vehicule->id_vehicule, 'type' => 'vehicule_utiliaire']) }}">Modifier</a>
                                            <a href="{{ route('SupprimerVehicule', ['id' => $vehicule->id_vehicule, 'type' => 'vehicule_utiliaire']) }}">Supprimer</a>
                                            <!-- TODO : ajouter garde fou, modal de confirmation ? -->
                                        </div>
                                    </li>
                                @endforeach
                            </ul>    
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
