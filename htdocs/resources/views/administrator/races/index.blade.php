@extends('administrator.layouts.master')

@section('content')
    <section class="my-5 d-flex align-items-center justify-content-between">
        <h1 class="admin-form-title text-white">All Races</h1>
        <a class="btn btn-primary" href="/admin/races/new" role="button"><i class="bi bi-plus-lg"></i> Add Race</a>
    </section>

    <table class="table table-dark table-hover table-border">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Date</th>
            <th scope="col">Place</th>
            <th scope="col" class="text-center">Max. Drivers</th>
            <th scope="col" class="text-center">Length</th>
            <th scope="col" class="text-center">Sponsor Cost</th>
            <th  class="text-center">Registration Price</th>
            <th scope="col" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($races as $race)
                <tr>
                    <td class="py-3">{{$race->id}}</td>
                    <td>{{$race->name}}
                        @if ($race->pro == 1)
                            <span class="badge rounded-pill bg-warning text-dark">PRO</span>
                        @endif
                        @if ($race->active == 0)
                            <span class="badge rounded-pill bg-badge-disabled">Disabled</span>
                        @endif
                    </td>
                    <td><i class="bi bi-calendar-event"></i>{{$race->date}}</td>
                    <td>{{$race->startingPlace}}</td>
                    <td class="text-center">{{$race->maxParticipants}}</td>
                    <td class="text-center">{{$race->length}}</td>
                    <td class="text-center w-10"><span class="badge rounded-pill bg-badge-purple">{{$race->sponsorCost}}$</span></td>
                    <td class="text-center w-10"><span class="badge rounded-pill bg-badge-purple">{{$race->registrationPrice}}$</span></td>
                    <td>
                        <a href="http://">Datails</a>
                        <a href="{{ route('admin.races.edit', ['id' => $race->id]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop