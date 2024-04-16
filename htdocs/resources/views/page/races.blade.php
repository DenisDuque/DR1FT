@extends('page.layouts.master')

@section('title', 'All Races')

@section('content')
    <input type="text" name="searchRaces" id="races-user-search">
    <select name="filterRaces" id="races-user-filter">
        <option value="0"></option>
        <option value="1">PRO</option>
        <option value="2">NO PRO</option>
        <option value="3">Higher Price</option>
        <option value="4">Lower Price</option>
    </select>
    <!-- Aquí puedes agregar el contenido específico para esta vista -->
    <h1 class="index-page-headers my-5">ALL RACES</h1>
    <div id="races-content-body" class="row g-4">
        @foreach ($races as $race)
            <div class="col-md-4 col-sm-6">
                <div class="card mb-3" style="max-width: 30rem;">
                    <div class="row g-0">
                      <div class="col-md-3 h-100" style="height: 15rem;">
                        <img src="{{asset('storage/race_banners/'.$race->banner)}}" class="img-fluid rounded-start" alt="{{$race->name}}">
                      </div>
                      <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title">{{$race->name}}
                                @if ($race->pro == 1)
                                    <span class="badge rounded-pill bg-warning text-dark">PRO</span>
                                @endif
                                <span class="badge rounded-pill text-bg-light"><i class="me-1 bi bi-calendar2-week-fill"></i>{{$race->date}}</span>
                                <span class=" badge rounded-pill bg-info text-dark"><i class="bi bi-people-fill"></i>Max. {{$race->maxParticipants}}</span>
                                <span class=" badge rounded-pill bg-badge-purple">{{$race->length}} Km</span>
                            </h5>
                            <p class="card-text"><i class="bi bi-geo-alt-fill"></i>{{$race->startingPlace}}</p>
                            <a href="{{ route('race.detail', $race->id) }}" class="btn btn-primary fs-6 text-white" role="button">Participate ({{ $race->registrationPrice }}$)</a>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
