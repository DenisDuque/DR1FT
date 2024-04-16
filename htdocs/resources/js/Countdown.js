class Countdown {
    constructor() {
        const self = this;
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('countdownDate');
            self.time = {}
            if(dateInput) {
                self.clock = new Date(dateInput.value);
                self.time.days = document.getElementById('days');
                self.time.hours = document.getElementById('hours');
                self.time.minutes = document.getElementById('minutes');
                self.time.seconds = document.getElementById('seconds');

                self.showDate();
                self.interval = window.setInterval(() => self.showDate(), 1000);
            } else {
                console.log("Contador no iniciado.");
            }
        });
    }

    showDate() {
        let now = new Date();
        let timeDiff = this.clock - now;
        if (timeDiff > 0) {
            let totalSeconds = Math.floor(timeDiff / 1000);
            let days = Math.floor(totalSeconds / (24 * 3600));
            let remainingSeconds = totalSeconds % (24 * 3600);
            let hours = Math.floor(remainingSeconds / 3600);
            let minutes = Math.floor((remainingSeconds % 3600) / 60);
            let seconds = remainingSeconds % 60;

            // Format minutes and seconds to always have 2 digits
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            this.time.days.innerHTML = days;
            this.time.hours.innerHTML = hours;
            this.time.minutes.innerHTML = minutes;
            this.time.seconds.innerHTML = seconds;
        } else {
            clearInterval(this.interval); // Stop the countdown when time's up
        }
    }
}

const CountdownObject = new Countdown();