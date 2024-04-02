@extends('page.layouts.master')

@section('title', 'Profile')

@section('content')
    <h1 class="index-page-headers my-5">PROFILE</h1>
    
    <a href="{{route('user.logout')}}">salir</a>

    <div class="container-fluid">
        <div class="row no-gutters">
          <div class="col-5">
            <div class="cell shadow text-white p-4">
                <h1 class="text-white">{{$driver->name}}</h1>
                <p>{{$driver->email}}</p>
                <p>{{$driver->gender}}, {{$driver->birthDate}}</p>
                <p>{{$driver->created_at}}</p>
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