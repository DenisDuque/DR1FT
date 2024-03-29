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

    var links = $('nav ul li a');
    var content = $('div.content');
    var border = $('span');
    var lis = $('nav ul li');

    links.each(function(i) {
        $(this).on('click', function(e) {
            e.preventDefault();

            var activLinks = $('nav ul li a.activ');
            var activContent = $('section > div.activ');

            activLinks.removeClass('activ');
            activContent.removeClass('activ');

            $(this).addClass('activ');
            var attr = $(this).attr('href');

            var activ = $(attr);
            activ.addClass('activ');

            var lisLength = lis.length;
            var lisWidth = 100 / lisLength;
            var position = i * lisWidth;
            border.css('left', position + '%');
        });
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
            document.getElementById('driveBirthDate').value = data.driver.birthDate;
            document.getElementById('driverGender').value = data.driver.gender;
            document.getElementById('driverAddress').value = data.driver.address;
            // Otros campos del formulario...
        } else {
            alert(data.message); // Mostrar mensaje de error
        }
    })
    .catch(error => console.error('Error:', error));
}
