<?php
/**
 * Global variables and configuration for SIPAP 6.0
 * Refactored for better maintenance and security.
 */

// --- Configuration and Path Detection ---

// Detect protocol, host and base directory dynamically
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
$script_path = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$base_url = "{$protocol}://{$host}" . rtrim($script_path, '/') . '/';

// Define navigation URLs
$urlhome = $base_url;
$url     = "{$base_url}login.php?module=";

// --- Module Definitions ---

/**
 * List of modules available in the system.
 * Each module contains its full name, short name, internal folder name, icon and color theme.
 */
$arr_module = [
    [
        'nom_module'    => 'CONFIGURACIÓN Y MANTENIMIENTO',
        'nom_module_sm' => 'CONFIGURACIÓN',
        'url_module'    => 'empresa',
        'icon'          => 'fas fa-cogs',
        'color'         => 'primary'
    ],
    [
        'nom_module'    => 'CONTABILIDAD FISCAL',
        'nom_module_sm' => 'PAGOS',
        'url_module'    => 'contabilidad',
        'icon'          => 'fas fa-book',
        'color'         => 'success'
    ],
    [
        'nom_module'    => 'CONTABILIDAD PRESUPUESTARIA',
        'nom_module_sm' => 'PRESUPUESTARIA',
        'url_module'    => 'presupuesto',
        'icon'          => 'far fa-money-bill-alt',
        'color'         => 'info'
    ],
    [
        'nom_module'    => 'CONTROL BANCARIO',
        'nom_module_sm' => 'BANCARIO',
        'url_module'    => 'bancos',
        'icon'          => 'fas fa-university',
        'color'         => 'danger'
    ],
    [
        'nom_module'    => 'BIENES NACIONALES',
        'nom_module_sm' => 'PAGOS',
        'url_module'    => 'bienes',
        'icon'          => 'fas fa-warehouse',
        'color'         => 'warning'
    ],
    [
        'nom_module'    => 'NOMINA Y PERSONAL',
        'nom_module_sm' => 'NOMINA',
        'url_module'    => 'nomina',
        'icon'          => 'fas fa-users',
        'color'         => 'primary'
    ],
    [
        'nom_module'    => 'ORDENAMIENTO DE PAGOS',
        'nom_module_sm' => 'PAGOS',
        'url_module'    => 'pagos',
        'icon'          => 'fas fa-money-check-alt',
        'color'         => 'dark'
    ],
];

// --- Module Selection and Validation ---

// Safely get the module index from GET parameters
$module_index = filter_input(INPUT_GET, 'module', FILTER_VALIDATE_INT);

// Check if the selected module exists
if ($module_index !== null && $module_index !== false && isset($arr_module[$module_index])) {
    $selected_module = $arr_module[$module_index];
} else {
    // Default fallback state (e.g. for landing page or invalid input)
    $selected_module = [
        'nom_module'    => 'SISTEMA INTEGRADO PARA LA ADMINISTRACIÓN PÚBLICA SIPAP 6.0',
        'nom_module_sm' => 'SIPAP',
        'url_module'    => 'index.php',
        'icon'          => 'fas fa-shield-alt',
        'color'         => 'secondary'
    ];
}

// Map variables for backward compatibility with existing templates
$main_title    = $selected_module['nom_module']; 
$main_title_sm = $selected_module['nom_module_sm']; 
$main_url      = $selected_module['url_module']; 
$main_icon     = $selected_module['icon']; 
$main_color    = $selected_module['color']; 

?>