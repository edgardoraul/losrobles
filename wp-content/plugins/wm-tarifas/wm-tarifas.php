<?php
/*
Plugin Name: Tarifas Manager
Description: Plugin seguro para gestionar tarifas de temporadas en WordPress.
Version: 1.1
Author: Tu Nombre
*/

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

// Crear la tabla en la base de datos al activar el plugin
register_activation_hook(__FILE__, 'tarifas_manager_install');
function tarifas_manager_install() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tarifas_manager';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        habitacion VARCHAR(255) NOT NULL,
        temporada VARCHAR(255) NOT NULL,
        precio DECIMAL(10, 2) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Eliminar la tabla de la base de datos al desinstalar el plugin
register_uninstall_hook(__FILE__, 'tarifas_manager_uninstall');
function tarifas_manager_uninstall() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tarifas_manager';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

// Crear el menú en el panel de administración
add_action('admin_menu', 'tarifas_manager_menu');
function tarifas_manager_menu() {
    add_menu_page(
        'Gestión de Tarifas', 
        'Tarifas', 
        'edit_posts', 
        'tarifas_manager', 
        'tarifas_manager_page', 
        'dashicons-admin-generic', 
        25
    );
}

// Mostrar la página de administración
function tarifas_manager_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tarifas_manager';

    // Obtener habitaciones de páginas estáticas
    $habitaciones = get_pages(['post_type' => 'page']);

    // Procesar formulario si se envía
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        check_admin_referer('save_tarifas_action', 'save_tarifas_nonce');

        // Eliminar datos existentes
        $wpdb->query("DELETE FROM $table_name");

        // Guardar nuevas tarifas
        foreach ($_POST['tarifas'] as $habitacion => $temporadas) {
            foreach ($temporadas as $temporada => $precio) {
                $wpdb->insert($table_name, [
                    'habitacion' => sanitize_text_field($habitacion),
                    'temporada' => sanitize_text_field($temporada),
                    'precio' => floatval($precio)
                ]);
            }
        }

        echo '<div class="updated"><p>Tarifas guardadas correctamente.</p></div>';
    }

    // Obtener datos existentes
    $datos = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

    $tarifas = [];
    foreach ($datos as $fila) {
        $tarifas[$fila['habitacion']][$fila['temporada']] = $fila['precio'];
    }

    echo '<div class="wrap">
            <h1>Gestión de Tarifas</h1>
            <form method="post">
                <table class="form-table" id="tarifas-table">
                    <thead>
                        <tr>
                            <th>Habitación</th>
';
    // Generar encabezados de temporadas
    if (!empty($tarifas)) {
        $temporadas = array_keys(reset($tarifas));
        foreach ($temporadas as $temporada) {
            echo '<th>' . esc_html($temporada) . '</th>';
        }
    }
    echo '				</tr>
                    </thead>
                    <tbody>
';
    // Generar filas para habitaciones
    foreach ($habitaciones as $habitacion) {
        $titulo = $habitacion->post_title;
        echo '<tr>
                <td>' . esc_html($titulo) . '</td>
';
        if (!empty($tarifas[$titulo])) {
            foreach ($tarifas[$titulo] as $temporada => $precio) {
                echo '<td><input type="number" step="0.01" name="tarifas[' . esc_attr($titulo) . '][' . esc_attr($temporada) . ']" value="' . esc_attr($precio) . '" /></td>';
            }
        }
        echo '</tr>';
    }

    echo '			</tbody>
                </table>
                <hr />
				<button type="button" class="button primary" id="add-column">Añadir Temporada</button>
                <input type="submit" name="save_tarifas" value="Guardar Cambios" class="button button-primary">
';
    wp_nonce_field('save_tarifas_action', 'save_tarifas_nonce');
    echo '            </form>
          </div>';
}

// Cargar scripts y estilos
add_action('admin_enqueue_scripts', 'tarifas_manager_assets');
function tarifas_manager_assets($hook) {
    if ($hook !== 'toplevel_page_tarifas_manager') {
        return;
    }

    wp_enqueue_script('tarifas-manager-js', plugin_dir_url(__FILE__) . 'js/tarifas-manager.js', ['jquery'], '1.0', true);
    wp_enqueue_style('tarifas-manager-css', plugin_dir_url(__FILE__) . 'css/tarifas-manager.css', [], '1.0');
}