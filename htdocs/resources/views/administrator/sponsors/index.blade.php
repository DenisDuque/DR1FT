@extends('administrator.layouts.master')

@section('content')
    <section class="mt-5 mb-3 d-flex align-items-center justify-content-between">
        <h1 class="admin-form-title text-white">All Sponsors</h1>
        <a class="btn btn-primary" href="/admin/sponsors/new" role="button"><i class="bi bi-plus-lg"></i> Add Sponsor</a>
    </section>

    @include('administrator.layouts.notice')

    <table class="table table-dark table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Logo</th>
        <th scope="col">Name</th>
        <th scope="col">CIF</th>
        <th scope="col">Address</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sponsors as $sponsor)
            <tr>
                <td>{{$sponsor->id}}</td>
                <!-- <td>{{$sponsor->logo}}</td> -->
                <td><i class="bi bi-image"></i></td>
                <td>{{$sponsor->name}}
                    @if ($sponsor->active == 0)
                        <span class="badge rounded-pill bg-badge-disabled">Disabled</span>
                    @endif
                </td>
                <td>{{$sponsor->cif}}</td>
                <td>{{$sponsor->address}}</td>
                <td>
                    <a href="#">Details</a>
                    <a href="{{ route('admin.sponsors.edit', ['id' => $sponsor->id]) }}">Edit</a>
                </td>
            </tr>
        @endforeach
        
    </tbody>
    </table>
@stop