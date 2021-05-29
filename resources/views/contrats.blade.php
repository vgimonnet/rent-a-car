<ul>
  @foreach($contrats as $contrat)
    <li>
      <a href="contrats/{{ $contrat->id }}">{{ $contrat->id }}</a> -
      <a href="/delete/{{ $contrat->id }}">delete</a>
    </li>
  @endforeach
</ul>
