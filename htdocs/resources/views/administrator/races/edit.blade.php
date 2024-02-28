@extends('administrator.layouts.master')

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error: </strong> {{$error}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif

@section('content')
    <h1>Edit Race</h1>

    <form class="row g-3" action="{{ route('admin.races.edit', ['id' => $race->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <label for="raceName" class="form-label">Name</label>
            <input type="text" name="raceName" class="form-control" id="raceName" value="{{$race->name}}">
        </div>
        <div class="col-md-6">
            <label for="raceDescription" class="form-label">Description</label>
            <input type="text" name="raceDescription" class="form-control" id="raceDescription" value="{{$race->description}}">
        </div>
        <div class="col-md-6">
            <label for="raceBanner" class="form-label">Banner</label>
            <input type="file" name="raceBanner" class="form-control" id="raceBanner" value="{{$race->banner}}">
        </div>
        <div class="col-md-6">
            <label for="raceMap" class="form-label">Map</label>
            <input type="file" name="raceMap" class="form-control" id="raceMap" value="{{$race->map}}">
        </div>
        <div class="col-12">
            <label for="raceMaxParticipants" class="form-label">Max. Participants</label>
            <input type="range" name="raceMaxParticipants" class="form-control" id="raceMaxParticipants" value="{{$race->maxParticipants}}">
        </div>
        <div class="col-md-6">
            <label for="raceLength" class="form-label">Length</label>
            <input type="number" name="raceLength" class="form-control" id="raceLength" value="{{$race->length}}">
        </div>
        <div class="col-md-6">
            <label for="raceDate" class="form-label">Date</label>
            <input type="date" name="raceDate" class="form-control" id="raceDate" value="{{$race->date}}">
        </div>
        <div class="col-md-6">
            <label for="raceCoords" class="form-label">Coords</label>
            <input type="text" name="raceCoords" class="form-control" id="raceCoords" value="{{$race->startingPlace}}">
        </div>
        <div class="col-md-6">
            <label for="raceRegistrationPrice" class="form-label">Registration Price</label>
            <input type="number" name="raceRegistrationPrice" class="form-control" id="raceRegistrationPrice" value="{{$race->registrationPrice}}">
        </div>
        <div class="col-md-6">
            <label for="raceSponsorCost" class="form-label">Sponsor Cost</label>
            <input type="number" name="raceSponsorCost" class="form-control" id="raceSponsorCost" value="{{$race->sponsorCost}}">
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="racePro" name="racePro" {{ $race->pro == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="racePro">
                    Professional
                </label>
            </div>
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="raceActive" name="raceActive" {{ $race->active == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="raceActive">
                    Visible
                </label>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Edit Race</button>
        </div>
    </form>
@stop




