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
    <h1>Mostrar editar driver</h1>

    <form class="row g-3" action="{{ route('admin.drivers.edit', ['id' => $driver->id]) }}" method="POST">
        @csrf
        <div class="col-md-6">
            <label for="driverName" class="form-label">Name</label>
            <input type="text" name="driverName" class="form-control" id="driverName" value="{{$driver->name}}">
        </div>
        <div class="col-md-6">
            <label for="driverEmail" class="form-label">Email</label>
            <input type="email" name="driverEmail" class="form-control" id="driverEmail" value="{{$driver->email}}">
        </div>
        <div class="col-md-6">
            <label for="driverPassword" class="form-label">Password</label>
            <input type="password" name="driverPassword" class="form-control" id="driverPassword" placeholder="New password">
        </div>
        <div class="col-md-6">
            <label for="driverPasswordConfirm" class="form-label">Confirm Password</label>
            <input type="password" name="driverPasswordConfirm" class="form-control" id="driverPasswordConfirm" placeholder="Confirm Password">
        </div>
        <div class="col-12">
            <label for="driverAddress" class="form-label">Address</label>
            <input type="text" name="driverAddress" class="form-control" id="driverAddress" placeholder="1234 Main St" value="{{$driver->address}}">
        </div>
        <div class="col-md-6">
            <label for="driveBirthDate" class="form-label">Birth Date</label>
            <input type="text" name="driveBirthDate" class="form-control" id="driveBirthDate" value="{{$driver->birthDate}}">
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="driverPro" name="driverPro" {{ $driver->pro == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="driverPro">PRO</label>
        </div>
        <div class="col-md-2">
            <label for="driverGender" class="form-label">Gender</label>
            <select id="driverGender" name="driverGender" class="form-select">
            <option value="1" {{ $driver->gender == 1 ? 'selected' : '' }}>Male</option>
            <option value="0" {{ $driver->gender == 0 ? 'selected' : '' }}>Female</option>
            </select>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="driverMember" name="driverMember" {{ $driver->member == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="driverMember">Member</label>
        </div>
        <div class="col-md-6">
            <label for="driverFederation" class="form-label">Nº Federation</label>
            <input type="text" name="driverFederation" class="form-control" id="driverFederation" value="{{$driver->federationNumber}}">
        </div>
        <div class="col-md-6">
            <label for="driverPoints" class="form-label">Points</label>
            <input type="number" name="driverPoints" class="form-control" id="driverPoints" value="{{$driver->points}}" readonly>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Edit user</button>
        </div>
    </form>
@stop




