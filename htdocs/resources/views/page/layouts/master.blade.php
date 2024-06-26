<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
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
<body class="bg">
    {{-- <header class="container fixed-top z-index-1 mt-3"> --}}
    <header class="container-fluid page-header-bg shadow p-3">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <h1 class="drift">DR1FT</h1>
                </div>
                <div class="col-10">
                    <nav class="navbar-expand-lg navbar-expand-md d-none d-lg-block">
                    <ul class="nav justify-content-end user-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('main.page')}}">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('races.all')}}">RACES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('page.gallery')}}">GALLERY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('page.membership')}}">MEMBERSHIP</a>
                        </li>
                        <li class="nav-item">
                            @if(session()->has('user_id'))
                                <a class="nav-link" href="{{ route('page.profile') }}">PROFILE</a>
                            @else
                                <a class="nav-link " href="{{route('user.login')}}">SIGN IN</a>
                            @endif

                        </li>
                    </ul>
                    </nav>
                    <nav class="navbar d-lg-none fixed-top">
                        <div class="container">
                          <button class="navbar-toggler text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                            <span class="navbar-toggler-icon text-white"></span>
                          </button>
                          
                          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                            <div class="offcanvas-header">
                              <h5 class="offcanvas-title dr1ft" id="offcanvasNavbarLabel" class="drift">DR1FT</h5>
                              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item mx-4">
                                    <a class="nav-link active" aria-current="page" href="{{route('main.page')}}">HOME</a>
                                </li>
                                <li class="nav-item mx-4">
                                    <a class="nav-link" href="{{route('races.all')}}">RACES</a>
                                </li>
                                <li class="nav-item mx-4">
                                    <a class="nav-link" href="{{route('page.gallery')}}">GALLERY</a>
                                </li>
                                <li class="nav-item mx-4">
                                    <a class="nav-link " href="{{route('page.membership')}}">MEMBERSHIP</a>
                                </li>
                                <li class="nav-item mx-4">
                                    @if(session()->has('user_id'))
                                        <a class="nav-link" href="{{ route('page.profile') }}">PROFILE</a>
                                    @else
                                        <a class="nav-link " href="{{route('user.login')}}">SIGN IN</a>
                                    @endif

                                </li>
                                
                              </ul>
        
                            </div>
                          </div>
                        </div>
                      </nav>
                </div>
            </div>
        </div>
    </header>
    <main class="container">
        @yield('content')
    </main>
</body>
</html>


