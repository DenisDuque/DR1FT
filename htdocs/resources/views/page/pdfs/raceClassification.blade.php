<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Classification</title>
    <style>
        /* Estilos de etiqueta*/
        body {
        background-color: #151418;
        }

        table {
        background: #252328;
        width: 50%;
        margin: 0 auto;
        margin-top: 2%;
        border-collapse: collapse;
        text-align: center;
        }

        th {
        background-color: #252328;
        height: 35px;
        border-bottom: 1px solid rgb(210, 220, 250);
        color: #E93F36;
        }

        td {
        color: #F7F7F5;
        height: 30px;
        border: 0.5px solid rgba(240, 240, 240, 10);
        }

        .header, .filter {
            padding: 2em;
            margin: 0 25%;
            text-align: center;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{$race->name}}</h1>
        <h2>General classification</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>Dorsal</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Finished at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($drivers as $driver)
                <tr>
                    <td>{{$driver->dorsal}}</td>
                    <td>{{$driver->driver->name}}</td>
                    <td>{{$driver->driver->gender ? 'M' : 'F'}}</td>
                    <td>{{$driver->driver->birthDate->age}}</td>
                    <td>{{$driver->time}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="filter">
        <h2>Gender classification: Male</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>Dorsal</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Finished at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($drivers as $driver)
                @if ($driver->driver->gender)
                    <tr>
                        <td>{{$driver->dorsal}}</td>
                        <td>{{$driver->driver->name}}</td>
                        <td>M</td>
                        <td>{{$driver->driver->birthDate->age}}</td>
                        <td>{{$driver->time}}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <div class="filter">
        <h2>Gender classification: Female</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>Dorsal</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Finished at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($drivers as $driver)
                @if (!$driver->gender)
                    <tr>
                        <td>{{$driver->dorsal}}</td>
                        <td>{{$driver->driver->name}}</td>
                        <td>F</td>
                        <td>{{$driver->driver->birthDate->age}}</td>
                        <td>{{$driver->time}}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>