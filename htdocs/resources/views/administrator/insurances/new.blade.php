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
    <h1 class="admin-form-title text-white">Create Insurance</h1>

    <form class="row g-3 text-white" action="{{route('/admin/insurances/new')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <label for="insuranceCIF" class="form-label">CIF</label>
            <input type="text" name="insuranceCIF" class="form-control" id="insuranceCIF" value="{{old('insuranceCIF')}}" required>
        </div>
        <div class="col-md-6">
            <label for="insuranceName" class="form-label">Name</label>
            <input type="text" name="insuranceName" class="form-control" id="insuranceName" value="{{old('insuranceName')}}" required>
        </div>
        <div class="col-md-6">
            <label for="insuranceLogo" class="form-label">Logo</label>
            <input type="file" name="insuranceLogo" class="form-control" id="insuranceLogo" value="{{old('insuranceLogo')}}" required>
        </div>
        <div class="col-12">
            <label for="insuranceAddress" class="form-label">Address</label>
            <input type="text" name="insuranceAddress" class="form-control" id="insuranceAddress" placeholder="1234 Main St" value="{{old('insuranceAddress')}}" required>
        </div>
        <div class="col-md-6">
            <label for="insuranceCost" class="form-label">Price Per Race</label>
            <input type="number" name="insuranceCost" class="form-control" id="insuranceCost" value="{{old('insuranceCost')}}" required>
        </div>
        
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="insuranceActive" checked>
                <label class="form-check-label" for="insuranceActive">
                    Visible
                </label>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Create Insurance</button>
        </div>
    </form>
@stop




