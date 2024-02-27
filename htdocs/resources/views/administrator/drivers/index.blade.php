<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>@yield('title')</title>
</head>
<body>

    <h1>All Drivers</h1>

    <table class="table table-dark table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Address</th>
        <th scope="col">Birth Date</th>
        <th scope="col">Gender</th>
        <th scope="col">Member</th>
        <th scope="col">Nº Federation</th>
        <th scope="col">Points</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($drivers as $driver)
            <tr>
                <td>{{$driver->id}}</td>
                <td>{{$driver->name}}
                    @if ($driver->pro == 1)
                        <span class="badge rounded-pill bg-warning text-dark">PRO</span>
                    @endif
                </td>
                <td>{{$driver->email}}</td>
                <td>{{$driver->address}}</td>
                <td>{{$driver->birthDate}}</td>
                <td>{{$driver->gender}}</td>
                <td>{{$driver->member}}</td>
                <td>{{$driver->federationNumber}}</td>
                <td>{{$driver->points}}</td>
                <td>Edit | Delete</td>
            </tr>
        @endforeach
        
    </tbody>
    </table>
</body>
</html>