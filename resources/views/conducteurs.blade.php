@if(isset($conducteurs))
<ul>
  @foreach($conducteurs as $conducteur)
    <li>
      <a href="conducteurs/{{ $conducteur->id }}">{{ $conducteur->id }}</a> -
      <a href="conducteurs/{{ $conducteur->id }}?edit=true">Modifier</a> -
      <a href="conducteurs/{{ $conducteur->id }}?delete=true">Supprimer</a>
    </li>
  @endforeach
</ul>
@elseif(Request::get('edit'))
  <h1>Edit</h1>
  {{ $conducteur }}
@elseif(Request::get('delete'))
  <h1>Delete</h1>
  {{ $conducteur }}
@else
  {{ $conducteur }}
@endif
