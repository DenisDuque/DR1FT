@extends('administrator.layouts.master')

@section('content')
    <section class="row mt-5 mb-3 d-flex align-items-center justify-content-between">
        <div class="col-4">
            <h1 class="admin-form-title text-white">All Drivers</h1>
        </div>
        <div class="col-4">
            <input id="drivers-search" class="col-12 form-control" type="text" placeholder="Search">
        </div>
        <div class="col-4 text-end">
            <a class="btn btn-primary text-white" href="/admin/drivers/new" role="button"><i class="bi bi-plus-lg"></i> Add Driver</a>
        </div>
    </section>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="table-responsive table-border" style="max-height: 75vh;">
        <table class="table table-dark table-hover shadow overflow-hidden">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Nº Federation</th>
                <th scope="col">Name</th>
                <th scope="col">Birth Date</th>
                <th scope="col" class="text-center">Gender</th>
                <!-- <th scope="col">Member</th> -->
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col" class="text-center">Points</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody  id="drivers-table-body">
            @foreach($drivers as $driver)
                <tr>
                    <td class="py-3 text-center align-middle fw-bold">{{$driver->id}}</td>
                    <td class="py-3 align-middle text-center">{{$driver->federationNumber}}</td>
                    <td class="py-3 align-middle">{{$driver->name}}
                        @if ($driver->pro == 1)
                            <span class="badge rounded-pill bg-warning text-dark">PRO</span>
                        @endif
                        @if ($driver->member == 1)
                            <span class="badge rounded-pill bg-light text-dark">Member</span>
                        @endif
                    </td>
                    <td class="py-3 align-middle"><span class="badge rounded-pill bg-secondary"><i class="bi bi-calendar-event-fill me-1"></i>{{$driver->birthDate}}</span></td>
                    <td class="py-3 align-middle text-center">{{$driver->gender}}</td>
                    <!-- <td class="py-3 align-middle">{{$driver->member}}</td> -->
                    <td class="py-3 align-middle">{{$driver->email}}</td>
                    <td class="py-3 align-middle ">{{$driver->address}}</td>
                    <td class="py-3 align-middle text-center"><span class="badge rounded-pill bg-warning text-dark">{{$driver->points}} pts</span></td>
                    <td class="py-3 align-middle"><a class="admin-link" href="{{ route('admin.drivers.edit', ['id' => $driver->id]) }}"><i class="bi bi-pencil-square"></i>Edit</a></td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
@stop