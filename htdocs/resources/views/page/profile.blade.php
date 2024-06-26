@extends('page.layouts.master')

@section('title', 'Profile')

@section('content')
    <h1 class="index-page-headers my-5">PROFILE</h1>
    
    

    <div class="container-fluid profile-container">
        <div class="row no-gutters">
          <div class="col-lg-5">
            <div class="cell shadow text-white p-4">
                <div class="row">
                  <div class="col">
                    <h1 class="text-white">{{$driver->name}}</h1>
                  </div>
                  <div class="col text-end">
                    <small>{{$driver->created_at}}</small>
                  </div>
                </div>
                <p>{{$driver->email}}</p>
                <div class="row">
                  <div class="col">
                    @if ($driver->gender == 0)
                      <span>{{$driver->gender = 'Female'}}</span>
                    @else
                      <span>{{$driver->gender = 'Male'}}</span>
                    @endif
                    <span>, {{$age}}</span>
                  </div>
                  <div class="col text-end">
                    <a class="text-white fs-5" href="{{route('user.logout')}}"><i class="bi bi-box-arrow-left"></i></a>
                  </div>
                </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="cell shadow p-4">
              <div class="row">
                <div class="col-10">
                  <h1 class="fs-3">Last Race Classification</h1>
                </div>
               
                <div class="row">
                  @if ($lastRace)
                    <div class="col-10">
                      <div id="scratch-win" class="scratch-win">
                        {{-- <div class="scratch-win__title"> Scratch & win</div> --}}
                        <div class="scratch-win__scratcher">
                          <div class="scratch-win__background">
                            {{$lastRace->driverPosition}}
                          </div>
                          <canvas id="canvas" class="scratch-win__foreground"></canvas>
                        </div>
                      </div>
                      
                    </div>
                    <div class="col-1">
                      <div id="coin" class="scratch-win__coin" draggable="true">
                        <div class="scratch-win__coin-base" draggable="true"></div>
                      </div>
                    </div>
                  @else
                    <p class="text-center text-white">You haven't participed in any race!</p>
                  @endif
                </div>
              </div>
              
              {{-- <div class="row">
                <div class="col">
                  <div class="d-flex justify-content-center">
                    <i class="bi bi-gift"></i>
                    
                  </div>
                </div>
              </div> --}}
            </div>
          </div>
          <div class="col-lg-2">
            <div class="cell shadow red-cell p-4">
              <div class="row">
                <div class="col-12">
                  <h1 class="fs-3">Your Points</h1>
                </div>
                <div class="col-12">
                  @if ($races)
                    <h1 class="text-center fs-1">{{$driver->points}}</h1>
                  @else
                    <h1 class="text-center fs-1">0</h1>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-12">
            <div class="cell shadow cell__big p-4">
              <div class="row w-100">
                <div class="col-12">
                  <h1 class="fs-3">All Races</h1>
                </div>
                <div class="col-12">
                  @if ($races)
                    <div class="row">
                      <span class="col-1 text-white fw-bold">Date</span>
                      <span class="col-4 text-white fw-bold">Name</span>
                      <span class="col-4 text-white fw-bold">Location</span>
                      <span class="col-1 text-white fw-bold">Position</span>
                      <span class="col-1 text-white fw-bold">Points</span>
                      <span class="col-1 text-white fw-bold">Actions</span>
                    </div>
                    <div class="row">
                      @foreach ($races as $race)
                        <div class="col-12 red-cell p-2 shadow mb-2" style="border-radius: 10px;">
                          <div class="row">
                            <span class="col-1 text-white">{{$race->date}}</span>
                            <span class="col-4 text-white">{{$race->name}}</span>
                            <span class="col-4 text-white">{{$race->startingPlace}}</span>
                            <span class="col-1 text-white">{{$race->driverPosition}}</span>
                            <span class="col-1 text-white">
                              @if ($race->driverPosition === 1)
                                  1000
                              @elseif ($race->driverPosition === 2)
                                  500
                              @elseif ($race->driverPosition === 3)
                                  300
                              @else
                                  0
                              @endif
                            </span>
                            <span class="col-1 text-white"><a href="/raceClassification/{{$race->id}}">Classification</a></span>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  @else
                      <p class="text-center text-white">You haven't participed in any race!</p>
                  @endif
                </div>
              </div>
            </div>
        </div>
      </div>
  </div>
  
  

@endsection