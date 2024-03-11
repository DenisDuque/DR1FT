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

class Admin_Insurances_Search {
    constructor() {
        document.addEventListener('DOMContentLoaded', () => {
            this.table = document.getElementById('insurances-table-body');
            this.searchInput = document.getElementById('insurances-search');
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
        this.table.innerHTML = await this.fetchInsurances();
    }

    async fetchInsurances() {
        return new Promise(async (resolve, reject) => {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/insurances/search', {
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
                    const insurancesJSON = data.map(insurance => {
                        return {
                            id: insurance.id,
                            logo: insurance.logo,
                            name: insurance.name,
                            cif: insurance.cif,
                            address: insurance.address,
                            pricePerRace: insurance.pricePerRace,
                            active: insurance.active
                        };
                    });
                    const tableContent = insurancesJSON.map(insurance => this.generateInsuranceTable(insurance)).join('');
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

    generateInsuranceTable(insurance) {
        const insuranceActive = insurance.active == 1 ? '' : '<span class="badge rounded-pill bg-badge-disabled">Disabled</span>';

        return `
        <tr>
            <td class="align-middle fw-bold">${insurance.id}</td>
            <td class="align-middle"><img class="img-thumbnail" src="{{ asset('storage/insurance_logos/' . ${insurance.logo}) }}" alt="{{$insurance->name}}"></td>
            <td class="align-middle">${insurance.name}${insuranceActive}</td>
            <td class="align-middle">${insurance.cif}</td>
            <td class="align-middle">${insurance.address}</td>
            <td class="text-center align-middle"><span class="badge rounded-pill bg-badge-purple">${insurance.pricePerRace}$</span></td>
            <td class="align-middle"><a class="admin-link" href="{{ route('admin.insurances.edit', ['id' => ${insurance.id}]) }}"><i class="bi bi-pencil-square"></i>Edit</a></td>
        </tr>`;
      }
}

const insurancesSearch = new Admin_Insurances_Search();