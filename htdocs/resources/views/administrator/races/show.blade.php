<h1>{{$titulo}}</h1>

<ul>
    @foreach($races as $race)
        <li>{{$race->name}}</li>
    @endforeach
</ul>