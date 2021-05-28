<ul>
  @foreach($vehicules as $vehicule)
    <li>
      <a href="vehicule/{{ $vehicule->immatriculation }}">{{ $vehicule->immatriculation }}</a> -
      <a href="/delete-message/{{ $vehicule->immatriculation }}">delete</a>
    </li>
  @endforeach
</ul>
