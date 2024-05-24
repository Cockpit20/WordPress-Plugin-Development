<?php

/**
 * Wp_Query Demo
 */

add_action('admin_init', function () {
    $movie_query = new WP_Query(
        [
            'post_type' => 'movie',
            'tax_query' => array(
                array(
                    'taxonomy' => 'utility',
                    'field' => 'slug',
                    'terms' => array('person-19')
                ),
            ),
        ]
    );
    // echo '<pre>';
    // print_r($movie_query);
    // echo '</pre>';
    // die;
});
