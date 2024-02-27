@extends('administrator.layouts.master')

@section('content')
    <h1>Create a new Race</h1>
    <form action="{{route('/admin/races/new')}}" method="POST">
        @csrf
        <label for="raceName">Name:</label>
        <input type="text" name="raceName"/>
        <label for="raceDescription">Description:</label>
        <input type="text" name="raceDescription"/>
        <label for="raceMap">Map:</label>
        <input type="file" name="raceMap"/>
        <label for="raceMaxParticipants">Max Participants:</label>
        <input type="range" name="raceMaxParticipants"/>
        <label for="raceLength">Length (km):</label>
        <input type="number" name="raceLength"/>
        <label for="raceBanner">Banner:</label>
        <input type="file" name="raceBanner"/>
        <label for="raceDate">Date:</label>
        <input type="date" name="raceDate"/>
        <label for="raceCoords">Place (coords):</label>
        <input type="text" name="raceCoords"/>
        <label for="raceRegistrationPrice">Registration Price:</label>
        <input type="number" name="raceRegistrationPrice"/>
        <label for="raceActive">Visible:</label>
        <input type="radio" name="raceActive" value="1"/>
        <label for="raceActive">No Visible:</label>
        <input type="radio" name="raceActive" value="1"/>
        <button type="submit">Create Race</button>
    </form>
@stop