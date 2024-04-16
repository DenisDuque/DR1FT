/*
INDEX: For each type of search bar

Races: Races_Search
Drivers: Drivers_Search
Sponsors: Sponsors_Search
Insurances: Insurances_Search

Ensure your table tbody ID is {typeofsearch}-table-body
And the search input is {typeofsearch}-search

Example: races-table-body, races-search
*/

class Admin_Races_Search {
    constructor() {
        document.addEventListener('DOMContentLoaded', () => {
            this.table = document.getElementById('races-table-body');
            this.searchInput = document.getElementById('races-search');
            this.searchTerm = "";

            // Adding Event Listeners to searchbar
            if (this.searchInput) {
                this.searchInput.addEventListener('change', (event) => {
                    this.searchTerm = event.target.value;
                    this.updateTable();
                });
                
                this.searchInput.addEventListener('keyup', (event) => {
                    this.searchTerm = event.target.value;
                    this.updateTable();
                });
            }
        });
    }

    async updateTable() {
        this.table.innerHTML = await this.fetchRaces();
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
                            place: race.startingPlace,
                            maxDrivers: race.maxParticipants,
                            raceLength: race.length,
                            pro: race.pro,
                            active: race.active,
                            sponsorCost: race.sponsorCost,
                            registrationPrice: race.registrationPrice
                        };
                    });
                    const tableContent = racesJSON.map(race => this.generateRaceTable(race)).join('');
                    resolve(tableContent);
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

    generateRaceTable(race) {
        const racePro = race.pro == 1 ? '<span class="badge rounded-pill bg-warning text-dark">PRO</span>' : '';
        const raceActive = race.active == 1 ? '' : '<span class="badge rounded-pill bg-badge-disabled">Disabled</span>';

        return `
        <tr>
            <td class="py-3 align-middle">${race.id}</td>
            <td class="py-3 align-middle">${race.name}${racePro}${raceActive}</td>
            <td class="py-3 align-middle"><i class="me-2 bi bi-calendar-event"></i>${race.date}</td>
            <td class="py-3 align-middle">${race.place}</td>
            <td class="py-3 text-center align-middle">${race.maxDrivers}</td>
            <td class="py-3 text-center align-middle">${race.raceLength}</td>
            <td class=" align-middle text-center w-10"><span class="badge rounded-pill bg-badge-purple">${race.sponsorCost}$</span></td>
            <td class="align-middle text-center w-10"><span class="badge rounded-pill bg-badge-purple">${race.registrationPrice}$</span></td>
            <td class="py-3 text-center align-middle">
                <a href="{{ route('generate.race.pdf', ['raceId' => ${race.id}]) }}" class="admin-link me-1"><i class="bi bi-file-earmark-arrow-down"></i>PDF</a>
                <a class="admin-link" href="{{ route('admin.races.edit', ['id' => ${race.id}]) }}"><i class="bi bi-pencil-square"></i>Edit</a>
            </td>
        </tr>`;
      }
}

const racesSearch = new Admin_Races_Search();