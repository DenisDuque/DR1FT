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
    <h1>Create Sponsor</h1>

    <form class="row g-3" action="{{route('admin.sponsors.new')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <label for="sponsorCIF" class="form-label">CIF</label>
            <input type="text" name="sponsorCIF" class="form-control" id="sponsorCIF" required value="{{old('sponsorCIF')}}">
        </div>
        <div class="col-md-6">
            <label for="sponsorLogo" class="form-label">Logo</label>
            <input type="file" name="sponsorLogo" class="form-control" id="sponsorLogo" required value="{{old('sponsorLogo')}}">
        </div>
        <div class="col-12">
            <label for="sponsorAddress" class="form-label">Address</label>
            <input type="text" name="sponsorAddress" class="form-control" id="sponsorAddress" placeholder="1234 Main St" required value="{{old('sponsorAddress')}}">
        </div>
        
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="sponsorActive" checked>
                <label class="form-check-label" for="sponsorActive">
                    Visible
                </label>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Create Sponsor</button>
        </div>
    </form>
@stop




