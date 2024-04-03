<!DOCTYPE html>
<html>
<head>
    <title>Detalles de la Carrera</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        h1, h2 {
            text-align: center;
        }
        .race-info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles de la Carrera</h1>
        <div class="race-info">
            <h2>{{ $race->name }}</h2>
            <p><strong>Descripción:</strong> {{ $race->description }}</p>
            <p><strong>Fecha:</strong> {{ $race->date }}</p>
            <p><strong>Lugar de inicio:</strong> {{ $race->startingPlace }}</p>
            <p><strong>Número máximo de participantes:</strong> {{ $race->maxParticipants }}</p>
        </div>

        <h2>Participantes:</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre del Participante</th>
                    <th>Dorsal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($drivers as $driver)
                <tr>
                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->pivot->dorsal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
