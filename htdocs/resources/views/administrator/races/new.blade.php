@extends('administrator.layouts.master')

@section('content')
    <h1>Create a new Race</h1>
    <form action="{{route('/admin/races/new')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="raceName">Name:</label>
        <input type="text" name="raceName" value="{{old('raceName')}}" required/><br>
        <label for="raceDescription">Description:</label>
        <input type="text" name="raceDescription" value="{{old('raceDescription')}}" required/><br>
        <label for="raceMap">Map:</label>
        <input type="file" name="raceMap" value="{{old('raceMap')}}" required/><br>
        <label for="raceMaxParticipants">Max Participants:</label>
        <input type="range" name="raceMaxParticipants" value="{{old('raceMaxParticipants')}}" required/><br>
        <label for="raceLength">Length (km):</label>
        <input type="number" name="raceLength" value="{{old('raceLength')}}" required/><br>
        <label for="raceBanner">Banner:</label>
        <input type="file" name="raceBanner" value="{{old('raceBanner')}}" required/><br>
        <label for="raceDate">Date:</label>
        <input type="date" name="raceDate" value="{{old('raceDate')}}" required/><br>
        <label for="raceCoords">Place (coords):</label>
        <input type="text" name="raceCoords" value="{{old('raceCoords')}}" required/><br>
        <label for="raceSponsorCost">Sponsor Cost:</label>
        <input type="number" name="raceSponsorCost" value="{{old('raceSponsorCost')}}" required/><br>
        <label for="raceRegistrationPrice">Registration Price:</label>
        <input type="number" name="raceRegistrationPrice" value="{{old('raceRegistrationPrice')}}" required/><br>
        <label for="raceActive">Visible:</label>
        <input type="checkbox" name="raceActive" value="1" value="{{old('raceActive')}}" required/><br>
        <button type="submit">Create Race</button>
    </form>
@stop