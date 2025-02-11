<?php
/**
 * Plugin Name: Tarifas Manager
 * Plugin URI: https://webmoderna.com.ar
 * Description: Plugin para gestionar tarifas de habitaciones en hoteles y cabañas.
 * Version: 1.0.0
 * Author: Cr. Edgardo Raúl Galletto
 * Author URI: https://webmoderna.com.ar
 * License: GPL v2 or later
 * Text Domain: tarifas-manager
 */

// Seguridad: Evita el acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes
define('TARIFAS_MANAGER_VERSION', '1.0.0');
define('TARIFAS_MANAGER_PATH', plugin_dir_path(__FILE__));
define('TARIFAS_MANAGER_URL', plugin_dir_url(__FILE__));
define('TARIFAS_MANAGER_BASENAME', plugin_basename(__FILE__));

// Incluir archivos principales
require_once TARIFAS_MANAGER_PATH . 'includes/class-tarifas-manager.php';

// Inicializar el plugin
function tarifas_manager_init() {
    Tarifas_Manager::get_instance();
}
add_action('plugins_loaded', 'tarifas_manager_init');
