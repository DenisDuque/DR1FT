@extends('administrator.layouts.master')

@section('content')
    <h1>Create a new Race</h1>
    <form action="{{route('/admin/races/new')}}" method="POST">
        @csrf
        <label for="raceName">Name:</label>
        <input type="text" name="raceName"/><br>
        <label for="raceDescription">Description:</label>
        <input type="text" name="raceDescription"/><br>
        <label for="raceMap">Map:</label>
        <input type="file" name="raceMap"/><br>
        <label for="raceMaxParticipants">Max Participants:</label>
        <input type="range" name="raceMaxParticipants"/><br>
        <label for="raceLength">Length (km):</label>
        <input type="number" name="raceLength"/><br>
        <label for="raceBanner">Banner:</label>
        <input type="file" name="raceBanner"/><br>
        <label for="raceDate">Date:</label>
        <input type="date" name="raceDate"/><br>
        <label for="raceCoords">Place (coords):</label>
        <input type="text" name="raceCoords"/><br>
        <label for="raceRegistrationPrice">Registration Price:</label>
        <input type="number" name="raceRegistrationPrice"/><br>
        <label for="raceActive">Visible:</label>
        <input type="radio" name="raceActive" value="1" checked/>
        <label for="raceActive">No Visible:</label>
        <input type="radio" name="raceActive" value="1"/><br>
        <button type="submit">Create Race</button>
    </form>
@stop