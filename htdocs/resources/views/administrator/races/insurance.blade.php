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
                            <li class="breadcrumb-item"><a href="#">DETAILS</a></li>
                            <li class="breadcrumb-item active" aria-current="page">INSURANCES</li>
                            <li class="breadcrumb-item active" aria-current="page">SPONSORS</li>
                        </ol>
                    </nav>
                </div>
                <!-- CAMBIAR ACTION FORM -->
                <form class="row g-2 px-5 pb-4" action="{{route('admin.races.new')}}" method="POST" enctype="multipart/form-data">
                    <table class="table table-dark table-hover table-border">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">CIF</th>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-center">Price per Race</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </form>  
            </div>
        </div>
    </div>
@stop