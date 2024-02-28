<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>@yield('title')</title>
</head>
<body class="container background-admin-gradient">
    @section('header')
        <header class="row">
            <nav>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">DASHBOARD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">RACES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">SPONSORS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">INSURANCES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">DRIVERS</a>
                    </li>
                    <li class="nav-item">
                        <section>
                            <i class="bi bi-person"></i>
                            <h3>Administrator</h3>
                            <i class="bi bi-box-arrow-left"></i>
                        </section>
                    </li>
                </ul>
                
            </nav>
        </header>
    @show
    <main class="container">
        @yield('content')
    </main>
</body>
</html>


