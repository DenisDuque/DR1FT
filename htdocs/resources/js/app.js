import './bootstrap';
import './range';
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
<<<<<<< HEAD
import './page_scroll';
import './Countdown';
=======
//import './page_scroll';

>>>>>>> 3d511b02edbf56404f095440f3fe10628ec1bd98


$(document).ready(function() {
    console.log('document ready');
    $(window).on('unload', function() {
        console.log("La página se está descargando");
    });
});