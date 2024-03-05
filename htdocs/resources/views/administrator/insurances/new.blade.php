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
        <div class="col-lg-6 col-md-12">
            <h1 class="admin-form-title">Create Insurance</h1>
            <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</small>
        </div>
        <div class="col-lg-6 col-md-12 bg-admin p-5 card">
            <form class="row g-3 text-white" action="{{route('admin.insurances.new')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="insuranceName" class="form-label">Name</label>
                    <input type="text" name="insuranceName" class="form-control" id="insuranceName" placeholder="Company Name" value="{{old('insuranceName')}}" required>
                </div>
                <div class="col-md-6">
                    <label for="insuranceCIF" class="form-label">CIF</label>
                    <input type="text" name="insuranceCIF" class="form-control" id="insuranceCIF" value="{{old('insuranceCIF')}}" placeholder="B12345678" required>
                </div>
                <div class="col-md-6">
                    <label for="insuranceLogo" class="form-label">Logo</label>
                    <input type="file" name="insuranceLogo" class="form-control" id="insuranceLogo" value="{{old('insuranceLogo')}}" required>
                </div>
                <div class="col-md-6">
                    <label for="insuranceCost" class="form-label">Price Per Race</label>
                    <input type="number" name="insuranceCost" class="form-control" id="insuranceCost" value="{{old('insuranceCost')}}" placeholder="100$" required>
                </div>
                <div class="col-12">
                    <label for="insuranceAddress" class="form-label">Address</label>
                    <input type="text" name="insuranceAddress" class="form-control" id="insuranceAddress" placeholder="1234 Main St" value="{{old('insuranceAddress')}}" required>
                </div>
                
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" role="switch" type="checkbox" name="insuranceActive" id="insuranceActive" checked>
                        <label class="form-check-label" for="insuranceActive">
                            Visible
                        </label>
                    </div>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Save</button>
                </div>
            </form>
        </div>
    </div>

@stop




