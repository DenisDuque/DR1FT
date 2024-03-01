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
    <div class="row mt-5 text-white">
        <div class="col-lg-5 col-md-12">
            banner | map
        </div>
        <div class="col-lg-7 col-md-12 ">
            <div class="row">
                <h1 class="admin-form-title">Create Race</h1>
                <small>Encourage everyone to push their limits.</small>
            </div>
            <div class="row bg-admin p-5 card">
                <form class="row g-3" action="{{route('admin.races.new')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12 col-md-6">
                        <label for="raceName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="raceName" value="{{old('raceName')}}" required/>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <label for="raceDate">Date</label>
                        <input type="date" name="raceDate" value="{{old('raceDate')}}" required/>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <label for="raceDescription">Description</label>
                        <input type="text" class="form-control" name="raceDescription" value="{{old('raceDescription')}}" required/>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <label for="raceMap">Map</label>
                        <input type="file" class="form-control" name="raceMap" value="{{old('raceMap')}}" required/>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <label for="raceMaxParticipants">Max. Participants</label>
                        <input type="range" class="form-range" min="8" max="20" name="raceMaxParticipants" value="{{old('raceMaxParticipants')}}" required/>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <label for="raceLength">Length (km)</label>
                        <input type="number" class="form-control" name="raceLength" value="{{old('raceLength')}}" required/>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <label for="raceBanner">Banner</label>
                        <input type="file" class="form-control" name="raceBanner" value="{{old('raceBanner')}}" required/>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <label for="raceCoords">Place (coords)</label>
                        <input type="text" class="form-control" name="raceCoords" value="{{old('raceCoords')}}" required/>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <label for="raceSponsorCost">Sponsor Cost</label>
                        <input type="number" class="form-control" name="raceSponsorCost" value="{{old('raceSponsorCost')}}" required/>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <label for="raceRegistrationPrice">Registration Price</label>
                        <input type="number" class="form-control" name="raceRegistrationPrice" value="{{old('raceRegistrationPrice')}}" required/>
                    </div>
                    <div class="form-check form-switch">
                        <label for="raceActive">Pro</label>
                        <input type="checkbox" class="form-check-input" name="racePro" value="1" value="{{old('racePro')}}"/>
                    </div>
                    <div class="form-check form-switch">
                        <label for="raceActive">Visible</label>
                        <input type="checkbox" class="form-check-input" name="raceActive" value="1" checked/>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Save</button>
                    </div>
        </div>
    </div>
@stop