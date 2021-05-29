@if(isset($contrats))
<ul>
  @foreach($contrats as $contrat)
    <li>
      <a href="contrats/{{ $contrat->id }}">{{ $contrat->id }}</a> -
      <a href="contrats/{{ $contrat->id }}?edit=true">Modifier</a> -
      <a href="contrats/{{ $contrat->id }}?delete=true">Supprimer</a>
    </li>
  @endforeach
</ul>
@elseif(Request::get('edit'))
  <h1>Edit</h1>
  {{ $contrat }}
@elseif(Request::get('delete'))
  <h1>Delete</h1>
  {{ $contrat }}
@else
  {{ $contrat }}
@endif
