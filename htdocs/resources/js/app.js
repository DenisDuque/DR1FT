import './bootstrap';
import './range';
import './Countdown';
import './User_Races_Search';
import './Admin_Drivers_Search';
import './Admin_Insurances_Search';
import './Admin_Insurances_Races_Search';
import './Admin_Races_Search';
import './Admin_Sponsors_Search';
import './Admin_Sponsors_Races_Search';
import './Admin_Edit_Races';
import './race_details';
import './admin_race';
import './btn_toggle';
import './Membership';
import './scrach_and_win';
import './page_scroll';

// Encuentra el elemento del toast por su ID
var myToast = document.getElementById('myToast');

// Configura las opciones del toast
var toastOptions = {
  autohide: false // Evita que el toast se oculte automáticamente
};

// Crea una instancia de Toast de Bootstrap con las opciones
var toast = new bootstrap.Toast(myToast, toastOptions);

// Muestra el toast
toast.show();


$(document).ready(function() {
    console.log('document ready');
    $(window).on('unload', function() {
        console.log("La página se está descargando");
    });
});