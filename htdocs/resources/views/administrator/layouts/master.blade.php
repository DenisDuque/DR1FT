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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper.js (si es necesario) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src=""></script>
</head>
<body class="container background-admin-gradient">
    @section('header')
        <header class="shadow row align-items-center admin-header mt-2">
            <nav class="navbar-expand-lg navbar-expand-md d-none d-lg-block">
                <ul class="nav">
                    <li class="nav-item mx-4">
                        <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" aria-current="page" href="/admin/dashboard">DASHBOARD</a>
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
                    {{-- <li class="d-flex align-items-center justify-content-end nav-item flex-grow-1 text-white"> --}}
                        <div class="btn-group">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                              <li>
                                <span>{{ session()->has('userName') ? session('userName') : 'Administrator' }}</span></li>
                              <li><a class="dropdown-item ms-2" href="/admin/logout"><i class="bi bi-box-arrow-left"></i> Log Out</a></li>
                              
                            </ul>
                        </div>
                    {{-- </li> --}}
                </ul>
                
            </nav>
            <nav class="navbar d-lg-none fixed-top">
                <div class="container">
                  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                      <h5 class="offcanvas-title dr1ft" id="offcanvasNavbarLabel">DR1FT</h5>
                      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                      <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
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
                        <li class="d-flex align-items-center justify-content-end nav-item flex-grow-1 text-white">
                            <i class="bi bi-person me-2"></i>
                            <span>{{ session()->has('userName') ? session('userName') : 'Administrator' }}</span>
                            <a class="text-white ms-2" href="/admin/logout"><i class="bi bi-box-arrow-left"></i></a>
                        </li>
                      </ul>

                    </div>
                  </div>
                </div>
              </nav>
        </header>
    @show
    <main class="container">
        @yield('content')
    </main>
</body>
</html>


