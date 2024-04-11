<div id="edit-race-details" class="row editRaceSection">
    <div class="col-md-8">
        <label for="raceName" class="form-label">Name</label>
        <input type="text" name="raceName" class="form-control" id="raceName" value="{{$race->name}}">
    </div>
    <div class="col-md-4">
        <label for="raceDate" class="form-label">Date</label>
        <input type="datetime-local" name="raceDate" class="form-control" id="raceDate" value="{{$race->date}}">
    </div>
    <div class="col-7">
        {{-- <input type="range" name="raceMaxParticipants" class="form-range" id="raceMaxParticipants" min="8" max="32"> --}}
        
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-8 -col-sm-10 col-12">
                <div class="range-item">
                    <label for="raceMaxParticipants" class="form-label col-12">Max. Participants</label>
                    
                    <div class="range-input d-flex position-relative">
                        <input type="range" min="8" max="32" class="form-range" name="raceMaxParticipants" value="{{$race->maxParticipants}}" />
                        <div class="range-line">
                            <span class="active-line"></span>
                        </div>
                        <div class="dot-line">
                            <span class="active-dot"></span>
                            <span class="value-indicator"></span>
                        </div>
                    </div>
                    <ul class="list-inline list-unstyled">
                        <li class="list-inline-item">
                            <span>8</span>
                        </li>
                        <li class="list-inline-item">
                            <span>16</span>
                        </li>
                        <li class="list-inline-item">
                            <span>24</span>
                        </li>
                        <li class="list-inline-item">
                            <span>32</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div> 
    </div>
    <div class="col-2 d-flex align-items-center">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="racePro" name="racePro" value="{{$race->pro}}">
            <label class="form-check-label" for="racePro">
                Professional
            </label>
        </div>
    </div>
    <div class="col-3 d-flex align-items-center">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="raceActive" name="raceActive" value="{{$race->active}}" checked>
            <label class="form-check-label" for="raceActive">
                Visible
            </label>
        
        </div>
    </div>
    <div class="col-md-5">
        <label for="raceCoords" class="form-label">Coords</label>
        <input type="text" name="raceCoords" class="form-control" id="raceCoords" value="{{$race->startingPlace}}">
    </div>
    <div class="col-md-5">
        <label for="raceMap" class="form-label">Map</label>
        <input type="file" name="raceMap" class="form-control" id="raceMap" value="{{$race->map}}">
    </div>
    <div class="col-md-2">
        <label for="raceLength" class="form-label">Length</label>
        <input type="number" name="raceLength" class="form-control" id="raceLength" value="{{$race->length}}">
    </div>
    <div class="col-md-6">
        <label for="raceSponsorCost" class="form-label">Sponsor Cost</label>
        <input type="number" name="raceSponsorCost" class="form-control" id="raceSponsorCost" value="{{$race->sponsorCost}}">
    </div>
    <div class="col-md-6">
        <label for="raceRegistrationPrice" class="form-label">Registration Price</label>
        <input type="number" name="raceRegistrationPrice" class="form-control" id="raceRegistrationPrice" value="{{$race->registrationPrice}}">
    </div>
    <div class="col-md-4 col-lg-6">
        <label for="raceBanner" class="form-label">Banner</label>
        <input type="file" name="raceBanner" class="form-control" id="raceBanner" value="{{$race->banner}}">
    </div>
    <div class="col-md-12">
        <label for="raceDescription" class="form-label">Description</label>
        <textarea name="raceDescription" class="form-control" id="raceDescription" value="{{$race->description}}" placeholder="Type Something...">{{$race->description}}</textarea>
    </div>
    
</div>