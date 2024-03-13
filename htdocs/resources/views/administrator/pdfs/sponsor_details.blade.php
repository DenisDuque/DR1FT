<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Detalles de la Empresa</title>
    <style>
       
        
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 5px 0;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div>
        <img src="{{ public_path('storage/sponsor_logos/' . $sponsor->logo) }}" alt="Logo" class="logo">
        <div class="info">
            <p><strong>CIF:</strong> {{ $sponsor->cif }}</p>
            <p><strong>Nombre:</strong> {{ $sponsor->name }}</p>
            <p><strong>Dirección:</strong> {{ $sponsor->address }}</p>
            <p><strong>Total cost:</strong>{{$totalSponsorCost}}</p>

        </div>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date</th>
                    <th scope="col" class="w-300px">Place</th>
                    <th scope="col" class="text-center">Max. Drivers</th>
                    <th scope="col" class="text-center">Length</th>
                    <th scope="col" class="text-center">Sponsor Cost</th>
                    <th class="text-center">Registration Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($races as $race)
                    
                    <tr>
                        <td class="py-3 align-middle">{{$race->id}}</td>
                        <td class="py-3 align-middle">{{$race->name}}
                            @if ($race->pro == 1)
                                <span class="badge rounded-pill bg-warning text-dark">PRO</span>
                            @endif
                            @if ($race->active == 0)
                                <span class="badge rounded-pill bg-badge-disabled">Disabled</span>
                            @endif
                        </td>
                        <td class="py-3 align-middle"><i class="me-2 bi bi-calendar-event"></i>{{$race->date}}</td>
                        <td class="py-3 align-middle">{{$race->startingPlace}}</td>
                        <td class="py-3 text-center align-middle">{{$race->maxParticipants}}</td>
                        <td class="py-3 text-center align-middle">{{$race->length}}</td>
                        <td class=" align-middle text-center w-10"><span class="badge rounded-pill bg-badge-purple">{{$race->sponsorCost}}$</span></td>
                        <td class="align-middle text-center w-10"><span class="badge rounded-pill bg-badge-purple">{{$race->registrationPrice}}$</span></td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</body>
</html>
