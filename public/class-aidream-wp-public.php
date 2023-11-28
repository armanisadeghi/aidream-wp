<?php

class AI_Dream_WP_Public {

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

    public function modify_meta_title($title) {
        if (is_home()) return $title;

        $post_id = get_the_ID();

        $meta_title = get_post_meta($post_id, '_aidream_wp_meta_title', true);
        if ($meta_title) {
            return $meta_title;
        }

        return $title;
    }

    public function modify_meta() {
        if (!is_home()) {
            $post_id = get_the_ID();

            $meta_desc = get_post_meta($post_id, '_aidream_wp_meta_desc', true);
            if ($meta_desc) {
                ?>
                <meta name="description" content="<?php echo $meta_desc; ?>" />
                <?php
            }
        }
    }

    public function modify_yoast_desc($description) {
        if (is_home()) return $description;

        $post_id = get_the_ID();

        $meta_desc = get_post_meta($post_id, '_aidream_wp_meta_desc', true);
        if ($meta_desc) {
            return $meta_desc;
        }

        return $description;
    }

}
