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
                <h1 class="admin-form-title">Race Details</h1>
                <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</small>
            </div>
            <div class="row bg-admin card">
                <div class="col-12 shadow text-white d-flex align-items-center">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-3">
                            <li class="breadcrumb-item me-3 active">DETAILS</li>
                            <li class="breadcrumb-item me-3 " aria-current="page">INSURANCES</li>
                            <li class="breadcrumb-item me-3" aria-current="page">SPONSORS</li>
                            <li class="breadcrumb-item me-3" aria-current="page">DRIVERS</li>
                            <li class="breadcrumb-item me-3" aria-current="page">PHOTOS</li>
                        </ol>
                    </nav>
                </div>
                <form class="row g-2 p-4" action="{{ route('admin.races.edit', ['id' => $race->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="col-md-8">
                        <label for="raceName" class="form-label">Name</label>
                        <!-- <input type="text" name="raceName" class="form-control" id="raceName" value="{{$race->name}}" aria-label="Disabled input example" disabled readonly> -->
                        <p class="text-white">{{$race->name}}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="raceDate" class="form-label">Date</label>
                        <!-- <input type="date" name="raceDate" class="form-control" id="raceDate" value="{{$race->date}}" aria-label="Disabled input" disabled readonly> -->
                        <span class="badge rounded-pill bg-secondary"><i class="bi bi-calendar-event me-1"></i>{{$race->date}}</span>
                    </div>
                    <div class="col-2">
                        <label for="raceMaxParticipants" class="form-label">Max. Participants</label>
                        <input type="text" class="form-control" name="maxParticipans" id="maxParticipans" aria-label="Disabled input" value="{{$race->maxParticipants}}" disabled readonly>
                        
                    </div>
                    <div class="col-md-2">
                        <label for="raceSponsorCost" class="form-label">Sponsor Cost</label>
                        <input type="number" name="raceSponsorCost" class="form-control" id="raceSponsorCost" value="{{$race->sponsorCost}}" aria-label="Disabled input example" disabled readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="raceRegistrationPrice" class="form-label">Registration Price</label>
                        <input type="number" name="raceRegistrationPrice" class="form-control" id="raceRegistrationPrice" value="{{$race->registrationPrice}}" aria-label="Disabled input example" disabled readonly>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input aria-label="Disabled input example" disabled readonly class="form-check-input" type="checkbox" role="switch" id="racePro" name="racePro" {{ $race->pro == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="racePro">
                                Professional
                            </label>
                        </div>
                    </div>
                    <div class="col-3 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="raceActive" name="raceActive" aria-label="Disabled input example" disabled readonly {{ $race->active == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="raceActive">
                                Visible
                            </label>
                        
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="raceCoords" class="form-label">Coords</label>
                        <input type="text" name="raceCoords" class="form-control" id="raceCoords" value="{{$race->startingPlace}}" aria-label="Disabled input example" disabled readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="raceLength" class="form-label">Length</label>
                        <input type="number" name="raceLength" class="form-control" id="raceLength" value="{{$race->length}}" aria-label="Disabled input example" disabled readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="raceDescription" class="form-label">Description</label>
                        <textarea name="raceDescription" class="form-control" id="raceDescription" value="{{$race->description}}" aria-label="Disabled input example" disabled readonly>{{$race->description}}</textarea>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success text-white"><i class="bi bi-check-lg"></i>Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <p>{{$race->sponsors}}</p>

    
@stop




