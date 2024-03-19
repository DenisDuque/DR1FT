$(document).ready(function() {
    // Ocultar el input al cargar la página si el checkbox no está marcado
    if (!$('#driverPro').prop('checked')) {
        $('#driverFederation').hide();
        // Cambiar el texto del label a "Insurance"
        $('#federation-label').text('Insurance');
        // Mostrar el select oculto
        $('.hidden-select').show();
    } else {
        // Ocultar el select al cargar la página si el checkbox está marcado
        $('.hidden-select').hide();
    }

    // Detectar cambios en el estado del checkbox
    $('#driverPro').change(function() {
        // Si el checkbox está marcado
        if ($(this).prop('checked')) {
            $('#driverFederation').show();
            // Cambiar el texto del label a "Nº Federation"
            $('#federation-label').text('Nº Federation');
            // Ocultar el select
            $('.hidden-select').hide();
        } else {
            // Si el checkbox no está marcado
            $('#driverFederation').hide();
            // Cambiar el texto del label a "Insurance"
            $('#federation-label').text('Insurance');
            // Mostrar el select oculto
            $('.hidden-select').show();
        }
    });
});