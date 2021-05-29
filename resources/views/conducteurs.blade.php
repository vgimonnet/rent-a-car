<ul>
  @foreach($conducteurs as $conducteur)
    <li>
      <a href="conducteurs/{{ $conducteur->id }}">{{ $conducteur->id }}</a> -
      <a href="/delete/{{ $conducteur->id }}">delete</a>
    </li>
  @endforeach
</ul>
