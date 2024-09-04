$(document).ready(function() {
    // Obtener las ciudades y cargarlas en los select de Origen y Destino
    $.getJSON('./backend/obtener_ciudades.php', function(data) {
        var opciones = '';
        $.each(data, function(key, val) {
            opciones += '<option value="' + val + '">' + val + '</option>';
        });
        $('#origen').html(opciones);
        $('#destino').html(opciones);
    });

    // Obtener el nombre del pasajero al ingresar el RUT
    $('#rut').on('blur', function() {
        var rut = $('#rut').val();
        $.ajax({
            url: 'https://s1.ntic.cl/RUT/',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ rut: rut }),
            success: function(response) {
                $('#nombre').val(response.razonSocial);
            },
            error: function() {
                alert('Error al obtener el nombre.');
            }
        });
    });

    // Enviar el formulario y generar los tickets
    $('#equipajeForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var servicio = $('#servicio').val();
        var rut = $('#rut').val();
        var codigoEquipaje = servicio + rut;

        $.post('./backend/registrar.php', formData + '&codigoEquipaje=' + codigoEquipaje, function(data) {
            $('#ticket').html(data);
        });
    });
});
