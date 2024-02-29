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
                <h1 class="admin-form-title">Create a new sponsor</h1>
                <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</small>
            </div>
            <div class="row bg-admin p-5 card">
                <form class="row g-3" action="{{route('admin.races.new')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12 col-md-6">
                        <label for="raceName" class="form-label">Name:</label>
                        <input type="text" class="form-control" name="raceName" value="{{old('raceName')}}" required/>
                    </div>
                    <label for="raceDate">Date:</label>
                    <input type="date" name="raceDate" value="{{old('raceDate')}}" required/><br>
                    <label for="raceDescription">Description:</label>
                    <input type="text" name="raceDescription" value="{{old('raceDescription')}}" required/><br>
                    <label for="raceMap">Map:</label>
                    <input type="file" name="raceMap" value="{{old('raceMap')}}" required/><br>
                    <label for="raceMaxParticipants">Max Participants:</label>
                    <input type="range" name="raceMaxParticipants" value="{{old('raceMaxParticipants')}}" required/><br>
                    <label for="raceLength">Length (km):</label>
                    <input type="number" name="raceLength" value="{{old('raceLength')}}" required/><br>
                    <label for="raceBanner">Banner:</label>
                    <input type="file" name="raceBanner" value="{{old('raceBanner')}}" required/><br>
                    <label for="raceCoords">Place (coords):</label>
                    <input type="text" name="raceCoords" value="{{old('raceCoords')}}" required/><br>
                    <label for="raceSponsorCost">Sponsor Cost:</label>
                    <input type="number" name="raceSponsorCost" value="{{old('raceSponsorCost')}}" required/><br>
                    <label for="raceRegistrationPrice">Registration Price:</label>
                    <input type="number" name="raceRegistrationPrice" value="{{old('raceRegistrationPrice')}}" required/><br>
                    <label for="raceActive">Pro:</label>
                    <input type="checkbox" name="racePro" value="1" value="{{old('racePro')}}"/><br>
                    <label for="raceActive">Visible:</label>
                    <input type="checkbox" name="raceActive" value="1" checked/><br>
                    <button type="submit">Create Race</button>
                </form>
            </div>
        </div>
    </div>
@stop