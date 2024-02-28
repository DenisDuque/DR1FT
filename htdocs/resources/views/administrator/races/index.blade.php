@extends('administrator.layouts.master')

@section('content')
    <section class="my-5 d-flex align-items-center justify-content-between">
        <h1 class="admin-form-title text-white">All Races</h1>
        <a class="btn btn-primary" href="/admin/races/new" role="button">Add Race</a>
    </section>

    <table class="table table-dark table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Map</th>
            <th scope="col">Max. Drivers</th>
            <th scope="col">Length</th>
            <th scope="col">Banner</th>
            <th scope="col">Date</th>
            <th scope="col">Place</th>
            <th scope="col">Sponsor Cost</th>
            <th scope="col">Registration Price</th>
            <th scope="col">Active</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($races as $race)
                <tr>
                    <td>{{$race->id}}</td>
                    <td>{{$race->name}}
                        @if ($race->pro == 1)
                            <span class="badge rounded-pill bg-warning text-dark">PRO</span>
                        @endif
                    </td>
                    <td>{{$race->description}}</td>
                    <td>{{$race->map}}</td>
                    <td>{{$race->maxParticipants}}</td>
                    <td>{{$race->length}}</td>
                    <td>{{$race->banner}}</td>
                    <td>{{$race->date}}</td>
                    <td>{{$race->startingPlace}}</td>
                    <td>{{$race->sponsorCost}}</td>
                    <td>{{$race->registrationPrice}}</td>
                    <td>{{$race->active}}</td>
                    <td><a href="{{ route('admin.races.edit', ['id' => $race->id]) }}">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop