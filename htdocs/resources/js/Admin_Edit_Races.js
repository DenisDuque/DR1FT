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
                }
                this.photosInput = document.getElementById('gropFile');
                this.photosInput.addEventListener('change', function(event) {
                    let files = event.target.files;
                    console.log(files);
                    self.displayFilesList(files);
                });
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
        this.photosInput.style.display = "none";
        document.getElementById('fileList').innerHTML = tmp; 
        this.addDeleteFileEvent();
    }

    addDeleteFileEvent() {
        const deleteButtons = document.querySelectorAll('.delete-file');
        deleteButtons.forEach(function(button) {
            if (button) {
                // Da error en consola, motivo desconocido.
                button.addEventListener('click', function() {
                    if (button && button.parentNode) {
                        button.parentNode.remove(); 
                    }
                });
            }
        });
    }
}

const adminEditRaces = new Admin_Edit_Races();
