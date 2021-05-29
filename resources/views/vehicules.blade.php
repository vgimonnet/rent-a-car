@if(isset($vehicules))
<ul>
  @foreach($vehicules as $vehicule)
    <li>
      <a href="vehicules/{{ $vehicule->immatriculation }}">{{ $vehicule->immatriculation }}</a> -
      <a href="vehicules/{{ $vehicule->immatriculation }}?edit=true">Modifier</a> -
      <a href="vehicules/{{ $vehicule->immatriculation }}?delete=true">Supprimer</a>
    </li>
  @endforeach
</ul>
@elseif(Request::get('edit'))
  <h1>Edit</h1>
  {{ $vehicule }}
@elseif(Request::get('delete'))
  <h1>Delete</h1>
  {{ $vehicule }}
@else
  {{ $vehicule }}
@endif
