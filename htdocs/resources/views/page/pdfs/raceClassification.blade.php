<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dorsal</title>
</head>
<body>
    <div class="flex justify-center align-center">
        <h1>{{$race->name}}</h1>
    </div>
    <h2>General classification</h2>
    <table>
        <thead>
            <th>Dorsal</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Finished at</th>
        </thead>
        <tbody>
            @foreach ($drivers as $driver)
                <tr>
                    <td>{{$driver->dorsal}}</td>
                    <td>{{$driver->name}}</td>
                    <td>{{$driver->gender ? 'M' : 'F'}}</td>
                    <td>{{$driver->birthDate->age}}</td>
                    <td>{{$driver->time}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Gender classification: Male</h2>
    <h2>Gender classification: Female</h2>
</body>
</html>