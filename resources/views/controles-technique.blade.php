<ul>
  @foreach($controlesTechnique as $controle)
    <li>
      <a href="contrats/{{ $controle->id }}">{{ $controle->id }}</a> -
      <a href="/delete/{{ $controle->id }}">delete</a>
    </li>
  @endforeach
</ul>
