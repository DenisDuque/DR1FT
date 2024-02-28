<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body class="container background-admin-gradient">
    @section('header')
        <header class="shadow row align-items-center admin-header mt-2">
            <nav>
                <ul class="nav">
                    <li class="nav-item mx-4">
                        <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" aria-current="page" href="/admin/dashboard">DASHBOARD</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link {{ request()->is('admin/races') ? 'active' : '' }}" href="/admin/races">RACES</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link {{ request()->is('admin/sponsors') ? 'active' : '' }}" href="/admin/sponsors">SPONSORS</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link {{ request()->is('admin/insurances') ? 'active' : '' }}" href="/admin/insurances">INSURANCES</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link {{ request()->is('admin/drivers') ? 'active' : '' }}" href="/admin/drivers">DRIVERS</a>
                    </li>
                    <li class="d-flex align-items-center justify-content-end nav-item flex-grow-1">
                        <i class="bi bi-person"></i>
                        <span>Administrator</span>
                        <i class="bi bi-box-arrow-left"></i>
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


