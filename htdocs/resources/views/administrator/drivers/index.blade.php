@extends('administrator.layouts.master')

@section('content')
    <h1>All Drivers</h1>
    <a class="btn btn-primary" href="/admin/drivers/new" role="button">Add Driver</a>

    <table class="table table-dark table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Address</th>
        <th scope="col">Birth Date</th>
        <th scope="col">Gender</th>
        <th scope="col">Member</th>
        <th scope="col">Nº Federation</th>
        <th scope="col">Points</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($drivers as $driver)
            <tr>
                <td>{{$driver->id}}</td>
                <td>{{$driver->name}}
                    @if ($driver->pro == 1)
                        <span class="badge rounded-pill bg-warning text-dark">PRO</span>
                    @endif
                </td>
                <td>{{$driver->email}}</td>
                <td>{{$driver->address}}</td>
                <td>{{$driver->birthDate}}</td>
                <td>{{$driver->gender}}</td>
                <td>{{$driver->member}}</td>
                <td>{{$driver->federationNumber}}</td>
                <td>{{$driver->points}}</td>
                <td><a href="{{ route('admin.drivers.edit', ['id' => $driver->id]) }}">Edit</a></td>
            </tr>
        @endforeach
        
    </tbody>
    </table>
@stop