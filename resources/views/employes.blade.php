<ul>
  @foreach($employes as $employe)
    <li>
      <a href="employes/{{ $employe->id }}">{{ $employe->id }}</a> -
      <a href="/delete/{{ $employe->id }}">delete</a>
    </li>
  @endforeach
</ul>
