class Admin_Edit_Races {
    constructor() {
        document.addEventListener('DOMContentLoaded', () => {
            this.container = document.getElementById('edit-races-container');
            this.editRacesNav = document.getElementById('edit-races-nav');
            this.raceId = document.getElementById('edit-races-race-id');
            if (this.raceId) {
                // Adding Event Listeners to elements
                if (this.editRacesNav) {
                    this.navList = this.editRacesNav.getElementsByTagName("li");
                    
                    if (this.navList && this.navList.length > 0) {
                        const self = this;
                        Array.from(this.navList).forEach(navElement => {
                            navElement.addEventListener('click', function(event) {
                                const selectedElement = event.target;
                                console.log("TEST");
                                if (!selectedElement.classList.contains('active')) {
                                    console.log('El elemento no tiene la clase active');
                                    Array.from(self.navList).forEach(li => {
                                        li.classList.remove('active');
                                    });
    
                                    selectedElement.classList.add('active');
                                    console.log('Se añadió la clase active al elemento');
                                    console.log("El texto dentro del elemento li es: ", selectedElement.textContent);
    
                                    self.showForm(selectedElement.textContent);
                                    
                                }
                            });
                        });
                    }
                }
            }
        });
    }

    async showForm(formType) {
        switch (formType) {
            case 'DETAILS':
                this.container.innerHTML = await this.fetchRaceDetails();
                break;

            case 'INSURANCES':
                this.container.innerHTML = await this.fetchRaceInsurances();
                break;

            case 'SPONSORS':
                this.container.innerHTML = await this.fetchRaceSponsors();
                break;

            case 'DRIVERS':
                this.container.innerHTML = await this.fetchRaceDrivers();
                break;

            case 'PHOTOS':
                this.container.innerHTML = await this.fetchRacePhotos();
                break;
        
            default:
                break;
        }
    }

    async fetchRaceDetails() {
        return new Promise(async (resolve, reject) => {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/races/find', {
                method: 'POST',
                body: JSON.stringify({ id: this.raceId }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': token,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al realizar la solicitud');
                }
                return response.json();
            })
            .then(data => {
                if (data.length > 0) {
                    const racesJSON = data.map(race => {
                        return {
                            id: race.id,
                            name: race.name,
                            date: race.date,
                            place: race.startingPlace,
                            maxDrivers: race.maxParticipants,
                            raceLength: race.length,
                            pro: race.pro,
                            active: race.active,
                            sponsorCost: race.sponsorCost,
                            registrationPrice: race.registrationPrice
                        };
                    });
                    console.log(racesJSON);
                    const tableContent = racesJSON.map(race => this.generateDetailsTable(race)).join('');
                    resolve(tableContent);
                } else {
                    throw new Error('Error al realizar la solicitud');
                }
                
            })
            .catch(error => {
                console.error('Error:', error);
                reject(error.message);
            });
        });
    }

    generateDetailsTable(race) {
        return ` 
            <form class="row g-2" action="{{ route('admin.races.edit', ['id' => ${race.id} }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-8">
                    <label for="raceName" class="form-label">Name</label>
                    <input type="text" name="raceName" class="form-control" id="raceName" value="${race.name}">
                </div>
                <div class="col-md-4">
                    <label for="raceDate" class="form-label">Date</label>
                    <input type="date" name="raceDate" class="form-control" id="raceDate" value="${race.date}">
                </div>
                <div class="col-7">
                    {{-- <input type="range" name="raceMaxParticipants" class="form-range" id="raceMaxParticipants" min="8" max="32"> --}}
                    
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-8 -col-sm-10 col-12">
                                <div class="range-item">
                                <label for="raceMaxParticipants" class="form-label col-12">Max. Participants</label>
                                
                                <div class="range-input d-flex position-relative">
                                <input type="range" min="8" max="32" class="form-range" name="raceMaxParticipants" value="${race.maxParticipants}" />
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
                        <input class="form-check-input" type="checkbox" role="switch" id="racePro" name="racePro" value="${race.pro}">
                        <label class="form-check-label" for="racePro">
                            Professional
                        </label>
                    </div>
                </div>
                <div class="col-3 d-flex align-items-center">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="raceActive" name="raceActive" value="${race.active}" checked>
                        <label class="form-check-label" for="raceActive">
                            Visible
                        </label>
                    
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="raceCoords" class="form-label">Coords</label>
                    <input type="text" name="raceCoords" class="form-control" id="raceCoords" value="${race.startingPlace}">
                </div>
                <div class="col-md-5">
                    <label for="raceMap" class="form-label">Map</label>
                    <input type="file" name="raceMap" class="form-control" id="raceMap" value="${race.map}">
                </div>
                <div class="col-md-2">
                    <label for="raceLength" class="form-label">Length</label>
                    <input type="number" name="raceLength" class="form-control" id="raceLength" value="${race.raceLength}">
                </div>
                <div class="col-md-6">
                    <label for="raceSponsorCost" class="form-label">Sponsor Cost</label>
                    <input type="number" name="raceSponsorCost" class="form-control" id="raceSponsorCost" value="${race.sponsorCost}">
                </div>
                <div class="col-md-6">
                    <label for="raceRegistrationPrice" class="form-label">Registration Price</label>
                    <input type="number" name="raceRegistrationPrice" class="form-control" id="raceRegistrationPrice" value="${race.registrationPrice}">
                </div>
                <div class="col-md-4 col-lg-6">
                    <label for="raceBanner" class="form-label">Banner</label>
                    <input type="file" name="raceBanner" class="form-control" id="raceBanner" value="${race.banner}">
                </div>
                <div class="col-md-12">
                    <label for="raceDescription" class="form-label">Description</label>
                    <textarea name="raceDescription" class="form-control" id="raceDescription" value="${race.description}" placeholder="Type Something..."></textarea>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-success text-white">Next<i class="bi bi-chevron-double-right"></i></button>
                </div>
            </form>
        `
    }

}

const adminEditRaces = new Admin_Edit_Races();
