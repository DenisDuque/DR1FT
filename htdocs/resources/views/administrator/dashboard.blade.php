@extends('administrator.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<section class="my-5">
    <h1 class="admin-form-title">Quick Actions</h1>
    <div class="row">
        <div class="col-sm-3">
            <div class="card quick-actions-bg">
                <div class="card-body">
                    <h5 class="card-title">Create a new race</h5>
                    <div class="row">
                        <div class="col-9">
                            <p class="card-text">Encourage everyone to push their limits.</p>
                        </div>
                        <div class="col-3">
                            <a href="/admin/races/new" class="btn btn-primary text-white">Start</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card quick-actions-bg">
                <div class="card-body">
                    <h5 class="card-title">Add a new insurance</h5>
                    <div class="row">
                        <div class="col-9">
                            <p class="card-text">Register a insurance to ensure your races.</p>
                        </div>
                        <div class="col-3">
                            <a href="/admin/insurances/new" class="btn btn-primary text-white">Start</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add a new sponsor</h5>
                    <div class="row">
                        <div class="col-9">
                            <p class="card-text">Register sponsors to enhance your earnings.</p>
                        </div>
                        <div class="col-3">
                            <a href="/admin/sponsors/new" class="btn btn-primary text-white">Start</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Upload race photos</h5>
                    <div class="row">
                        <div class="col-9">
                            <p class="card-text">Let the pictures tell the story of a memorable race day.</p>
                        </div>
                        <div class="col-2">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Start
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg text-black">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Upload Race Photos</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    ...
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                                </div>
                            </div>
  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid text-white mt-5 h-dashboard">
  <div class="row g-4">
    <div class="col-6">
        <div class="row g-2 mb-1">
            <div class="col-12 rounded bg-red-gradient p-4">
                <h1 class="admin-form-title">Coming Soon</h1>
                <div class="row">
                    @foreach ($nextRaces as $race)
                        <div class="col-4  text-center">
                            <img class="img-thumbnail" src="{{asset('storage/race_maps/'.$race->map)}}" alt="{{$race->name}}">
                            <i class="bi bi-people-fill"></i>{{$race->drivers->count()}}
                            <i class="bi bi-geo-alt-fill"></i><span>{{$race->name}}</span>
                            <i class="bi bi-calendar"></i><span>{{$race->date}}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-6 card p-4">
                
                <h1 class="admin-form-title">Best Insurances</h1>
                @foreach ($topInsurances as $insurance)
                    <div class="col-4  text-center d-flex">
                        <div>
                            <img class="img-thumbnail" src="{{asset('storage/insurance_logos/'.$insurance->logo)}}" alt="{{$insurance->name}}">
                        </div>
                        <strong>{{$insurance->name}}</strong>
                        <p>{{$insurance->cif}}</p>
                        
                    </div>
                @endforeach
                
            </div>
            <div class="col-6">
                <div class="row g-2">
                    <div class="col-12 card p-4">
                        
                        <h1 class="admin-form-title">Last Race</h1>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi placeat facere molestias
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi placeat facere molestias
                        </p>
                    </div>
                    <div class="col-12 card p-4">
                        
                            <input type="hidden" id="countdownDate" name="nextRaceDate" value="{{$nextRace->date}}">
                            <section>
                                <h1 class="admin-form-title text-center">{{$nextRace->name}}</h1>
                                <i class="bi bi-clock-history countdown-svg"></i>
                                <div id="countdown" class="d-flex justify-content-center">
                                    <div class="countdown-div">
                                        <span id="days" class="countdown-span"></span>
                                        <p>DAYS</p>
                                    </div>
                                    <div class="countdown-breadcumb d-flex flex-column">
                                    </div>
                                    <div class="countdown-div">
                                        <span id="hours" class="countdown-span"></span>
                                        <p>HOURS</p>
                                    </div>
                                    <div class="countdown-breadcumb d-flex flex-column">
                                        <i class="bi bi-dot"></i>
                                        <i class="bi bi-dot"></i>
                                    </div>
                                    <div class="countdown-div">
                                        <span id="minutes" class="countdown-span"></span>
                                        <p>MINUTES</p>
                                    </div>
                                    <div class="countdown-breadcumb d-flex flex-column">
                                        <i class="bi bi-dot"></i>
                                        <i class="bi bi-dot"></i>
                                    </div>
                                    <div class="countdown-div">
                                        <span id="seconds" class="countdown-span"></span>
                                        <p>SECONDS</p>
                                    </div>
                                </div>
                            </section>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="row g-2">
            <div class="col-12 card p-4 admin-dashboard-best-section">
                <h1 class="admin-form-title">Best Sponsors</h1>
                <p>Based on race incomes</p>
                @foreach ($topSponsors as $sponsor)
                    <div class="d-flex">
                        <div class="d-flex">
                            <i class="bi bi-briefcase"></i>
                            <h5>{{$sponsor->name}}</h5>
                        </div>
                        <div class="d-flex">
                            <i class="bi bi-cash-coin"></i>
                            <p>{{$sponsor->races_sum_sponsor_cost}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-12 card p-4 admin-dashboard-best-section">
                <h1 class="admin-form-title">Most Paid Races</h1>
                <p>Based on registration incomes</p>
                @foreach ($topRaces as $race)
                    <div class="d-flex">
                        <div class="d-flex">
                            <i class="bi bi-briefcase"></i>
                            <h5>{{$race->name}}</h5>
                        </div class="d-flex">
                        <div class="d-flex"> 
                            <i class="bi bi-cash-coin"></i>
                            <p>{{$race->drivers_count * $race->registrationPrice}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="d-flex col-3 card p-4 dashboard-top-drivers">
        <h1 class="admin-form-title">Top Drivers</h1>
        @foreach ($topDrivers as $driver)
            @if ($loop->first)
                <div class="top-driver-first d-flex align-items-center justify-content-between p-2">
                    <img src="{{ asset('storage/static/top-drivers-1.png') }}" alt="driver-first" class="ms-2">
            @elseif ($loop->iteration == 2)
                <div class="d-flex align-items-center top-driver-podium justify-content-between p-2">
                    <img src="{{ asset('storage/static/top-drivers-2.png') }}" alt="driver-second" class="ms-2">
            @elseif ($loop->iteration == 3)
                <div class="d-flex align-items-center top-driver-podium justify-content-between p-2">
                    <img src="{{ asset('storage/static/top-drivers-3.png') }}" alt="driver-third" class="ms-2">
            @else
                <div class="d-flex align-items-center top-driver-no-podium justify-content-between p-2">
                    <i class="bi bi-person ms-2"></i>
            @endif
                <span class="w-50 text-start">{{$driver->name}}</span>
                <span class="me-2">{{$driver->points}} pts</span>
            </div>
        @endforeach
    </div>
  </div>
</div>


@stop