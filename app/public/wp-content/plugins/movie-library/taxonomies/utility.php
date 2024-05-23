<?php

/**
 * Registers the 'utility' taxonomy,
 * for use with 'movie' post type.
 */

function mlb_register_utility_taxonomy()
{
    register_taxonomy(
        'utility',
        ['movie'],
        [
            'labels' => [
                'name' => __('Internal Markers', 'movie-library'),
            ],
            'public' => false,
            'rewrite' => false,
            'show_ui' => true,
        ]
    );
}

add_action('init', 'mlb_register_utility_taxonomy');
