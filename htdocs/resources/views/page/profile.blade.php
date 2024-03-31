@extends('page.layouts.master')

@section('title', 'Profile')

@section('content')
    <h1 class="index-page-headers my-5">PROFILE</h1>
    
    <a href="{{route('user.logout')}}">salir</a>

    <div class="container-fluid">
        <div class="row no-gutters">
          <div class="col-5">
            <div class="cell shadow">
                <h1 class="text-white">{{$driver->name}}</h1>
            </div>
          </div>
          <div class="col-4">
            <div class="cell shadow"></div>
          </div>
          <div class="col-3">
            <div class="cell shadow"></div>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-9">
            <div class="cell shadow cell__big">
                <div>
                    @foreach ($races as $race)
                        <p class="text-white">{{$race->name}}</p>

                    @endforeach
                </div>
            </div>
        </div>
          <div class="col-3">
              <div class="cell shadow cell__big"></div>
          </div>
      </div>
  </div>
  
@endsection