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

class Admin_Sponsors_Search {
    constructor() {
        document.addEventListener('DOMContentLoaded', () => {
            this.table = document.getElementById('sponsors-table-body');
            this.searchInput = document.getElementById('sponsors-search');
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
        const sponsorActive = sponsor.active == 1 ? '' : '<span class="badge rounded-pill bg-badge-disabled">Disabled</span>';

        return `
        <tr>
            <td class="py-3 text-center align-middle fw-bold">${sponsor.id}</td>
            <!-- <td>${sponsor.logo}</td> -->
            <td class="py-3 align-middle"><i class="bi bi-image"></i></td>
            <td class="py-3 align-middle">${sponsor.name}${sponsorActive}</td>
            <td class="py-3 align-middle">${sponsor.cif}</td>
            <td class="py-3 align-middle">${sponsor.address}</td>
            <td class="py-3 align-middle text-center">
                <a href="#" class="admin-link me-3"><i class="bi bi-info-circle"></i>Details</a>
                <a href="{{ route('admin.sponsors.edit', ['id' => ${sponsor.id}]) }}" class="admin-link"><i class="bi bi-pencil-square"></i>Edit</a>
            </td>
        </tr>`;
      }
}

const sponsorsSearch = new Admin_Sponsors_Search();