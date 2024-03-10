import './bootstrap';
import './range';


// Función para mostrar la vista previa de la imagen
function previewImage(input, preview) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(preview).html('<img src="' + e.target.result + '" class="img-fluid" alt="Preview">');
        };

        reader.readAsDataURL(input.files[0]);
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
