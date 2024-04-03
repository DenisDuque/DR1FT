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
                            @if (strtotime($race->date) < strtotime(now()))
                                <li class="breadcrumb-item edit-race-photos me-2" aria-current="page">PHOTOS</li>
                            @endif
                        </ol>
                    </nav>
                </div>
                <div id="edit-races-container"></div>
                <form class="row g-2 px-5 pb-4" action="{{ route('admin.races.edit', ['id' => $race->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('administrator.layouts.forms.race-edit-details')
                    @include('administrator.layouts.forms.race-edit-insurances')
                    @include('administrator.layouts.forms.race-edit-sponsors')
                    @include('administrator.layouts.forms.race-edit-drivers')
                    @include('administrator.layouts.forms.race-edit-photos')
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success text-white">Save<i class="bi bi-chevron-double-right"></i></button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    
@stop




