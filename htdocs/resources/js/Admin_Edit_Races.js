class Admin_Edit_Races {
    constructor() {
        document.addEventListener('DOMContentLoaded', () => {
            this.editRacesNav = document.getElementById('edit-races-nav');
            this.raceId = document.getElementById('edit-races-race-id');
            const self = this;
            if (this.raceId) {
                // Adding Event Listeners to elements
                if (this.editRacesNav) {
                    this.navList = this.editRacesNav.getElementsByTagName("li");
                    
                    if (this.navList && this.navList.length > 0) {
                        
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
    
                                    self.showForm(selectedElement);
                                }
                            });
                        });
                    }
                    this.loadDorsalsBtn = document.getElementById('load-dorsals');
                    if (this.loadDorsalsBtn) {
                        this.loadDorsalsBtn.addEventListener('click', function(event) {
                            event.preventDefault();
                            self.updateDrivers();
                        });
                    }
                    this.photosInput = document.getElementById('gropFile');
                    if (this.photosInput) {
                        this.photosInput.addEventListener('change', function(event) {
                            let files = event.target.files;
                            console.log(files);
                            let validMimeTypes = ['image/jpeg', 'image/png', 'image/gif']; // Tipos MIME válidos
                            let invalidFiles = [];
                    
                            // Validar los tipos MIME de los archivos
                            for (let i = 0; i < files.length; i++) {
                                let fileMimeType = files[i].type;
                                if (!validMimeTypes.includes(fileMimeType)) {
                                    invalidFiles.push(files[i].name);
                                }
                            }
                    
                            // Mostrar mensaje de error si se encontraron archivos no válidos
                            if (invalidFiles.length > 0) {
                                let errorMessage = 'Los siguientes archivos no son imágenes válidas:\n';
                                errorMessage += invalidFiles.join('\n');
                                alert(errorMessage);
                                // Limpiar el campo de entrada de archivos
                                event.target.value = '';
                            } else {
                                // Procesar los archivos si todos son válidos
                                self.displayFilesList(files);
                            }
                        });
                    }
                    
                }
            }
        });
    }

    showForm(selectedElement) {
        console.log("Llegamos a showForm");
        $('.editRaceSection').each(function() {
            let $this = $(this);
            let $selectedElement = $(selectedElement);
            console.log(selectedElement.classList);
            console.log($this.attr('id'));
            $this.addClass('d-none');
            if (selectedElement.classList.contains($this.attr('id'))) {
                $this.removeClass('d-none');
                console.log("Eliminando clase d-none...");
            }
            
        });
    }

    displayFilesList(files) {
        let tmp = '';
        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            if (file) {
                tmp += `
                <div id="file-` + i + `" class="files-list d-flex">
                    <img src="` + URL.createObjectURL(file) + `" />
                    <p>` + file.name + `</p>
                    <button type="button" class="btn-close delete-file" data-bs-dismiss="alert" aria-label="Delete"></button>
                </div>
                `;
            }
        }
        document.getElementById('fileList').innerHTML = tmp; 
        this.addDeleteFileEvent();
    }

    addDeleteFileEvent() {
        const self = this;
        const deleteButtons = document.querySelectorAll('.delete-file');
        deleteButtons.forEach(function(button) {
            if (button) {
                button.addEventListener('click', function() {
                    if (button && button.parentNode) {
                        const parentId = button.parentNode.id;
                        const fileId = parseInt(parentId.match(/\d+/)[0]);
                        let files = document.getElementById('gropFile').files;
                        let dataTransfer = new DataTransfer();
                        for (let i = 0; i < files.length; i++) {
                            if (i !== fileId) {
                                let file = files[i];
                                dataTransfer.items.add(file);
                            }
                        }
                        self.photosInput.files = dataTransfer.files;
                        /*
                        for (let index = 0; index < self.photosInput.files.length; index++) {
                            console.log(self.photosInput.files[index]);
                        }
                        */
                        button.parentNode.remove();
                    }
                });
            }
        });
    }

    async updateDrivers() {
        document.getElementById('drivers-races-table-body').innerHTML = await this.fetchDrivers();
    }

    async fetchDrivers() {
        return new Promise(async (resolve, reject) => {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/generateDorsals', {
                method: 'POST',
                body: JSON.stringify({ searchTerm: this.raceId.value}),
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
                            federationNumber: driver.federationNumber,
                            dorsal: driver.pivot.dorsal,
                            email: driver.email
                        };
                    });

                    const tableContent = driversJSON.map(driver => this.generateDriverTable(driver)).join('');
                    resolve(tableContent);
                } else {
                    resolve("<p>No drivers in this race.</p>");
                }
                
            })
            .catch(error => {
                console.error('Error:', error);
                reject(error.message);
            });
        });
    }

    generateDriverTable(driver) {
        let dorsal = driver.dorsal ? driver.dorsal : 'NO';
        return `
        <tr>
            <td class="py-3 text-center align-middle fw-bold">${driver.id}</td>
            <td class="py-3 text-center align-middle">${dorsal}</td>
            <td class="py-3 align-middle">${driver.federationNumber}</td>
            <td class="py-3 align-middle">${driver.name}</td>
            <td class="py-3 align-middle">${driver.email}</td>
        </tr>`;
      }
}

const adminEditRaces = new Admin_Edit_Races();
