@extends('page.layouts.master')

@section('title', 'Profile')

@section('content')
    <h1 class="index-page-headers my-5">PROFILE</h1>

    @foreach ($races as $race)
        <p class="text-white">{{$race->name}}</p>
    @endforeach
@endsection