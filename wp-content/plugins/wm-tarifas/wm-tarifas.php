<?php
/*
Plugin Name: Tarifas Manager
Description: Plugin para gestionar tarifas de habitaciones en WordPress.
Version: 1.7
Author: WebModerna | Estudio Contable y Agencia Web
Author URI: https://www.webmoderna.com.ar
Tags: webmoderna, tarifas, tabla, tarifas hoteleras, precios, precio habitación, tarifa alojamiento
Text Domain: wp-tarifas-manager
*/

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

// Verificar o crear las tablas en la base de datos
function tarifas_manager_check_tables() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tarifas_manager';
    $seasons_table = $wpdb->prefix . 'tarifas_seasons';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    // Crear tabla de tarifas
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql = "CREATE TABLE $table_name (
            id INT NOT NULL AUTO_INCREMENT,
            habitacion VARCHAR(255) NOT NULL,
            temporada1 VARCHAR(255) NOT NULL,
            temporada2 VARCHAR(255) NOT NULL,
            temporada3 VARCHAR(255) NOT NULL,
            temporada4 VARCHAR(255) NOT NULL,
            temporada5 VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    // Crear tabla de temporadas
    if ($wpdb->get_var("SHOW TABLES LIKE '$seasons_table'") != $seasons_table) {
        $sql = "CREATE TABLE $seasons_table (
            id INT NOT NULL AUTO_INCREMENT,
            nombre VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        dbDelta($sql);
        
        // Insertar temporadas por defecto
        $default_seasons = ['Temporada 1', 'Temporada 2', 'Temporada 3', 'Temporada 4', 'Temporada 5'];
        foreach ($default_seasons as $season) {
            $wpdb->insert($seasons_table, ['nombre' => $season]);
        }
    }
    
    // Si la tabla de tarifas está vacía, insertar una habitación inicial sin enlazar a ninguna página
    $count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
    if ($count == 0) {
        $wpdb->insert($table_name, [
            'habitacion'   => '',
            'temporada1'   => '',
            'temporada2'   => '',
            'temporada3'   => '',
            'temporada4'   => '',
            'temporada5'   => ''
        ]);
    }
}
register_activation_hook(__FILE__, 'tarifas_manager_check_tables');

// Obtener temporadas desde la base de datos
function tarifas_manager_get_seasons() {
    global $wpdb;
    $seasons_table = $wpdb->prefix . 'tarifas_seasons';
    return $wpdb->get_results("SELECT * FROM $seasons_table", ARRAY_A);
}

// Crear el menú en el panel de administración
add_action('admin_menu', 'tarifas_manager_menu');
function tarifas_manager_menu() {
    add_menu_page(
        __('Gestión de Tarifas', 'wp-tarifas-manager'), 
        __('Tarifas', 'wp-tarifas-manager'), 
        'edit_posts', 
        'tarifas_manager', 
        'tarifas_manager_page', 
        'dashicons-calculator', 
        25
    );
}

// Mostrar la página de administración
function tarifas_manager_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tarifas_manager';
    $seasons = tarifas_manager_get_seasons();
    $habitaciones = get_pages(['post_type' => 'page']);
    $datos = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    
    echo '<div class="wrap">
            <h1>' . __('Gestión de Tarifas', 'wp-tarifas-manager') . '</h1>
            <h2>' . __('Configuración de Temporadas', 'wp-tarifas-manager') . '</h2>
            <form id="seasons-form">
                <table class="form-table">
                    <tbody>';
    
    foreach ($seasons as $index => $season) {
        echo '<tr>
                <td><input type="text" name="seasons[]" value="' . esc_attr($season['nombre']) . '" /></td>
              </tr>';
    }
    
    echo '      </tbody>
                </table>
                <button type="submit" class="button button-primary">' . __('Guardar Temporadas', 'wp-tarifas-manager') . '</button>
            </form>
            <hr>
            <h2>' . __('Tarifas por Habitación', 'wp-tarifas-manager') . '</h2>
            <form id="tarifas-form">
                <table class="form-table" id="tarifas-table">
                    <thead>
                        <tr>
                            <th>' . __('Habitación', 'wp-tarifas-manager') . '</th>';
    
    foreach ($seasons as $season) {
        echo '<th>' . esc_html($season['nombre']) . '</th>';
    }
    
    echo '          <th>' . __('Acciones', 'wp-tarifas-manager') . '</th>
                        </tr>
                    </thead>
                    <tbody id="tarifas-body">';
    
    foreach ($datos as $fila) {
        echo '<tr>
                <td>
                    <select name="habitaciones[]">
                        <option value="">' . __('Elegir habitación', 'wp-tarifas-manager') . '</option>';
        foreach ($habitaciones as $page) {
            $selected = ($page->post_title === $fila['habitacion']) ? 'selected' : '';
            echo '<option value="' . esc_attr($page->post_title) . '" ' . $selected . '>' . esc_html($page->post_title) . '</option>';
        }
        echo '      </select>
                </td>';
    
        foreach ($seasons as $index => $season) {
            echo '<td><input type="text" name="tarifa_temporada' . ($index + 1) . '[]" value="' . esc_attr($fila['temporada' . ($index + 1)]) . '" /></td>';
        }
        
        echo '<td><button type="button" class="button remove-habitacion">' . __('Eliminar', 'wp-tarifas-manager') . '</button></td>
              </tr>';
    }
    
    echo '</tbody>
                </table>
                <div class="tablenav bottom">
                    <button type="button" id="add-habitacion" class="button">' . __('Agregar Habitación', 'wp-tarifas-manager') . '</button>
                    <button type="submit" class="button button-primary">' . __('Guardar Cambios', 'wp-tarifas-manager') . '</button>
                </div>';
    wp_nonce_field('save_tarifas_action', 'save_tarifas_nonce');
    echo '</form>
          <div id="tarifas-message"></div>
          </div>';
}

// Guardar temporadas con AJAX
add_action('wp_ajax_guardar_temporadas', 'tarifas_manager_save_seasons');
function tarifas_manager_save_seasons() {
    global $wpdb;
    
    check_ajax_referer('save_tarifas_action', 'nonce');
    $seasons_table = $wpdb->prefix . 'tarifas_seasons';
    
    $wpdb->query("DELETE FROM $seasons_table");
    foreach ($_POST['seasons'] as $season) {
        $wpdb->insert($seasons_table, ['nombre' => sanitize_text_field($season)]);
    }
    wp_send_json_success(__('Temporadas actualizadas.', 'wp-tarifas-manager'));
}

// Guardar tarifas con AJAX
add_action('wp_ajax_guardar_tarifas', 'tarifas_manager_save_data');
function tarifas_manager_save_data() {
    global $wpdb;
    
    if (!current_user_can('edit_posts')) {
        wp_send_json_error(__('No tienes permisos suficientes.', 'wp-tarifas-manager'));
        wp_die();
    }
    
    $table_name = $wpdb->prefix . 'tarifas_manager';
    check_ajax_referer('save_tarifas_action', 'nonce');
    
    $wpdb->query("DELETE FROM $table_name");
    if (!empty($_POST['habitaciones'])) {
        foreach ($_POST['habitaciones'] as $index => $habitacion) {
            $wpdb->insert($table_name, [
                'habitacion' => sanitize_text_field($habitacion),
                'temporada1' => sanitize_text_field($_POST['tarifa_temporada1'][$index]),
                'temporada2' => sanitize_text_field($_POST['tarifa_temporada2'][$index]),
                'temporada3' => sanitize_text_field($_POST['tarifa_temporada3'][$index]),
                'temporada4' => sanitize_text_field($_POST['tarifa_temporada4'][$index]),
                'temporada5' => sanitize_text_field($_POST['tarifa_temporada5'][$index])
            ]);
        }
    }
    wp_send_json_success(__('Habitaciones y tarifas guardadas correctamente.', 'wp-tarifas-manager'));
}



// Cargar scripts y estilos
add_action('admin_enqueue_scripts', 'tarifas_manager_assets');
function tarifas_manager_assets($hook) {
    if ($hook !== 'toplevel_page_tarifas_manager') {
        return;
    }
    wp_enqueue_script('tarifas-manager-js', plugin_dir_url(__FILE__) . 'js/tarifas-manager.js', ['jquery'], '1.0', true);
    wp_enqueue_style('tarifas-manager-css', plugin_dir_url(__FILE__) . 'css/tarifas-manager.css', [], '1.0');
    wp_localize_script('tarifas-manager-js', 'tarifas_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('save_tarifas_action')
    ]);
}
