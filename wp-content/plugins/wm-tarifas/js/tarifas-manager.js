// Botón del formulario para añadir habitaciones
jQuery(document).ready(function($) {
    $('#add-habitacion').on('click', function() {
        $('#tarifas-body').append('<tr>' +
            '<td><select name="habitaciones[]">' + $('#tarifas-body select:first').html() + '</select></td>' +
            '<td><button type="button" class="button remove-habitacion">Eliminar Habitación</button></td>' +
            '</tr>');
    });

    $(document).on('click', '.remove-habitacion', function() {
        $(this).closest('tr').remove();
    });
});

// formulario de tarifas
jQuery(document).ready(function($) {
    $('#tarifas-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        formData += '&nonce=' + tarifas_ajax.nonce; // Añadir el nonce manualmente
        
        $.post(tarifas_ajax.ajax_url, formData + '&action=guardar_tarifas', function(response) {
            if (response.success) {
                $('#tarifas-message').html('<div class="updated"><p>' + response.data + '</p></div>');
            } else {
                $('#tarifas-message').html('<div class="error"><p>' + response.data + '</p></div>');
            }
        });
    });
});
