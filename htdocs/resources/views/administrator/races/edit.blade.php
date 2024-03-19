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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input id="edit-races-race-id" type="hidden" value="{{$race->id}}">
    <div class="row mt-5 text-white">
        <div class="col-lg-5 col-md-12 preview-container">
            <div class="d-flex justify-content-center">
                <h3 class="text-uppercase breadcrumb-item active fs-5 mx-2" role="button">banner</h3>
                <h3 class="text-uppercase breadcrumb-item fs-5 mx-2" role="button">map</h3>
            </div>
            
            <div id="bannerPreview" class="mt-2">
                <img src="{{asset('storage/race_banners/'.$race->banner)}}" alt="" srcset="">
            </div>
            <div id="mapPreview" class="mt-2">
                <img src="{{asset('storage/race_maps/'.$race->map)}}" alt="" srcset="">
            </div>
        </div>
        <div class="col-lg-7 col-md-12">
            <div class="row my-2">
                <div class="col-6">
                    <h1 class="admin-form-title">Edit Race</h1>
                    <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</small>
                    <a href="{{route('admin.races.asignRaceNumbers', ['raceId' => $race->id])}}" class="btn btn-primary">Assign Participants Number</a>
                </div>
                <div class="col-6 overflow-auto">
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
                <div class="col-12 shadow text-white d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol id="edit-races-nav" class="breadcrumb m-0 p-3">
                            <li class="breadcrumb-item me-2 edit-race-details active">DETAILS</li>
                            <li class="breadcrumb-item edit-race-insurances me-2" aria-current="page">INSURANCES</li>
                            <li class="breadcrumb-item edit-race-sponsors me-2" aria-current="page">SPONSORS</li>
                            <li class="breadcrumb-item edit-race-drivers me-2" aria-current="page">DRIVERS</li>
                            <li class="breadcrumb-item edit-race-photos me-2" aria-current="page">PHOTOS</li>
                        </ol>
                    </nav>
                </div>
                <div id="edit-races-container"></div>
                <form class="row g-2 px-5 pb-4" action="{{ route('admin.races.edit', ['id' => $race->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div id="edit-race-details" class="editRaceSection">
                        <div class="col-md-8">
                            <label for="raceName" class="form-label">Name</label>
                            <input type="text" name="raceName" class="form-control" id="raceName" value="{{$race->name}}">
                        </div>
                        <div class="col-md-4">
                            <label for="raceDate" class="form-label">Date</label>
                            <input type="date" name="raceDate" class="form-control" id="raceDate" value="{{$race->date}}">
                        </div>
                        <div class="col-7">
                            {{-- <input type="range" name="raceMaxParticipants" class="form-range" id="raceMaxParticipants" min="8" max="32"> --}}
                            
                                <div class="row justify-content-center">
                                    <div class="col-lg-12 col-md-8 -col-sm-10 col-12">
                                        <div class="range-item">
                                        <label for="raceMaxParticipants" class="form-label col-12">Max. Participants</label>
                                        
                                        <div class="range-input d-flex position-relative">
                                        <input type="range" min="8" max="32" class="form-range" name="raceMaxParticipants" value="{{$race->maxParticipants}}" />
                                        <div class="range-line">
                                            <span class="active-line"></span>
                                        </div>
                                        <div class="dot-line">
                                            <span class="active-dot"></span>
                                            <span class="value-indicator"></span>
                                        </div>
                                        </div>
                                        <ul class="list-inline list-unstyled">
                                        <li class="list-inline-item">
                                            <span>8</span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span>16</span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span>24</span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span>32</span>
                                        </li>
                                        </ul>
                                    </div>
                                    </div>
                                </div> 
                        </div>
                        <div class="col-2 d-flex align-items-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="racePro" name="racePro" value="{{$race->pro}}">
                                <label class="form-check-label" for="racePro">
                                    Professional
                                </label>
                            </div>
                        </div>
                        <div class="col-3 d-flex align-items-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="raceActive" name="raceActive" value="{{$race->active}}" checked>
                                <label class="form-check-label" for="raceActive">
                                    Visible
                                </label>
                            
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="raceCoords" class="form-label">Coords</label>
                            <input type="text" name="raceCoords" class="form-control" id="raceCoords" value="{{$race->startingPlace}}">
                        </div>
                        <div class="col-md-5">
                            <label for="raceMap" class="form-label">Map</label>
                            <input type="file" name="raceMap" class="form-control" id="raceMap" value="{{$race->map}}">
                        </div>
                        <div class="col-md-2">
                            <label for="raceLength" class="form-label">Length</label>
                            <input type="number" name="raceLength" class="form-control" id="raceLength" value="{{$race->length}}">
                        </div>
                        <div class="col-md-6">
                            <label for="raceSponsorCost" class="form-label">Sponsor Cost</label>
                            <input type="number" name="raceSponsorCost" class="form-control" id="raceSponsorCost" value="{{$race->sponsorCost}}">
                        </div>
                        <div class="col-md-6">
                            <label for="raceRegistrationPrice" class="form-label">Registration Price</label>
                            <input type="number" name="raceRegistrationPrice" class="form-control" id="raceRegistrationPrice" value="{{$race->registrationPrice}}">
                        </div>
                        <div class="col-md-4 col-lg-6">
                            <label for="raceBanner" class="form-label">Banner</label>
                            <input type="file" name="raceBanner" class="form-control" id="raceBanner" value="{{$race->banner}}">
                        </div>
                        <div class="col-md-12">
                            <label for="raceDescription" class="form-label">Description</label>
                            <textarea name="raceDescription" class="form-control" id="raceDescription" value="{{$race->description}}" placeholder="Type Something..."></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-success text-white">Save<i class="bi bi-chevron-double-right"></i></button>
                        </div>
                    </div>
                    <div id="edit-race-insurances" class="editRaceSection d-none">

                    </div>
                    <div id="edit-race-sponsors" class="editRaceSection d-none">
                        
                    </div>
                    <div id="edit-race-drivers" class="editRaceSection d-none">
                        
                    </div>
                    <div id="edit-race-photos" class="editRaceSection d-none">
                        aaaa
                    </div>
                </form>

            </div>
        </div>
    </div>

    
@stop




