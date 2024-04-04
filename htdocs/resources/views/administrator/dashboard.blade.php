@extends('administrator.layouts.master')

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
                            <a href="/admin/races/new" class="btn btn-primary">Start</a>
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
                            <a href="/admin/insurances/new" class="btn btn-primary">Start</a>
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
                            <a href="/admin/sponsors/new" class="btn btn-primary">Start</a>
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
        <div class="row g-2">
            <div class="col-12 rounded bg-red-gradient">
                <h1 class="admin-form-title">Coming Soon</h1>
                <div class="row">
                    @foreach ($nextRaces as $race)
                        <div class="col-4  text-center">
                            <img src="{{$race->map}}" alt="Race Map">
                            <i class="bi bi-people-fill"></i>{{$race->drivers->count()}}
                            <i class="bi bi-card-image"></i>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat voluptatem temporibus 
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-6 card">
                <h1 class="admin-form-title">Best Insurances</h1>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi placeat facere molestias
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi placeat facere molestias
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi placeat facere molestias
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi placeat facere molestias
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi placeat facere molestias
            </div>
            <div class="col-6">
                <div class="row g-2">
                    <div class="col-12 card">
                    <h1 class="admin-form-title">Last Race Winner</h1>
                    </div>
                </div>
                <div class="row gy-2">
                    <div class="col-6 card">
                        <input type="hidden" id="countdownDate" name="nextRaceDate" value="{{$nextRace->date}}">
                        <section>
                            <h1 class="admin-form-title">{{$nextRace->name}}</h1>
                            <i class="bi bi-clock-history"></i>
                            <div id="countdown">
                                <div>
                                    <span id="days"></span>
                                    <p>DAYS</p>
                                </div>
                                <div>
                                    <span id="hours"></span>
                                    <p>HOURS</p>
                                </div>
                                <div>
                                    <span id="minutes"></span>
                                    <p>MINUTES</p>
                                </div>
                                <div>
                                    <span id="seconds"></span>
                                    <p>SECONDS</p>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-6 card">
                        
                        <h1 class="admin-form-title">Last Race</h1>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="row g-2">
            <div class="col-12 card">
                <h1 class="admin-form-title">Best Sponsors</h1>
                @foreach ($topSponsors as $sponsor)
                    <div>
                        <div>
                            <i class="bi bi-briefcase"></i>
                            <h5>{{$sponsor->name}}</h5>
                        </div>
                        <div>
                            <i class="bi bi-cash-coin"></i>
                            <p>{{$sponsor->races_sum_sponsor_cost}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-12 card">
                <h1 class="admin-form-title">Most Paid Races</h1>
                @foreach ($topRaces as $race)
                    <div>
                        <div>
                            <i class="bi bi-briefcase"></i>
                            <h5>{{$race->name}}</h5>
                        </div>
                        <div>
                            <i class="bi bi-cash-coin"></i>
                            <p>{{$race->drivers_count * $race->registrationPrice}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-3 card">
        <h1 class="admin-form-title">Top Drivers</h1>
        @foreach ($topDrivers as $driver)
            <div>
                <i class="bi bi-trophy"></i>
                <h5>{{$driver->name}}</h5>
                <p>{{$driver->points}}</p>
            </div>
        @endforeach
    </div>
  </div>
</div>


@stop