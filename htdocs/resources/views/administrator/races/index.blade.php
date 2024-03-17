@extends('administrator.layouts.master')

@section('content')
    <section class="row mt-5 mb-3 d-flex align-items-center justify-content-between">
        <div class="col-4">
            <h1 class="admin-form-title text-white">All Races</h1>
        </div>
        <div class="col-4">
            <input id="races-search" class="col-12 form-control" type="text" placeholder="Search">
        </div>
        <div class="col-4 text-end">
            <a class="btn btn-primary text-white" href="/admin/races/new" role="button"><i class="bi bi-plus-lg"></i> Add Race</a>
        </div>
    </section>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('administrator.layouts.notice')

    <div class="table-responsive table-border" style="max-height: 75vh;">
        <table class="table table-dark table-hover overflow-hidden">
            <thead class="position-relative">
                <tr>
                <th scope="col" class="sticky-top fixed-cel">#</th>
                <th scope="col" class="sticky-top fixed-cel">Name</th>
                <th scope="col" class="sticky-top fixed-cel">Date</th>
                <th scope="col" class="w-300px sticky-top fixed-cel">Place</th>
                <th scope="col" class="text-center sticky-top fixed-cel">Max. Drivers</th>
                <th scope="col" class="text-center sticky-top fixed-cel">Length</th>
                <th scope="col" class="text-center sticky-top fixed-cel">Sponsor Cost</th>
                <th  class="text-center sticky-top fixed-cel">Registration Price</th>
                <th scope="col" class="text-center sticky-top fixed-cel">Actions</th>
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
                        <td class="py-3 align-middle"><span class="badge rounded-pill text-bg-light"><i class="me-1 bi bi-calendar2-week-fill"></i>{{$race->date}}</span></td>
                        <td class="py-3 align-middle">{{$race->startingPlace}}</td>
                        <td class="py-3 text-center align-middle">{{$race->maxParticipants}}</td>
                        <td class="py-3 text-center align-middle">{{$race->length}} Km</td>
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
    </div>
@stop