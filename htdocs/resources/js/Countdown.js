class Countdown {
    constructor() {
        const self = this;
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('countdownDate');
            self.time = {}
            if(dateInput) {
                const countdown = document.getElementById('countdown');
                const date = new Date(dateInput.value + " 5:00:00 PM");
            }
        });
    }

    showDate() {
        let now = new Date();  
        // Inserta la hora almacenada en clock en el span con id hora
        time.hours = document.getElementById('hora');
        time.hours.innerHTML = clock.getHours() - now.getHours(); 
        
        // Inserta los minutos almacenados en clock en el span con id minuto
        time.minutes = document.getElementById('minuto');
        time.minutes.innerHTML = clock.getMinutes()+60 - now.getMinutes();
        
        // Inserta los segundos almacenados en clock en el span con id segundo
        time.seconds = document.getElementById('segundo')
        time.seconds.innerHTML = "0" + clock.getSeconds()+60 - now.getSeconds();
    }
}