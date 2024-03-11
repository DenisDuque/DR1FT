@extends('administrator.layouts.master')

@section('content')
    <section class="mt-5 mb-3 d-flex align-items-center justify-content-between">
        <h1 class="admin-form-title text-white">All Sponsors</h1>
        <input id="sponsors-search" type="text" placeholder="Search">
        <a class="btn btn-primary" href="/admin/sponsors/new" role="button"><i class="bi bi-plus-lg"></i> Add Sponsor</a>
    </section>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('administrator.layouts.notice')
    <table class="table table-dark table-hover">
    <thead>
        <tr>
            <th scope="col" class="py-3 text-center">#</th>
            <th scope="col" class="py-3">Logo</th>
            <th scope="col" class="py-3">Name</th>
            <th scope="col" class="py-3">CIF</th>
            <th scope="col" class="py-3">Address</th>
            <th scope="col" class="py-3 text-center">Actions</th>
        </tr>
    </thead>
    <tbody id="sponsors-table-body">
        @foreach($sponsors as $sponsor)
            <tr>
                <td class="py-3 text-center align-middle fw-bold">{{$sponsor->id}}</td>
                <!-- <td>{{$sponsor->logo}}</td> -->
                <td class="py-3 align-middle"><i class="bi bi-image"></i></td>
                <td class="py-3 align-middle">{{$sponsor->name}}
                    @if ($sponsor->active == 0)
                        <span class="badge rounded-pill bg-badge-disabled">Disabled</span>
                    @endif
                </td>
                <td class="py-3 align-middle">{{$sponsor->cif}}</td>
                <td class="py-3 align-middle">{{$sponsor->address}}</td>
                <td class="py-3 align-middle text-center">
                    <a href="#" class="admin-link me-3"><i class="bi bi-info-circle"></i>Details</a>
                    <a href="{{ route('admin.sponsors.edit', ['id' => $sponsor->id]) }}" class="admin-link"><i class="bi bi-pencil-square"></i>Edit</a>
                </td>
            </tr>
        @endforeach
        
    </tbody>
    </table>
@stop