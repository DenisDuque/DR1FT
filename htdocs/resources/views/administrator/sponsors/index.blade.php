@extends('administrator.layouts.master')

@section('content')
    <section class="row mt-5 mb-3 d-flex align-items-center justify-content-between">
        <div class="col-4">
            <h1 class="admin-form-title text-white">All Sponsors</h1>
        </div>
        <div class="col-4">
            <input id="sponsors-search" class="col-12 form-control" type="text" placeholder="Search">
        </div>
        <div class="col-4 text-end">
            <a class="btn btn-primary text-white" href="/admin/sponsors/new" role="button"><i class="bi bi-plus-lg"></i> Add Sponsor</a>
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
                <th scope="col" class="text-center sticky-top fixed-cel">Actions</th>
            </tr>
        </thead>
        <tbody id="sponsors-table-body">
            @foreach($sponsors as $sponsor)
                <tr>
                    <td class="py-3 text-center align-middle fw-bold">{{$sponsor->id}}</td>
                    <td class="align-middle"><img class="img-thumbnail" src="{{ asset('storage/sponsor_logos/' . $sponsor->logo) }}" alt="{{$sponsor->name}}"></td>
                    <td class="py-3 align-middle">{{$sponsor->cif}}</td>
                    <td class="py-3 align-middle">{{$sponsor->name}}
                        @if ($sponsor->active == 0)
                            <span class="badge rounded-pill bg-badge-disabled">Disabled</span>
                        @endif
                    </td>
                    <td class="py-3 align-middle">{{$sponsor->address}}</td>
                    <td class="py-3 align-middle text-center">
                        <a href="{{ route('generate-pdf', ['sponsorId' => $sponsor->id]) }}" class="admin-link me-1"><i class="bi bi-file-earmark-arrow-down"></i>PDF</a>
                        <a href="{{ route('admin.sponsors.edit', ['id' => $sponsor->id]) }}" class="admin-link"><i class="bi bi-pencil-square"></i>Edit</a>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
        </table>
    </div>
@stop