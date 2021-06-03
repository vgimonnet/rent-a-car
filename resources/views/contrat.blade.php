<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contrat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>
                        <b>Date de début : </b> {{ $contrat->date_debut }}
                    </p>
                    <p>
                        <b>Date de fin prévu : </b> {{ $contrat->date_fin }}
                    </p>
                    <p>
                        <b>Date de retour : </b> {{ $contrat->date_retour }}
                    </p>
                    <p>
                        <b>Conducteur : </b> {{ $contrat->conducteur->getInfo() }}
                    </p>
                    <p>
                        <b>Employé : </b> {{ $contrat->employe->getInfo() }}
                    </p>
                    <p>
                        <b>Véhicule : </b> {{ $contrat->getVehicule()->getInfoVehicule() }}
                    </p>
                    <p>
                        <b>Motif : </b> {{ $contrat->motif }}
                    </p>
                    <p>
                        <b>Montant Total : </b> {{ $contrat->montant }}
                    </p>
                    <p>
                        <b>Montant déjà payé : </b> {{ $contrat->montant_paye }}
                    </p>
                    <p>
                        <b>Reste à payer : </b> {{ $contrat->montant - $contrat->montant_paye }}
                    </p>
                    <p>
                        <b>Controle d'état de sortie : </b> {{ $contrat->getControle('sortie') ? $contrat->getControle('sortie')->getInfoControle() : '' }}
                    </p>
                    <p>
                        <b>Controle d'état d'entrée : </b> {{ $contrat->getControle('entree') ? $contrat->getControle('entree')->getInfoControle() : '' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
