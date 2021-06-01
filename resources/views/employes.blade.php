<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employés') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="text-center">
                        <x-nav-link :href="route('ajouterEmploye')">
                            {{ __('Ajouter un employé') }}
                        </x-nav-link>
                    </nav>
                    <h3 class="mt-10 mb-5">Employés :</h3>
                    <ul class="grid grid-cols-1 gap-10">
                        @foreach($employes as $employe)
                            <li class="flex">
                                <a href="{{ route('employe', $employe->id_personne) }}">{{ $employe->nom.' '.$employe->prenom.' ('.$employe->poste.')' }}</a>
                                <div class="ml-auto">
                                    <a href="{{ route('modifierEmploye', $employe->id_personne) }}">Modifier</a>
                                    <a href="{{ route('supprimerEmploye', $employe->id_personne) }}">Supprimer</a>
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
