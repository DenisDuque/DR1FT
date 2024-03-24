@extends('administrator.layouts.master')


@section('content')
<div class="row mt-5 text-white">
    <div class="col-lg-5 col-md-12 preview-container">
        <div class="d-flex justify-content-center">
            <h3 class="text-uppercase breadcrumb-item active fs-5 mx-2" role="button">banner</h3>
            <h3 class="text-uppercase breadcrumb-item fs-5 mx-2" role="button">map</h3>
        </div>
        
        <div id="bannerPreview" class="mt-2"></div>
        <div id="mapPreview" class="mt-2"></div>
    </div>
    <div class="col-lg-7 col-md-12 ">
        <div class="row my-2">
            <h1 class="admin-form-title">Create Race</h1>
            <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</small>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error: </strong> {{$error}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row bg-admin card">
            <div class="col-12 shadow text-white d-flex align-items-center">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-3">
                        <li class="breadcrumb-item me-2">DETAILS</li>
                        <span class="me-2">></span>
                        <li class="breadcrumb-item me-2" aria-current="page">INSURANCES</li>
                        <span class="me-2">></span>
                        <li class="breadcrumb-item me-2 active" aria-current="page">SPONSORS</li>
                    </ol>
                </nav>
            </div>
            <input id="sponsors-races-search" type="text" placeholder="Search">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <!-- CAMBIAR ACTION FORM -->
            <form class="w-100 p-0 m-0" action="{{route('admin.races.new.sponsors')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="table-responsive" style="max-height: 35rem;">
                    <table class="table table-dark table-hover overflow-hidden mt-2">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3 text-center">#</th>
                                <th scope="col" class="py-3">Logo</th>
                                <th scope="col" class="py-3">CIF</th>
                                <th scope="col" class="py-3">Name</th>
                                <th scope="col" class="py-3 text-center">Main Sponsor</th>
                            </tr>
                        </thead>
                        <tbody id="sponsors-races-table-body">
                            @foreach($sponsors as $sponsor)
                                @if ($sponsor->active == 1)
                                    <tr>
                                        <td class="py-3 text-center align-middle fw-bold"><input class="form-check-input" type="checkbox" role="switch" name="raceSponsors[]" value="{{$sponsor->id}}"></td>
                                        <td class="align-middle"><img class="img-thumbnail" src="{{ asset('storage/sponsor_logos/' . $sponsor->logo) }}" alt="{{$sponsor->name}}"></td>
                                        
                                        <td class="py-3 align-middle">{{$sponsor->cif}}</td>
                                        <td class="py-3 align-middle">{{$sponsor->name}}</td>
                                        <td class="py-3 text-center align-middle fw-bold"><input class="form-check-input" type="checkbox" role="switch" name="mainSponsors[]" value="{{$sponsor->id}}"></td>
                                    </tr>
                                @endif
                            @endforeach
                            
                        </tbody>
                    </table>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i>Save</button>
                    </div>
                </div> 
            </form>
        </div>
    </div>
</div>
@stop