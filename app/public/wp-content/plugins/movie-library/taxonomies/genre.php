<?php

/**
 * Registers the `genre` taxonomy,
 * for use with 'movie'.
 */
function genre_init() {
	register_taxonomy( 'genre', [ 'movie' ], [
		'hierarchical'          => false,
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => true,
		'capabilities'          => [
			'manage_terms' => 'edit_posts',
			'edit_terms'   => 'edit_posts',
			'delete_terms' => 'edit_posts',
			'assign_terms' => 'edit_posts',
		],
		'labels'                => [
			'name'                       => __( 'Genres', 'movie-library' ),
			'singular_name'              => _x( 'Genre', 'taxonomy general name', 'movie-library' ),
			'search_items'               => __( 'Search Genres', 'movie-library' ),
			'popular_items'              => __( 'Popular Genres', 'movie-library' ),
			'all_items'                  => __( 'All Genres', 'movie-library' ),
			'parent_item'                => __( 'Parent Genre', 'movie-library' ),
			'parent_item_colon'          => __( 'Parent Genre:', 'movie-library' ),
			'edit_item'                  => __( 'Edit Genre', 'movie-library' ),
			'update_item'                => __( 'Update Genre', 'movie-library' ),
			'view_item'                  => __( 'View Genre', 'movie-library' ),
			'add_new_item'               => __( 'Add New Genre', 'movie-library' ),
			'new_item_name'              => __( 'New Genre', 'movie-library' ),
			'separate_items_with_commas' => __( 'Separate Genres with commas', 'movie-library' ),
			'add_or_remove_items'        => __( 'Add or remove Genres', 'movie-library' ),
			'choose_from_most_used'      => __( 'Choose from the most used Genres', 'movie-library' ),
			'not_found'                  => __( 'No Genres found.', 'movie-library' ),
			'no_terms'                   => __( 'No Genres', 'movie-library' ),
			'menu_name'                  => __( 'Genres', 'movie-library' ),
			'items_list_navigation'      => __( 'Genres list navigation', 'movie-library' ),
			'items_list'                 => __( 'Genres list', 'movie-library' ),
			'most_used'                  => _x( 'Most Used', 'genre', 'movie-library' ),
			'back_to_items'              => __( '&larr; Back to Genres', 'movie-library' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'genre',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'genre_init' );

/**
 * Sets the post updated messages for the `genre` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `genre` taxonomy.
 */
function genre_updated_messages( $messages ) {

	$messages['genre'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Genre added.', 'movie-library' ),
		2 => __( 'Genre deleted.', 'movie-library' ),
		3 => __( 'Genre updated.', 'movie-library' ),
		4 => __( 'Genre not added.', 'movie-library' ),
		5 => __( 'Genre not updated.', 'movie-library' ),
		6 => __( 'Genres deleted.', 'movie-library' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'genre_updated_messages' );
