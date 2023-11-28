<?php

class AI_Dream_WP_Admin {

    /**
	 * The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 */
	private $version;

    /**
     * Initialize the class
     */
    public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    /**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name . '_admin', AIDREAM_WP_PLUGIN_URL . 'admin/css/aidream-wp-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name . '_admin', AIDREAM_WP_PLUGIN_URL . 'admin/js/aidream-wp-admin.js', array('jquery'), $this->version, false );

	}

    /**
     * Add a custom menu for AI Dream
     */
    public function add_menu() {
        add_menu_page( 
            __('AI Dream'),
            __('AI Dream'),
            'manage_options',
            'ai_dream',
            array($this, 'show_page'),
            'dashicons-admin-site-alt3'
        );
    }

    public function show_page() {
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }

        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'any',
        );
        $query = new WP_Query( $args );
        $posts = array();
        while ( $query->have_posts() ) {
            $query->the_post();
            $posts[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title()
            );
        }

        if ($_POST['save_meta']) {
            check_admin_referer('save-meta', '_wpnonce_save-meta');

            $post_id = $_POST['post_id'];
            $meta_title = $_POST['meta_title'];
            $meta_desc = $_POST['meta_description'];

            update_post_meta( $post_id, '_aidream_wp_meta_title', $meta_title );
            update_post_meta( $post_id, '_aidream_wp_meta_desc', $meta_desc );

            echo "<script>alert('" . __( 'Updated meta tags successfully!' ) . "')</script>";
        }

        include AIDREAM_WP_PLUGIN_DIR . 'admin/partials/aidream-wp-admin-display.php';
    }

}
