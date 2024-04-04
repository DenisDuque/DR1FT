@extends('page.layouts.master')

@section('title', 'Profile')

@section('content')
    <h1 class="index-page-headers my-5">PROFILE</h1>
    
    <a href="{{route('user.logout')}}">salir</a>

    <div class="container-fluid profile-container">
        <div class="row no-gutters">
          <div class="col-5">
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
                    <i class="bi bi-pencil-square"></i>
                  </div>
                </div>
            </div>
          </div>
          <div class="col-4">
            <div class="cell shadow p-4">
              <div class="row">
                <div class="col-10">
                  <h1 class="fs-3">Last Race Classification</h1>
                </div>
                <div class="col-1">
                  <i class="bi bi-question-circle-fill"></i>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="d-flex justify-content-center">
                    <i class="bi bi-gift"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="cell shadow red-cell"></div>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-9">
            <div class="cell shadow cell__big p-4">
              <div class="row">
                <div class="col-12">
                  <h1 class="fs-3">All Races</h1>
                </div>
                <div class="col-12">
                  <div class="row">
                    @foreach ($races as $race)
                      <div class="col-12 red-cell rounded">
                        <p class="text-white">{{$race->name}}</p>
                      </div>

                    @endforeach
                  </div>
                </div>
              </div>
            </div>
        </div>
          <div class="col-3">
              <div class="cell shadow cell__big"></div>
          </div>
      </div>
  </div>
  
@endsection