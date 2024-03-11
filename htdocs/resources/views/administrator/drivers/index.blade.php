@extends('administrator.layouts.master')

@section('content')
    <section class="mt-5 mb-3 d-flex align-items-center justify-content-between">
        <h1 class="admin-form-title text-white">All Drivers</h1>
        <input id="drivers-search" type="text" placeholder="Search">
        <a class="btn btn-primary" href="/admin/drivers/new" role="button"><i class="bi bi-plus-lg"></i> Add Driver</a>
    </section>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <table class="table table-dark table-hover shadow overflow-scroll h-75">
    <thead>
        <tr>
        <th scope="col" class="text-center align-middle">#</th>
        <th scope="col">Name</th>
        <th scope="col">Birth Date</th>
        <th scope="col">Nº Federation</th>
        <th scope="col">Points</th>
        <th scope="col">Gender</th>
        <th scope="col">Member</th>
        <th scope="col">Email</th>
        <th scope="col">Address</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody  id="drivers-table-body">
        @foreach($drivers as $driver)
            <tr>
                <td class="py-3 text-center align-middle fw-bold">{{$driver->id}}</td>
                <td>{{$driver->name}}
                    @if ($driver->pro == 1)
                        <span class="badge rounded-pill bg-warning text-dark">PRO</span>
                    @endif
                </td>
                <td>{{$driver->birthDate}}</td>
                <td>{{$driver->federationNumber}}</td>
                <td>{{$driver->points}}</td>
                <td>{{$driver->gender}}</td>
                <td>{{$driver->member}}</td>
                <td>{{$driver->email}}</td>
                <td>{{$driver->address}}</td>
                <td><a class="admin-link" href="{{ route('admin.drivers.edit', ['id' => $driver->id]) }}"><i class="bi bi-pencil-square"></i>Edit</a></td>
            </tr>
        @endforeach
    </tbody>
    </table>
@stop