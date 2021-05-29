<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>

    <ul>
      <li>
        <a href="./vehicules">Véhicules</a>
      </li>
      <li>
        <a href="./employes">Employés</a>
      </li>
      <li>
        <a href="./conducteurs">Conducteurs</a>
      </li>
      <li>
        <a href="./contrats">Contrats</a>
      </li>
      <li>
        <a href="./controles-etat">Controles d'états</a>
      </li>
      <li>
        <a href="./controles-technique">Controles technique</a>
      </li>
    </ul>
</x-app-layout>
