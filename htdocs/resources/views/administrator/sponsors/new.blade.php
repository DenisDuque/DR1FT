@extends('administrator.layouts.master')

@section('content')
    <div class="row mt-5 text-white">
        <div class="col-lg-6 col-md-12">
            <h1 class="admin-form-title">Add a new sponsor</h1>
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
        <div class="col-lg-6 col-md-12 bg-admin p-5 card">
            <form class="row g-3" action="{{route('admin.sponsors.new')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-12 col-md-6">
                    <label for="sponsorName" class="form-label">Name</label>
                    <input type="text" name="sponsorName" class="form-control" id="sponsorName"  value="{{old('sponsorName')}}">
                </div>
                <div class="col-md-6">
                    <label for="sponsorCIF" class="form-label">CIF</label>
                    <input type="text" name="sponsorCIF" class="form-control" id="sponsorCIF"  value="{{old('sponsorCIF')}}">
                </div>
                <div class="col-md-6">
                    <label for="sponsorLogo" class="form-label">Logo</label>
                    <input type="file" name="sponsorLogo" class="form-control" id="sponsorLogo"  value="{{old('sponsorLogo')}}">
                </div>
                <div class="col-12">
                    <label for="sponsorAddress" class="form-label">Address</label>
                    <input type="text" name="sponsorAddress" class="form-control" id="sponsorAddress" placeholder="1234 Main St"  value="{{old('sponsorAddress')}}">
                </div>
                
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="sponsorActive" id="sponsorActive" checked>
                        <label class="form-check-label form-label" for="sponsorActive">Visible</label>
                    </div>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
@stop




