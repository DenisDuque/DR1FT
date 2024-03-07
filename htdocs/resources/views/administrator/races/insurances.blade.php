@extends('administrator.layouts.master')


@section('content')
<div class="row mt-5 text-white">
    <div class="col-lg-5 col-md-12">
        banner | map
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
                <div class="col-12 shadow p-3">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">DETAILS</li>
                            <li class="breadcrumb-item"><a href="#">INSURANCES</a></li>
                            <li class="breadcrumb-item active" aria-current="page">SPONSORS</li>
                        </ol>
                    </nav>
                </div>
                <!-- CAMBIAR ACTION FORM -->
                <form class="row g-2 px-5 pb-4" action="{{route('admin.races.new.insurances')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Name</th>
                            <th scope="col">CIF</th>
                            <th scope="col">Address</th>
                            <th scope="col" class="text-center">Price per Race</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($insurances as $insurance)
                                <tr>
                                    <td class="align-middle fw-bold"><input class="form-check-input" type="checkbox" name="raceInsurances[]" value="{{$insurance->id}}"></td>
                                    <td class="align-middle">

                                        <img class="img-thumbnail" src="{{ asset('storage/insurance_logos/' . $insurance->logo) }}" alt="{{$insurance->name}}">
                                    </td>
                                    <td class="align-middle">{{$insurance->name}}
                                        @if ($insurance->active == 0)
                                            <span class="badge rounded-pill bg-badge-disabled">Disabled</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{$insurance->cif}}</td>
                                    <td class="align-middle">{{$insurance->address}}</td>
                                    <td class="text-center align-middle"><span class="badge rounded-pill bg-badge-purple">{{$insurance->pricePerRace}}$</span></td>
                                    <td class="align-middle"><a class="admin-link" href="{{ route('admin.insurances.edit', ['id' => $insurance->id]) }}"><i class="bi bi-pencil-square"></i>Edit</a></td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                        </table>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i>Next</button>
                        </div>
                </form>  
            </div>
        </div>
    </div>
@stop