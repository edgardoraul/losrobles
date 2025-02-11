<?php
// Seguridad: Evita el acceso directo
if (!defined('ABSPATH')) {
    exit;
}

class Tarifas_Manager {
    private static $instance = null;

    // Constructor privado para evitar instancias múltiples
    private function __construct() {
        $this->init_hooks();
    }

    // Obtener la instancia única
    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Inicializar hooks
    private function init_hooks() {
        add_action('admin_enqueue_scripts', [$this, 'cargar_estilos_y_scripts']);
        add_action('admin_menu', [$this, 'crear_menu_administracion']);
    }

    // Cargar archivos CSS y JS en el admin
    public function cargar_estilos_y_scripts() {
        wp_enqueue_style('tarifas-manager-admin', TARIFAS_MANAGER_URL . 'assets/css/admin.css', [], TARIFAS_MANAGER_VERSION);
        wp_enqueue_script('tarifas-manager-admin', TARIFAS_MANAGER_URL . 'assets/js/admin.js', ['jquery'], TARIFAS_MANAGER_VERSION, true);
    }

    // Crear menú en el panel de administración
    public function crear_menu_administracion() {
        add_menu_page(
            __('Tarifas Manager', 'tarifas-manager'),
            __('Tarifas', 'tarifas-manager'),
            'manage_options',
            'tarifas-manager',
            [$this, 'mostrar_pagina_administracion'],
            'dashicons-calculator',
            25
        );
    }

    // Mostrar la página de administración
    public function mostrar_pagina_administracion() {
        echo '<div class="wrap"><h1>' . __('Gestión de Tarifas', 'tarifas-manager') . '</h1></div>';
    }
}
?>
