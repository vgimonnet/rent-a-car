@if(isset($controlesEtat))
<ul>
  @foreach($controlesEtat as $controleEtat)
    <li>
      <a href="controles-etats/{{ $controle->id }}">{{ $controle->id }}</a> -
      <a href="controles-etats/{{ $controle->id }}?edit=true">Modifier</a> -
      <a href="controles-etats/{{ $controle->id }}?delete=true">Supprimer</a>
    </li>
  @endforeach
</ul>
@elseif(Request::get('edit'))
  <h1>Edit</h1>
  {{ $contratEtat }}
@elseif(Request::get('delete'))
  <h1>Delete</h1>
  {{ $contratEtat }}
@else
  {{ $contratEtat }}
@endif
