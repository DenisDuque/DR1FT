class Admin_Edit_Races {
    constructor() {
        document.addEventListener('DOMContentLoaded', () => {
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
    
                                    self.showForm(selectedElement);
                                }
                            });
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
}

const adminEditRaces = new Admin_Edit_Races();
