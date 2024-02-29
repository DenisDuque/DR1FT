@extends('administrator.layouts.master')

@section('content')
    <section class="my-5 d-flex align-items-center justify-content-between">
        <h1 class="admin-form-title text-white">All Sponsors</h1>
        <a class="btn btn-primary" href="/admin/sponsors/new" role="button"><i class="bi bi-plus-lg"></i> Add Sponsor</a>
    </section>

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
                <td>Name 
                    @if ($sponsor->active == 0)
                        <span class="badge rounded-pill bg-badge-disabled">Disabled</span>
                    @endif
                </td>
                <td>{{$sponsor->cif}}</td>
                <td>{{$sponsor->address}}</td>
                <td>Edit | Delete</td>
            </tr>
        @endforeach
        
    </tbody>
    </table>
@stop