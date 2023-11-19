function aidream_wp_fetch_all_meta_titles() {
    // Arguments for WP_Query
    $args = array(
        'post_type' => 'any', // Fetches all post types. Adjust as needed.
        'post_status' => 'publish',
        'posts_per_page' => -1, // -1 to fetch all posts
    );

    // Create a new WP_Query instance
    $query = new WP_Query($args);

    // Array to hold all meta titles
    $meta_titles = array();

    // Loop through the posts
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();

            // Fetch the meta title. Adjust the meta key if you're using a custom field for the title.
            $meta_title = get_post_meta($post_id, '_yoast_wpseo_title', true);

            // Add to the array. The array key is the post ID for reference.
            $meta_titles[$post_id] = $meta_title;
        }
    }

    // Reset post data to avoid conflicts with other queries
    wp_reset_postdata();

    return $meta_titles;
}
