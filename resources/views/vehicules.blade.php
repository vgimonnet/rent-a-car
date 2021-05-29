@if(isset($vehicules))

{{ Form::open(['url' => 'vehicules/new']) }}
  {{ Form::text('immatriculation', null, ['placeholder' => 'Immatriculation']) }}
  {{ Form::text('marque', null, ['placeholder' => 'Marque']) }}
  {{ Form::text('modele', null, ['placeholder' => 'Modèle']) }}
  {{ Form::text('couleur', null, ['placeholder' => 'Couleur']) }}
  {{ Form::text('poids', null, ['placeholder' => 'Poids']) }}
  {{ Form::text('hauteur', null, ['placeholder' => 'Hauteur']) }}
  {{ Form::text('places', null, ['placeholder' => 'Places']) }}
  {{ Form::text('coutParJour', null, ['placeholder' => 'Cout par jour']) }}
  {{ Form::date('dateAchat', null, ['placeholder' => 'Date Achat']) }}
  {{ Form::text('contenanceCoffre', null, ['placeholder' => 'Contenance coffre']) }}
  {{ Form::submit('Envoyer') }}
{{ Form::close() }}

<ul>
  @foreach($vehicules as $vehicule)
    <li>
      <a href="vehicules/{{ $vehicule->immatriculation }}">{{ $vehicule->immatriculation }}</a> -
      <a href="vehicules/{{ $vehicule->immatriculation }}?edit=true">Modifier</a> -
      <a href="vehicules/{{ $vehicule->immatriculation }}?delete=true">Supprimer</a>
    </li>
  @endforeach
</ul>
{{ $vehicules->render() }}
@elseif(Request::get('edit'))
  <h1>Edit</h1>
  {{ $vehicule }}
@elseif(Request::get('delete'))
  <h1>Delete</h1>
  {{ $vehicule }}
@else
  {{ $vehicule }}
@endif
