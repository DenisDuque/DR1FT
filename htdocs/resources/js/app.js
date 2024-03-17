import './bootstrap';
import './range';
import './Admin_Drivers_Search';
import './Admin_Insurances_Search';
import './Admin_Insurances_Races_Search';
import './Admin_Races_Search';
import './Admin_Sponsors_Search';
import './Admin_Sponsors_Races_Search';
import './Admin_Edit_Races';
import './page_scroll';

$(document).ready(function() {
    console.log('document ready');
    $(window).on('unload', function() {
        console.log("La página se está descargando");
    });
});
console.log('aa');

// Función para mostrar la vista previa de la imagen
function previewImage(input, preview) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(preview).html('<img src="' + e.target.result + '" class="img-fluid mx-auto d-block" alt="Preview">');
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        // Si no se selecciona ningún archivo, mostrar el icono por defecto
        $(preview).html('<i class="bi bi-card-image"></i>');
    }
}

// Manejar el cambio de archivos de imagen del banner
$('#raceBanner').change(function () {
    previewImage(this, '#bannerPreview');
});

// Manejar el cambio de archivos de imagen del mapa
$('#raceMap').change(function () {
    previewImage(this, '#mapPreview');
});


