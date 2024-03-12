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

class Admin_Sponsors_Races_Search {
    constructor() {
        document.addEventListener('DOMContentLoaded', () => {
            this.table = document.getElementById('sponsors-races-table-body');
            this.searchInput = document.getElementById('sponsors-races-search');
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
        this.table.innerHTML = await this.fetchSponsors();
    }

    async fetchSponsors() {
        return new Promise(async (resolve, reject) => {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/sponsors/search', {
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
                    const sponsorsJSON = data.map(sponsor => {
                        return {
                            id: sponsor.id,
                            logo: sponsor.logo,
                            name: sponsor.name,
                            cif: sponsor.cif,
                            address: sponsor.address,
                            active: sponsor.active
                        };
                    });
                    const tableContent = sponsorsJSON.map(sponsor => this.generateSponsorTable(sponsor)).join('');
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

    generateSponsorTable(sponsor) {
        if (sponsor.active) {
            return `
            <tr>
                <td class="py-3 text-center align-middle fw-bold"><input class="form-check-input" type="checkbox" role="switch" name="raceSponsors[]" value="${sponsor.id}"></td>
                <!-- <td>${sponsor.logo}</td> -->
                <td class="py-3 align-middle"><i class="bi bi-image"></i></td>
                <td class="py-3 align-middle">${sponsor.name}</td>
                <td class="py-3 align-middle">${sponsor.cif}</td>
                <td class="py-3 text-center align-middle fw-bold"><input class="form-check-input" type="checkbox" role="switch" name="mainSponsors[]" value="${sponsor.id}"></td>
            </tr>`;
        } else {
            return '';
        }
    }
}

const sponsorsRacesSearch = new Admin_Sponsors_Races_Search();