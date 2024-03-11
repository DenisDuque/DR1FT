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

class Admin_Drivers_Search {
    constructor() {
        document.addEventListener('DOMContentLoaded', () => {
            this.table = document.getElementById('drivers-table-body');
            this.searchInput = document.getElementById('drivers-search');
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
        this.table.innerHTML = await this.fetchDrivers();
    }

    async fetchDrivers() {
        return new Promise(async (resolve, reject) => {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/drivers/search', {
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
                    const driversJSON = data.map(driver => {
                        return {
                            id: driver.id,
                            name: driver.name,
                            birthDate: driver.birthDate,
                            federationNumber: driver.federationNumber,
                            points: driver.points,
                            gender: driver.gender,
                            pro: driver.pro,
                            member: driver.member,
                            email: driver.email,
                            address: driver.address
                        };
                    });
                    const tableContent = driversJSON.map(driver => this.generateDriverTable(driver)).join('');
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

    generateDriverTable(driver) {
        const driverPro = driver.pro == 1 ? '<span class="badge rounded-pill bg-warning text-dark">PRO</span>' : '';

        return `
        <tr>
            <td class="py-3 text-center align-middle fw-bold">${driver.id}</td>
            <td>${driver.name}${driverPro}</td>
            <td>${driver.birthDate}</td>
            <td>${driver.federationNumber}</td>
            <td>${driver.points}</td>
            <td>${driver.gender}</td>
            <td>${driver.member}</td>
            <td>${driver.email}</td>
            <td>${driver.address}</td>
            <td><a class="admin-link" href="{{ route('admin.drivers.edit', ['id' => ${driver.id}]) }}"><i class="bi bi-pencil-square"></i>Edit</a></td>
        </tr>`;
      }
}

const driversSearch = new Admin_Drivers_Search();