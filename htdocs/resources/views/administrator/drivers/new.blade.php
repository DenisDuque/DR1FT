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
    <h1>Mostrar crear driver</h1>

    <form class="row g-3" action="{{route('admin.drivers.new')}}" method="POST">
        @csrf
        <div class="col-md-6">
            <label for="driverName" class="form-label">Name</label>
            <input type="text" name="driverName" class="form-control" id="driverName" value="{{old('driverName')}}">
        </div>
        <div class="col-md-6">
            <label for="driverEmail" class="form-label">Email</label>
            <input type="email" name="driverEmail" class="form-control" id="driverEmail" value="{{old('driverEmail')}}">
        </div>
        <div class="col-md-6">
            <label for="driverPassword" class="form-label">Password</label>
            <input type="password" name="driverPassword" class="form-control" id="driverPassword" value="{{old('driverPassword')}}">
        </div>
        <div class="col-md-6">
            <label for="driverPasswordConfirm" class="form-label">Confirm Password</label>
            <input type="password" name="driverPasswordConfirm" class="form-control" id="driverPasswordConfirm" value="{{old('driverPasswordConfirm')}}">
        </div>
        <div class="col-12">
            <label for="driverAddress" class="form-label">Address</label>
            <input type="text" name="driverAddress" class="form-control" id="driverAddress" placeholder="1234 Main St" value="{{old('driverAddress')}}">
        </div>
        <div class="col-md-6">
            <label for="driveBirthDate" class="form-label">Birth Date</label>
            <input type="text" name="driveBirthDate" class="form-control" id="driveBirthDate" value="{{old('driveBirthDate')}}">
        </div>
        <div class="col-md-2">
            <label for="driverPro" class="form-label">PRO</label>
            <select id="driverPro" name="driverPro" class="form-select">
            <option selected>Choose...</option>
            <option value="1">YES</option>
            <option value="0">NO</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="driverGender" class="form-label">Gender</label>
            <select id="driverGender" name="driverGender" class="form-select">
            <option selected>Choose...</option>
            <option value="1">Male</option>
            <option value="0">Female</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="driverMember" class="form-label">Member</label>
            <select id="driverMember" name="driverMember" class="form-select">
            <option selected>Choose...</option>
            <option value="1">YES</option>
            <option value="0">NO</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="driverFederation" class="form-label">Nº Federation</label>
            <input type="number" name="driverFederation" class="form-control" id="driverFederation">
        </div>
        <div class="col-md-6">
            <label for="driverPoints" class="form-label">Points</label>
            <input type="number" name="driverPoints" class="form-control" id="driverPoints">
        </div>
        <div class="col-12">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
                Check me out
            </label>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
    </form>
@stop




