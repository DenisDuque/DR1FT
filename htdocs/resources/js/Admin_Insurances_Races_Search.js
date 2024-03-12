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

class Admin_Insurances_Races_Search {
    constructor() {
        document.addEventListener('DOMContentLoaded', () => {
            this.table = document.getElementById('insurances-races-table-body');
            this.searchInput = document.getElementById('insurances-races-search');
            this.searchTerm = "";

            this.sortTypes = ['none', 'low-high', 'high-low']
            this.sort = 0;
            
            this.sortInput = document.getElementById('sortInsurances');

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

                if (this.sortInput) {
                    this.sortInput.addEventListener('click', () => {
                        this.sort++;

                        if (this.sort > 2) {
                            this.sort = 0;
                        }

                        switch (this.sortTypes[this.sort]) {
                            case "low-high":
                                this.sortInput.innerHTML = '<i class="bi bi-arrow-down"></i>'
                                break;
    
                            case "high-low":
                                this.sortInput.innerHTML = '<i class="bi bi-arrow-up"></i>'
                                break;
        
                            default:
                                this.sortInput.innerHTML = '<i class="bi bi-arrow-down-up"></i>'
                                break;
                        }
                        this.updateTable();
                    });
                }
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
                            pricePerRace: insurance.pricePerRace,
                            active: insurance.active
                        };
                    });

                    switch (this.sortTypes[this.sort]) {
                        case "low-high":
                            insurancesJSON.sort((a, b) => a.pricePerRace - b.pricePerRace);
                            break;

                        case "high-low":
                            insurancesJSON.sort((a, b) => b.pricePerRace - a.pricePerRace);
                            break;
    
                        default:
                            break;
                    }

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
        if (insurance.active) {
            return `
            <tr>
                <td class="align-middle fw-bold"><input class="form-check-input" type="checkbox" name="raceInsurances[]" value="${insurance.id}"></td>
                <td class="align-middle">
                    <img class="img-thumbnail" src="{{ asset('storage/insurance_logos/' . ${insurance.logo}) }}" alt="${insurance.name}">
                </td>
                <td class="align-middle">${insurance.name}</td>
                <td class="align-middle">${insurance.cif}</td>
                <td class="text-center align-middle"><span class="badge rounded-pill bg-badge-purple">${insurance.pricePerRace}$</span></td>
            </tr>`;
        } else {
            return '';
        }
      }
}

const insurancesRacesSearch = new Admin_Insurances_Races_Search();