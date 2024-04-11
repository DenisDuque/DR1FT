@extends('page.layouts.master')

@section('title', 'Race Details')

@section('content')
    <div class="row mt-5">
        <div class="col-md-4">
            <img class="img-fluid rounded" src="{{asset('storage/race_banners/'.$race->banner)}}" alt="{{$race->name}}">
        </div>
        <div class="col-md-8 text-white">
            <h1 class="text-white race-detail-header">{{$race->name}}
                @if ($race->pro == 1)
                    <span class="badge rounded-pill bg-warning text-dark">PRO</span>
                @endif
            </h1>
            <div class="row py-2">
                <div class="col">
                    <span class="badge rounded-pill text-bg-light"><i class="me-1 bi bi-calendar2-week-fill"></i>{{$race->date}}</span>
                    <span class=" badge rounded-pill bg-info text-dark"><i class="bi bi-people-fill"></i>Max. {{$race->maxParticipants}}</span>
                    <span class=" badge rounded-pill bg-badge-purple"><i class="bi bi-speedometer2"></i>{{$race->length}} Km</span>
                </div>
            </div>         

            @php
                $nextMonth = date('Y-m-d', strtotime('+1 month')); // Fecha del próximo mes
                $today = date('Y-m-d'); // Fecha de hoy
                $raceDate = date('Y-m-d', strtotime($race->date)); // Convertir la fecha de la carrera al formato Y-m-d
            @endphp
            <div class="row my-4">
                    <!-- Botón para corredores registrados -->
                    @if(session()->has('user_id'))
                    
                        <div class="col-2">
                            <form action="{{ route('race.register') }}" method="POST">
                                @csrf
                                <input type="hidden" name="member" value="1">
                                <input type="hidden" name="race_id" value="{{ $race->id }}">
                                <input type="hidden" name="amount" value="{{$race->registrationPrice}}">
                                <button type="button" class="btn btn-primary text-white" @if ($raceDate <= $nextMonth || $raceDate <= $today) disabled @endif>
                                    Participate ({{$race->registrationPrice}}$)
                                </button>
                            </form>
                        </div>
                
                    @else
                        <div class="col-2">
                            <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#exampleModal" @if ($raceDate <= $nextMonth || $raceDate <= $today) disabled @endif>
                                Participate ({{$race->registrationPrice}}$)
                            </button>
                        </div>
                        <div class="col-10">
                            <div class="alert alert-primary" role="alert">
                                <i class="bi bi-info-circle-fill me-1"></i>
                                If you have already participated in one of our races, try <a href="{{route('user.showLogin')}}" class="alert-link">logging in</a>, and make it easier!
                            </div>
                        </div>
                    @endif
                
                <div class="col-10">
                    @if ($raceDate <= $today)
                        <div class="alert alert-primary d-flex align-items-center" role="alert">
                            <i class="bi bi-info-circle-fill me-1"></i>
                            <div>
                                This race is currently finished
                            </div>
                        </div>
                        @elseif ($raceDate <= $nextMonth)
                        <div class="alert alert-primary d-flex align-items-center" role="alert">
                            <i class="bi bi-info-circle-fill me-1"></i>
                            <div>
                                This race is disabled until there's 1 month left
                            </div>
                        </div>
                    @endif
                </div>

            </div>
            <div class="row mt-2">
                <div class="col">
                    @include('administrator.layouts.notice')
                </div>
            </div>
            

            <main class="race-details-nav-tabs-container">
            <header class="clearfix">
                <nav class="container-fluid">
                    <ul class="clearfix">
                        <li><a href="#one" class="activ">INFORMATION</a></li>
                        <li><a href="#two">MAP</a></li>
                        <li><a href="#three">LOCATION</a></li>
                        <li><a href="#four">CLASSIFICATION</a></li>
					<li><a href="#five">GALLERY</a></li>
                    </ul>
                    <span></span>
                    
                </nav>
            </header>
            <section class="row px-4 py-2">
                <div class="col-xs-12 content activ" id="one">
                    <p>
                        {{$race->description}}
                    </p>
                    <p><strong>Registration Price: {{$race->registrationPrice}}$</strong></p>
                    <h4>Sponsors</h4>
                    @foreach ($sponsors as $sponsor)
                        <img class="img-thumbnail rounded" src="{{asset('storage/sponsor_logos/'.$sponsor->logo)}}" alt="{{$sponsor->name}}">
                        
                    @endforeach
                </div>
                <div class="col-xs-12 content" id="two">
                    <img class="img-fluid rounded" src="{{asset('storage/race_maps/'.$race->map)}}" alt="{{$race->name}}">
                </div>
                <div class="col-xs-12 content" id="three">
                    
                    <p><i class="bi bi-geo-alt-fill me-1"></i>{{$race->startingPlace}}</p>
                </div>
                <div class="col-xs-12 content" id="four">
                    
                    <p>
                        four
                    </p>
                </div>
                <div class="col-xs-12 content" id="five">
                    
                    <div id="carouselExampleIndicators" class="carousel slide d-block" data-bs-ride="carousel">
                        <div class="carousel-indicators d-block text-center">
                            @foreach ($photos as $key => $photo)
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}" aria-label="Slide {{ $key + 1 }}"></button>
                            @endforeach
                          {{-- <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button> --}}
                        </div>
                        <div class="carousel-inner rounded d-block" style="max-height: 22rem">
                            @foreach ($photos as $key => $photo)
                                <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                                    <img src="{{ asset('storage/race_photos/'.$photo->path) }}" class="img-fluid d-block w-100" alt="...">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                </div>
            </section>
        </main>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif 
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg text-white">
                <div class="modal-content bg-admin">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registration Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- PARA COMPROBAR SI ES MEMEBRER O NO --}}
                        {{-- @if(session()->has('user_id'))
                                <a class="nav-link " href="{{route('user.login')}}">PROFILE</a>
                            @else
                                <a class="nav-link " href="{{route('user.login')}}">SIGN IN</a>
                            @endif --}}
                        <form class="row g-3 text-white" action="{{route('race.register')}}" method="post">
                              

                            <!-- Agregar esto al principio de la vista para mostrar los errores de validación -->
                            @csrf
                            @if(session()->has('user_id'))
                                <input type="hidden" name="member" value="1">
                            @else
                                <input type="hidden" name="member" value="0">
                            @endif
                            <input type="hidden" name="race_id" value="{{$race->id}}">
                            <div class="col-md-12">
                                <label for="driverName" class="form-label ">Name</label>
                                <input type="text" name="driverName" class="form-control" id="driverName" value="{{old('driverName')}}">
                            </div>
                            <div class="col-md-3">
                                <label for="driveBirthDate" class="form-label ">Birth Date</label>
                                <input type="date" name="driveBirthDate" class="form-control" id="driveBirthDate" value="{{old('driveBirthDate')}}">
                            </div>
                            <div class="col-md-3">
                                <label for="driverGender" class="form-label ">Gender</label>
                                <select id="driverGender" name="driverGender" class="form-select">
                                <option selected>Choose...</option>
                                <option value="1">Male</option>
                                <option value="0">Female</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check form-switch">
                                    <label class="form-label" for="driverPro">PRO</label>
                                    <input class="form-check-input" type="checkbox" role="switch" id="driverPro" name="driverPro" value="1" checked>
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                @if ($race->pro == 1)
                                    <label for="driverFederation" class="form-label" id="federation-lbl">Nº Federation</label>
                                    <input type="number" name="driverFederation" class="form-control" id="drvFederation">
                                @else
                                    <label for="driverFederation" class="form-label" id="federation-label">Nº Federation</label>
                                    <input type="number" name="driverFederation" class="form-control" id="driverFederation">

                                    <select name="driverInsurance" class="form-select form-select-sm hidden-select" aria-label=".form-select-sm example">
                                        <option selected>Open this select menu</option>
                                        @foreach ($insurances as $insurance)
                                            <option value="{{$insurance->id}}">{{$insurance->name}} - {{$insurance->pricePerRace}}$</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col-12">
                                <label for="driverAddress" class="form-label ">Address</label>
                                <input type="text" name="driverAddress" class="form-control" id="driverAddress" placeholder="" value="{{old('driverAddress')}}">
                            </div>
                            <div class="col-md-12">
                                <label for="driverEmail" class="form-label ">Email</label>
                                <input type="email" name="driverEmail" class="form-control" id="driverEmail" value="{{old('driverEmail')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="driverPassword" class="form-label ">Password</label>
                                <input type="password" name="driverPassword" class="form-control" id="driverPassword" value="{{old('driverPassword')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="driverPasswordConfirm" class="form-label ">Confirm Password</label>
                                <input type="password" name="driverPasswordConfirm" class="form-control" id="driverPasswordConfirm" value="{{old('driverPasswordConfirm')}}">
                            </div>
                           
                            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Participate ({{$race->registrationPrice}}$)</button>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
                </div>
            </div>
  
            
        </div>
    </div>

@endsection
