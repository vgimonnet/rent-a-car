<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="text-center">
                        <x-nav-link :href="route('AjouterPersonneMorale')">
                            {{ __('Ajouter personne morale') }}
                        </x-nav-link>
                        <x-nav-link :href="route('AjouterPersonnePhysique', ['type' => 'personne_physique'])">
                            {{ __('Ajouter personne physique') }}
                        </x-nav-link>
                        <x-nav-link :href="route('AjouterPersonnePhysique', ['type' => 'conducteur'])">
                            {{ __('Ajouter conducteur') }}
                        </x-nav-link>
                    </nav>
                    <div class="grid grid-cols-1 md:grid-cols-2 md:grid-cols-3 gap-10">                    
                        <section>
                            <h3 class="mt-10 mb-5">Personnes morale :</h3>
                            <ul>
                                @foreach ($personnesMorale as $personne)
                                    <li class="flex">
                                        {{ $personne->societe }}
                                        {{ '('.$personne->getNbConducteurs(). ' conducteurs)' }}
                                        <div class="ml-auto">
                                            <a href="{{ route('ModifierPersonneMorale', $personne->id_personne_morale) }}">Modifier</a>
                                            <a href="{{ route('SupprimerPersonneMorale', $personne->id_personne_morale) }}">Supprimer</a>
                                            <!-- TODO : ajouter garde fou, modal de confirmation ? -->
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                        <section>
                            <h3 class="mt-10 mb-5">Personnes physiques :</h3>
                            <ul>
                                @foreach ($personnesPhysiques as $personne)
                                    <li class="flex">
                                        {{ $personne->nom }}
                                        <div class="ml-auto">
                                            <a href="{{ route('ModifierPersonnePhysique', ['id' => $personne->id_conducteur, 'type' => 'personne_physique']) }}">Modifier</a>
                                            <a href="{{ route('SupprimerPersonnePhysique', ['id' => $personne->id_conducteur, 'type' => 'personne_physique']) }}">Supprimer</a>
                                            <!-- TODO : ajouter garde fou, modal de confirmation ? -->
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                        <section>
                            <h3 class="mt-10 mb-5">Conducteurs :</h3>
                            <ul>
                                @foreach ($conducteurs as $personne)
                                    <li class="flex">
                                        {{ $personne->nom }}
                                        {{ '(société : '.$personne->personneMorale->societe.')' }}
                                        <div class="ml-auto">
                                            <a href="{{ route('ModifierPersonnePhysique', ['id' => $personne->id_conducteur, 'type' => 'conducteur']) }}">Modifier</a>
                                            <a href="{{ route('SupprimerPersonnePhysique', ['id' => $personne->id_conducteur, 'type' => 'conducteur']) }}">Supprimer</a>
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
