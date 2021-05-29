@if(isset($controlesTechnique))
<ul>
  @foreach($controlesTechnique as $controle)
    <li>
      <a href="controles-technique/{{ $controle->id }}">{{ $controle->id }}</a> -
      <a href="controles-technique/{{ $controle->id }}?edit=true">Modifier</a> -
      <a href="controles-technique/{{ $controle->id }}?delete=true">Supprimer</a>
    </li>
  @endforeach
</ul>
@elseif(Request::get('edit'))
  <h1>Edit</h1>
  {{ $controleTechnique }}
@elseif(Request::get('delete'))
  <h1>Delete</h1>
  {{ $controleTechnique }}
@else
  {{ $controleTechnique }}
@endif
