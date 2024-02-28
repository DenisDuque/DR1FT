@extends('administrator.layouts.master')

@section('content')
    <h1>All Insurances</h1>
    <a class="btn btn-primary" href="/admin/insurances/new" role="button">Add Insurance</a>

    <table class="table table-dark table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Logo</th>
        <th scope="col">Name</th>
        <th scope="col">CIF</th>
        <th scope="col">Address</th>
        <th scope="col">Price per Race</th>
        <th scope="col">Active</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($insurances as $insurance)
            <tr>
                <td>{{$insurance->id}}</td>
                <td>{{$insurance->logo}}</td>
                <td>{{$insurance->name}}</td>
                <td>{{$insurance->cif}}</td>
                <td>{{$insurance->address}}</td>
                <td>{{$insurance->pricePerRace}}</td>
                <td>{{$insurance->active}}</td>
                <td><a href="{{ route('admin.insurances.edit', ['id' => $insurance->id]) }}">Edit</a></td>
            </tr>
        @endforeach
        
    </tbody>
    </table>
@stop