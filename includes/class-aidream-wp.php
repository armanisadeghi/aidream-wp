<?php
/**
 * The core plugin class.
 */

class AI_Dream_WP {

    /**
	 * The unique identifier of this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 */
	protected $version;

    /**
     * Initialize the class and set its properties.
     */
    public function __construct() {
		$this->version = AIDREAM_WP_VERSION;
		$this->plugin_name = 'aidream_wp';

        require_once AIDREAM_WP_PLUGIN_DIR . 'admin/class-aidream-wp-admin.php';
        require_once AIDREAM_WP_PLUGIN_DIR . 'api/class-aidream-wp-api.php';
        require_once AIDREAM_WP_PLUGIN_DIR . 'public/class-aidream-wp-public.php';
    }

    /**
     * Register all of the hooks related to the functionality of the plugin.
     */
    private function define_hooks() {
        $plugin_api = new AI_Dream_WP_Api($this->plugin_name, $this->version);
        add_action('rest_api_init', array($plugin_api, 'register_rest_endpoints'));

        if (is_admin()) {
            $plugin_admin = new AI_Dream_WP_Admin($this->plugin_name, $this->version);
            add_action( 'admin_enqueue_scripts', array($plugin_admin, 'enqueue_styles') );
		    add_action( 'admin_enqueue_scripts', array($plugin_admin, 'enqueue_scripts') );
            add_action( 'admin_menu', array($plugin_admin, 'add_menu') );
        } else {
            $plugin_public = new AI_Dream_WP_Public($this->plugin_name, $this->version);

            // Check if Yoast SEO is active
            $plugins = get_option( 'active_plugins', array() );
            if (in_array('wordpress-seo/wp-seo.php', $plugins)) {
                add_filter( 'wpseo_title', array($plugin_public, 'modify_meta_title') );
                add_filter( 'wpseo_metadesc', array($plugin_public, 'modify_yoast_desc') );
            } else {
                add_filter('pre_get_document_title', array($plugin_public, 'modify_meta_title') );
                add_action('wp_head', array($plugin_public, 'modify_meta') );
            }
        }
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     */
    public function run() {
        $this->define_hooks();
    }

}
