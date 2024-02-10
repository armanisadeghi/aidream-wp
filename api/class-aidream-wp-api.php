<?php

class AI_Dream_WP_Api
{

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
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function register_rest_endpoints()
    {
        register_rest_route('aidream-wp/v1', '/meta', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_meta_data')
        ));
    }

    public function get_meta_data(WP_REST_Request $request)
    {
        $params = $request->get_params();
        $post_id = $params['post_id'];

        $data = array();

        // Meta title
        $meta_title = get_post_meta($post_id, '_aidream_wp_meta_title', true);

        if (!$meta_title) {
            $meta_title = get_post_meta($post_id, '_yoast_wpseo_title', true);
        }

        if (!$meta_title) {
            $meta_title = get_the_title($post_id) . ' ' . apply_filters('document_title_separator', '-') . ' ' . get_bloginfo('title', 'display');
        }

        $data['title'] = $meta_title;

        // Meta description
        $meta_desc = get_post_meta($post_id, '_aidream_wp_meta_desc', true);

        if (!$meta_desc) {
            $meta_desc = get_post_meta($post_id, '_yoast_wpseo_metadesc', true);
        }

        if (!$meta_desc) {
            $meta_desc = get_bloginfo('description', 'display');
        }

        $data['description'] = $meta_desc;

        // Fetch post content
        $post_content = get_post_field('post_content', $post_id);

        // Initialize DOMDocument and load post content
        $dom = new DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($post_content, 'HTML-ENTITIES', 'UTF-8'));

        // Extract and add H1, H2, H3, H4 tags to the response
        foreach (['h1', 'h2', 'h3', 'h4'] as $tag) {
            $elements = $dom->getElementsByTagName($tag);
            $data[$tag] = []; // Initialize an array to hold the contents of each tag type

            foreach ($elements as $element) {
                $data[$tag][] = $element->textContent; // Add the text content of each tag to the array
            }
        }

        // Extract images
        $images = $dom->getElementsByTagName('img');
        $data['images'] = []; // Initialize an array to hold image details

        foreach ($images as $image) {
            $src = $image->getAttribute('src');
            $alt = $image->getAttribute('alt');
            $title = $image->getAttribute('title'); // This is often used as a "description"

            // Add image details to the array
            $data['images'][] = [
                'src' => $src,
                'alt' => $alt,
                'title' => $title
            ];
        }
        $response = new WP_REST_Response($data, 200);
        return $response;
    }
}
