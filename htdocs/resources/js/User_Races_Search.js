class User_Races_Search {
    constructor() {
        document.addEventListener('DOMContentLoaded', () => {
            this.content = document.getElementById('races-content-body');
            this.searchInput = document.getElementById('races-user-search');
            this.searchFilter = document.getElementById('races-user-filter');
            this.sort = 0;
            this.sortTerms = {
                0 : none,
                1 : isPro()(),
                2 : isntPro(),
                3 : higherPrice(),
                4 : lowerPrice()
            }
            this.searchTerm = "";

            // Adding Event Listeners to searchbar
            if (this.searchInput) {
                this.searchInput.addEventListener('change', (event) => {
                    this.searchTerm = event.target.value;
                    this.updateContent();
                });
                
                this.searchInput.addEventListener('keyup', (event) => {
                    this.searchTerm = event.target.value;
                    this.updateContent();
                });

                if (this.searchFilter) {
                    this.searchFilter.addEventListener('change', (event) => {
                        this.sort = event.target.value;
                        this.updateContent();
                    });
                }

            }
        });
    }

    async updateContent() {
        this.content.innerHTML = await this.fetchRaces();
    }

    async fetchRaces() {
        return new Promise(async (resolve, reject) => {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/races/search', {
                method: 'POST',
                body: JSON.stringify({ searchTerm: this.searchTerm }),
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
                            banner: race.banner,
                            place: race.startingPlace,
                            maxDrivers: race.maxParticipants,
                            raceLength: race.length,
                            pro: race.pro,
                            active: race.active,
                            sponsorCost: race.sponsorCost,
                            registrationPrice: race.registrationPrice
                        };
                    });
                    const contentRaces = racesJSON.map(race => this.generateRaceCard(race)).join('');
                    resolve(contentRaces);
                } else {
                    resolve("<p>No results match your search.</p>");
                }
                
            })
            .catch(error => {
                console.error('Error:', error);
                reject(error.message);
            });
        });
    }

    generateRaceCard(race) {
        const racePro = race.pro == 1 ? '<span class="badge rounded-pill bg-warning text-dark">PRO</span>' : '';
        if (race.active == 1) {
            return `
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-3" style="max-width: 30rem;">
                        <div class="row g-0">
                          <div class="col-md-3 h-100" style="height: 15rem;">
                            <img src="{{asset('storage/race_banners/'.${race.banner})}}" class="img-fluid rounded-start" alt="${race.name}">
                          </div>
                          <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title">${race.name}
                                    ${racePro}
                                    <span class="badge rounded-pill text-bg-light"><i class="me-1 bi bi-calendar2-week-fill"></i>${race.date}</span>
                                    <span class=" badge rounded-pill bg-info text-dark"><i class="bi bi-people-fill"></i>Max. ${race.maxDrivers}</span>
                                    <span class=" badge rounded-pill bg-badge-purple">${race.raceLength} Km</span>
                                </h5>
                                <p class="card-text"><i class="bi bi-geo-alt-fill"></i>${race.place}</p>
                                <a href="{{ route('race.detail', ${race.id}) }}" class="btn btn-primary fs-6 text-white" role="button">Participate (${race.registrationPrice}$)</a>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>`;
        }
    }
}

const racesUserSearch = new User_Races_Search();