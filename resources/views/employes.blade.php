@if(isset($employes))
<ul>
  @foreach($employes as $employe)
    <li>
      <a href="employes/{{ $employe->id }}">{{ $employe->id }}</a> -
      <a href="employes/{{ $employe->id }}?edit=true">Modifier</a> -
      <a href="employes/{{ $employe->id }}?delete=true">Supprimer</a>
    </li>
  @endforeach
</ul>
@elseif(Request::get('edit'))
  <h1>Edit</h1>
  {{ $employe }}
@elseif(Request::get('delete'))
  <h1>Delete</h1>
  {{ $employe }}
@else
  {{ $employe }}
@endif
