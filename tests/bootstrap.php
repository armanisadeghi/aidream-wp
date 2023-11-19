<?php
/**
 * Bootstrap file for setting up the testing environment.
 */

// Path to the WordPress codebase you'd like to test. 
// Define this in your phpunit.xml file, or here in the bootstrap.
$_tests_dir = getenv('WP_TESTS_DIR');

// Check if the WordPress test suite is installed.
if (!$_tests_dir) {
    echo "Error: Cannot find the WordPress tests suite." . PHP_EOL;
    echo "Please set the 'WP_TESTS_DIR' environment variable to the folder where WordPress tests suite is installed." . PHP_EOL;
    exit(1);
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually loads the plugin being tested.
 */
function _manually_load_plugin() {
    // Adjust the path to your main plugin file.
    require dirname(dirname(__FILE__)) . '/your-plugin.php';
}

// Load the plugin.
tests_add_filter('muplugins_loaded', '_manually_load_plugin');

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
