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