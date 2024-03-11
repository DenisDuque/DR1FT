@extends('administrator.layouts.master')

@section('content')
    <section class="row mt-5 mb-3 d-flex align-items-center justify-content-between">
        <div class="col-4">
            <h1 class="admin-form-title text-white">All Insurances</h1>
        </div>
        <div class="col-4">
            <input class="col-12 form-control" id="insurances-search" type="text" placeholder="Search">
        </div>
        <div class="col-4 text-end">
            <a class="btn btn-primary text-white" href="/admin/insurances/new" role="button"><i class="bi bi-plus-lg"></i> Add Insurance</a>
        </div>
    </section>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('administrator.layouts.notice')

    <div class="table-responsive table-border" style="max-height: 75vh;">
        <table class="table table-dark table-hover shadow overflow-hidden">
        <thead class="position-relative">
            <tr>
                <th scope="col" class="sticky-top fixed-cel">#</th>
                <th scope="col" class="sticky-top fixed-cel">Logo</th>
                <th scope="col" class="sticky-top fixed-cel">CIF</th>
                <th scope="col" class="sticky-top fixed-cel">Name</th>
                <th scope="col" class="sticky-top fixed-cel">Address</th>
                <th scope="col" class="text-center sticky-top fixed-cel">Price per Race</th>
                <th scope="col" class="sticky-top fixed-cel">Actions</th>
            </tr>
        </thead>
        <tbody  id="insurances-table-body">
            @foreach($insurances as $insurance)
                <tr>
                    <td class="align-middle fw-bold">{{$insurance->id}}</td>
                    <td class="align-middle"><img class="img-thumbnail" src="{{ asset('storage/insurance_logos/' . $insurance->logo) }}" alt="{{$insurance->name}}"></td>
                    <td class="align-middle">{{$insurance->cif}}</td>
                    <td class="align-middle">{{$insurance->name}}
                        @if ($insurance->active == 0)
                            <span class="badge rounded-pill bg-badge-disabled">Disabled</span>
                        @endif
                    </td>
                    <td class="align-middle">{{$insurance->address}}</td>
                    <td class="text-center align-middle"><span class="badge rounded-pill bg-badge-purple">{{$insurance->pricePerRace}}$</span></td>
                    <td class="align-middle"><a class="admin-link" href="{{ route('admin.insurances.edit', ['id' => $insurance->id]) }}"><i class="bi bi-pencil-square"></i>Edit</a></td>
                </tr>
            @endforeach
            
        </tbody>
        </table>
    </div>
@stop