<?php
/*
Plugin Name: Tarifas Manager
Description: Plugin para gestionar tarifas de habitaciones en WordPress.
Version: 1.6
Author: WebModerna | Estudio Contable y Agencia Web
Author URI: https://www.webmoderna.com.ar
Tags: webmoderna, tarifas, tabla, tarifas hoteleras, precios, precio habitación, tarifa alojamiento
Text Domain: wp-tarifas-manager
*/

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

// Verificar o crear la tabla en la base de datos
function tarifas_manager_check_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tarifas_manager';
    
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            id INT NOT NULL AUTO_INCREMENT,
            habitacion VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

register_activation_hook(__FILE__, 'tarifas_manager_check_table');

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
    $habitaciones = get_pages(['post_type' => 'page']);
    $datos = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    
    echo '<div class="wrap">
            <h1>' . __('Gestión de Tarifas', 'wp-tarifas-manager') . '</h1>
            <form id="tarifas-form">
                <table class="form-table" id="tarifas-table">
                    <thead>
                        <tr>
                            <th>' . __('Habitación', 'wp-tarifas-manager') . '</th>
                            <th>' . __('Acciones', 'wp-tarifas-manager') . '</th>
                        </tr>
                    </thead>
                    <tbody id="tarifas-body">';
    
    if (empty($datos)) {
        echo '<tr>
                <td>
                    <select name="habitaciones[]">
                        <option value="">' . __('Seleccionar habitación', 'wp-tarifas-manager') . '</option>';
        foreach ($habitaciones as $page) {
            echo '<option value="' . esc_attr($page->post_title) . '">' . esc_html($page->post_title) . '</option>';
        }
        echo '      </select>
                </td>
                <td><button type="button" class="button remove-habitacion">' . __('Eliminar Habitación', 'wp-tarifas-manager') . '</button></td>
            </tr>';
    } else {
        foreach ($datos as $fila) {
            echo '<tr>
                    <td>
                        <select name="habitaciones[]">';
            foreach ($habitaciones as $page) {
                $selected = ($page->post_title === $fila['habitacion']) ? 'selected' : '';
                echo '<option value="' . esc_attr($page->post_title) . '" ' . $selected . '>' . esc_html($page->post_title) . '</option>';
            }
            echo '      </select>
                    </td>
                    <td><button type="button" class="button remove-habitacion">' . __('Eliminar Habitación', 'wp-tarifas-manager') . '</button></td>
                </tr>';
        }
    }
    
    echo '</tbody>
                </table>
                <div class="tablenav bottom">
                    <button type="button" id="add-habitacion" class="button">' . __('Agregar Habitación', 'wp-tarifas-manager') . '</button>
                    <button type="submit" class="button button-primary">' . __('Guardar Cambios', 'wp-tarifas-manager') . '</button>
                </div>
                ';
    wp_nonce_field('save_tarifas_action', 'save_tarifas_nonce');
    echo '</form>
          <div id="tarifas-message"></div>
          </div>';
}

// Guardar datos con AJAX
add_action('wp_ajax_guardar_tarifas', 'tarifas_manager_save_data');
function tarifas_manager_save_data() {
    global $wpdb;

    // Verificar permisos
    if (!current_user_can('edit_posts')) {
        wp_send_json_error(__('No tienes permisos suficientes.', 'wp-tarifas-manager'));
        wp_die();
    }
    

    $table_name = $wpdb->prefix . 'tarifas_manager';
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'save_tarifas_action')) {
        wp_send_json_error(__('Error de seguridad: nonce inválido.', 'wp-tarifas-manager'));
        wp_die();
    }
    
    
    $wpdb->query("DELETE FROM $table_name");
    if (!empty($_POST['habitaciones'])) {
        foreach ($_POST['habitaciones'] as $habitacion) {
            $wpdb->insert($table_name, ['habitacion' => sanitize_text_field($habitacion)]);
        }
    }
    wp_send_json_success(__('Habitaciones guardadas correctamente.', 'wp-tarifas-manager'));
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
