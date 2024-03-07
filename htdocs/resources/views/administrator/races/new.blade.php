@extends('administrator.layouts.master')


@section('content')
<div class="row mt-5 text-white">
    <div class="col-lg-5 col-md-12">
        banner | map
    </div>
    <div class="col-lg-7 col-md-12 ">
        <div class="row my-2">
            <div class="col-6">
                <h1 class="admin-form-title">Create Race</h1>
                <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</small>
            </div>
            <div class="col-6">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error: </strong> {{$error}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="row bg-admin card">
                <div class="col-12 shadow p-3">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">DETAILS</a></li>
                            <li class="breadcrumb-item active" aria-current="page">INSURANCES</li>
                            <li class="breadcrumb-item active" aria-current="page">SPONSORS</li>
                        </ol>
                    </nav>
                </div>
                <form class="row g-2 px-5 pb-4" action="{{route('admin.races.new')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-8">
                        <label for="raceName" class="form-label">Name</label>
                        <input type="text" name="raceName" class="form-control" id="raceName">
                    </div>
                    <div class="col-md-4">
                        <label for="raceDate" class="form-label">Date</label>
                        <input type="date" name="raceDate" class="form-control" id="raceDate">
                    </div>
                    <div class="col-7">
                        <label for="raceMaxParticipants" class="form-label">Max. Participants</label>
                        <input type="range" name="raceMaxParticipants" class="form-range" id="raceMaxParticipants" min="8" max="32">
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="racePro" name="racePro">
                            <label class="form-check-label" for="racePro">
                                Professional
                            </label>
                        </div>
                    </div>
                    <div class="col-3 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="raceActive" name="raceActive" checked>
                            <label class="form-check-label" for="raceActive">
                                Visible
                            </label>
                        
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="raceCoords" class="form-label">Coords</label>
                        <input type="text" name="raceCoords" class="form-control" id="raceCoords">
                    </div>
                    <div class="col-md-5">
                        <label for="raceMap" class="form-label">Map</label>
                        <input type="file" name="raceMap" class="form-control" id="raceMap">
                    </div>
                    <div class="col-md-2">
                        <label for="raceLength" class="form-label">Length</label>
                        <input type="number" name="raceLength" class="form-control" id="raceLength">
                    </div>
                    <div class="col-md-6">
                        <label for="raceSponsorCost" class="form-label">Sponsor Cost</label>
                        <input type="number" name="raceSponsorCost" class="form-control" id="raceSponsorCost">
                    </div>
                    <div class="col-md-6">
                        <label for="raceRegistrationPrice" class="form-label">Registration Price</label>
                        <input type="number" name="raceRegistrationPrice" class="form-control" id="raceRegistrationPrice">
                    </div>
                    <div class="col-md-4">
                        <label for="raceBanner" class="form-label">Banner</label>
                        <input type="file" name="raceBanner" class="form-control" id="raceBanner">
                    </div>
                    <div class="col-md-12">
                        <label for="raceDescription" class="form-label">Description</label>
                        <textarea name="raceDescription" class="form-control" id="raceDescription" placeholder="Type Something..."></textarea>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i>Next</button>
                    </div>
                </form>  
            </div>
        </div>
    </div>
@stop