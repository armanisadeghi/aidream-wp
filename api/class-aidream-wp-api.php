<?php

class AI_Dream_WP_Api {

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

    public function register_rest_endpoints() {
        register_rest_route( 'aidream-wp/v1', '/meta', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_meta_data')
        ) );
    }

    public function get_meta_data(WP_REST_Request $request) {
        $params = $request->get_params();
        $post_id = $params['post_id'];

        $data = array();

        // Meta title
        $meta_title = get_post_meta($post_id, '_aidream_wp_meta_title', true);

        if (!$meta_title) {
            $meta_title = get_post_meta($post_id, '_yoast_wpseo_title', true);
        }

        if (!$meta_title) {
            $meta_title = get_the_title($post_id) . ' ' . apply_filters('document_title_separator', '-') . ' ' . get_bloginfo( 'title', 'display' );
        }

        $data['title'] = $meta_title;

        // Meta description
        $meta_desc = get_post_meta($post_id, '_aidream_wp_meta_desc', true);

        if (!$meta_desc) {
            $meta_desc = get_post_meta($post_id, '_yoast_wpseo_metadesc', true);
        }

        if (!$meta_desc) {
            $meta_desc = get_bloginfo( 'description', 'display' );
        }

        $data['description'] = $meta_desc;

        $response = new WP_REST_Response($data, 200);
        return $response;
    }

}
