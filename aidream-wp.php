<?php
/**
 * Plugin Name: AI Dream WP
 * Plugin URI:  https://titaniumsuccess.com/plugin
 * Description: A WordPress plugin to enhance SEO and content quality by analyzing and suggesting improvements for meta titles and descriptions.
 * Version:     1.0.0
 * Author:      Armani Sadeghi
 * Author URI:  https://titaniumsuccess.com
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: aidream-wp
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define plugin constants.
define('AIDREAM_WP_VERSION', '1.0.0');
define('AIDREAM_WP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('AIDREAM_WP_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-aidream-wp-activator.php
 */
function activate_aidream_wp() {
    require_once AIDREAM_WP_PLUGIN_DIR . 'includes/class-aidream-wp-activator.php';
    AI_Dream_WP_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-aidream-wp-deactivator.php
 */
function deactivate_aidream_wp() {
    require_once AIDREAM_WP_PLUGIN_DIR . 'includes/class-aidream-wp-deactivator.php';
    AI_Dream_WP_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_aidream_wp');
register_deactivation_hook(__FILE__, 'deactivate_aidream_wp');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require AIDREAM_WP_PLUGIN_DIR . 'includes/class-aidream-wp.php';

/**
 * Begins execution of the plugin.
 */
function run_aidream_wp() {
    $plugin = new AI_Dream_WP();
    $plugin->run();
}

run_aidream_wp();
