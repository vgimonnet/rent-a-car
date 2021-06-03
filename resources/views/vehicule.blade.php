<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Véhicule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>
                        <b>Immatriculation : </b> {{ $vehicule->immatriculation }}
                    </p>
                    <p>
                        <b>Est disponible : </b> {{ $vehicule->disponible ? 'Oui' : 'Non' }}
                    </p>
                    <p>
                        <b>Poid : </b> {{ $vehicule->poid.' kg' }}
                    </p>
                    <p>
                        <b>Marque : </b> {{ $vehicule->marque }}
                    </p>
                    <p>
                        <b>Modèle : </b> {{ $vehicule->modele }}
                    </p>
                    <p>
                        <b>Coût par jour : </b> {{ $vehicule->cout_par_jour }}
                    </p>
                    <p>
                        <b>Date d'ancienneté : </b> {{ $vehicule->date_anciennete }}
                    </p>
                    <p>
                        <b>Couleur : </b> {{ $vehicule->couleur }}
                    </p>
                    <p>
                        <b>Nombre de places : </b> {{ $vehicule->places }}
                    </p>
                    <p>
                        <b>Contenance coffre : </b> {{ $vehicule->contenance_coffre }}
                    </p>
                    <p>
                        <b>Hauteur : </b> {{ $vehicule->hauteur.' cm' }}
                    </p>
                    @if ($type == 'vehicule_utilitaire')
                        <p>
                            <b>Possède une benne : </b> {{ $vehicule->benne ? 'Oui' : 'Non' }}
                        </p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
