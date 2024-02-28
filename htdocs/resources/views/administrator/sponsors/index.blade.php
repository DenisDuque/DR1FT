@extends('administrator.layouts.master')

@section('content')
    <h1>All Sponsors</h1>
    <a class="btn btn-primary" href="/admin/sponsors/new" role="button">Add Sponsor</a>

    <table class="table table-dark table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Logo</th>
        <th scope="col">CIF</th>
        <th scope="col">Address</th>
        <th scope="col">Active</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sponsors as $sponsor)
            <tr>
                <td>{{$sponsor->id}}</td>
                <td>{{$sponsor->logo}}</td>
                <td>{{$sponsor->cif}}</td>
                <td>{{$sponsor->address}}</td>
                <td>{{$sponsor->active}}</td>
                <td>Edit | Delete</td>
            </tr>
        @endforeach
        
    </tbody>
    </table>
@stop