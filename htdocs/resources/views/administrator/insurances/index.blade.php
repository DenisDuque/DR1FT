@extends('administrator.layouts.master')

@section('content')
    <section class="mt-5 mb-3 d-flex align-items-center justify-content-between">
        <h1 class="admin-form-title text-white">All Insurances</h1>
        <input id="insurances-search" type="text" placeholder="Search">
        <a class="btn btn-primary" href="/admin/insurances/new" role="button"><i class="bi bi-plus-lg"></i> Add Insurance</a>
    </section>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(session()->has('success'))
        <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i>
            <div>
            {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session()->has('info'))
        <div class="alert alert-primary d-flex align-items-center alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle-fill me-1"></i>
            <div>
                {{ session('info') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-dark table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Logo</th>
        <th scope="col">Name</th>
        <th scope="col">CIF</th>
        <th scope="col">Address</th>
        <th scope="col" class="text-center">Price per Race</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody  id="insurances-table-body">
        @foreach($insurances as $insurance)
            <tr>
                <td class="align-middle fw-bold">{{$insurance->id}}</td>
                <td class="align-middle"><img class="img-thumbnail" src="{{ asset('storage/insurance_logos/' . $insurance->logo) }}" alt="{{$insurance->name}}"></td>
                <td class="align-middle">{{$insurance->name}}
                    @if ($insurance->active == 0)
                        <span class="badge rounded-pill bg-badge-disabled">Disabled</span>
                    @endif
                </td>
                <td class="align-middle">{{$insurance->cif}}</td>
                <td class="align-middle">{{$insurance->address}}</td>
                <td class="text-center align-middle"><span class="badge rounded-pill bg-badge-purple">{{$insurance->pricePerRace}}$</span></td>
                <td class="align-middle"><a class="admin-link" href="{{ route('admin.insurances.edit', ['id' => $insurance->id]) }}"><i class="bi bi-pencil-square"></i>Edit</a></td>
            </tr>
        @endforeach
        
    </tbody>
    </table>
@stop