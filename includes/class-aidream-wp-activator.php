<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 */

class AI_Dream_WP_Activator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     */
    public static function activate() {
        // Actions to perform upon plugin activation.

        // Example: Set up default options in the database
        if (!get_option('aidream_wp_options')) {
            $default_options = array(
                // Define your default option values here.
            );

            add_option('aidream_wp_options', $default_options);
        }

        // Additional activation tasks like setting up custom database tables.
    }
}
