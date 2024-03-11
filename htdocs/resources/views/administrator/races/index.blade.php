@extends('administrator.layouts.master')

@section('content')
    <section class="mt-5 mb-3 d-flex align-items-center justify-content-between">
        <h1 class="admin-form-title text-white">All Races</h1>
        <input id="races-search" type="text" placeholder="Search">
        <a class="btn btn-primary" href="/admin/races/new" role="button"><i class="bi bi-plus-lg"></i> Add Race</a>
    </section>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <table class="table table-dark table-hover table-border">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Date</th>
            <th scope="col" class="w-300px">Place</th>
            <th scope="col" class="text-center">Max. Drivers</th>
            <th scope="col" class="text-center">Length</th>
            <th scope="col" class="text-center">Sponsor Cost</th>
            <th  class="text-center">Registration Price</th>
            <th scope="col" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody id="races-table-body">
            @foreach($races as $race)
                <tr>
                    <td class="py-3 align-middle">{{$race->id}}</td>
                    <td class="py-3 align-middle">{{$race->name}}
                        @if ($race->pro == 1)
                            <span class="badge rounded-pill bg-warning text-dark">PRO</span>
                        @endif
                        @if ($race->active == 0)
                            <span class="badge rounded-pill bg-badge-disabled">Disabled</span>
                        @endif
                    </td>
                    <td class="py-3 align-middle"><i class="me-2 bi bi-calendar-event"></i>{{$race->date}}</td>
                    <td class="py-3 align-middle">{{$race->startingPlace}}</td>
                    <td class="py-3 text-center align-middle">{{$race->maxParticipants}}</td>
                    <td class="py-3 text-center align-middle">{{$race->length}}</td>
                    <td class=" align-middle text-center w-10"><span class="badge rounded-pill bg-badge-purple">{{$race->sponsorCost}}$</span></td>
                    <td class="align-middle text-center w-10"><span class="badge rounded-pill bg-badge-purple">{{$race->registrationPrice}}$</span></td>
                    <td class="py-3 text-center align-middle">
                        <a class="admin-link me-3" href="{{ route('admin.races.show', ['id' => $race->id]) }}"><i class="bi bi-info-circle"></i>Details</a>
                        <a class="admin-link" href="{{ route('admin.races.edit', ['id' => $race->id]) }}"><i class="bi bi-pencil-square"></i>Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop