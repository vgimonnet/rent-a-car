<ul>
  @foreach($controlesEtat as $controle)
    <li>
      <a href="controles-etat/{{ $controle->id }}">{{ $controle->id }}</a> -
      <a href="/delete/{{ $controle->id }}">delete</a>
    </li>
  @endforeach
</ul>
