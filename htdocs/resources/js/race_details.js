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
    $('#check-credentials').click(function () { 
       verificarCredenciales();
        console.log('click check credenciales')
    });
});


// En tu archivo JavaScript
function verificarCredenciales() {
    const email = document.getElementById('driverEmail').value;
    const password = document.getElementById('driverPassword').value;
    console.log(email);
    console.log(password);
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/credenciales', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ email: email, password: password })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.success) {
            // Autorellenar los campos del formulario con los datos del conductor
            document.getElementById('driverName').value = data.driver.name;
            document.getElementById('driveBirthDate').value = data.driver.birth_date;
            document.getElementById('driverGender').value = data.driver.gender;
            // Otros campos del formulario...
        } else {
            alert(data.message); // Mostrar mensaje de error
        }
    })
    .catch(error => console.error('Error:', error));
}
