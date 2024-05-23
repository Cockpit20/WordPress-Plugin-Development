<?php

/**
 * Registers the `career` taxonomy,
 * for use with 'person'.
 */
function career_init() {
	register_taxonomy( 'career', [ 'person' ], [
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
			'name'                       => __( 'Careers', 'movie-library' ),
			'singular_name'              => _x( 'Career', 'taxonomy general name', 'movie-library' ),
			'search_items'               => __( 'Search Careers', 'movie-library' ),
			'popular_items'              => __( 'Popular Careers', 'movie-library' ),
			'all_items'                  => __( 'All Careers', 'movie-library' ),
			'parent_item'                => __( 'Parent Career', 'movie-library' ),
			'parent_item_colon'          => __( 'Parent Career:', 'movie-library' ),
			'edit_item'                  => __( 'Edit Career', 'movie-library' ),
			'update_item'                => __( 'Update Career', 'movie-library' ),
			'view_item'                  => __( 'View Career', 'movie-library' ),
			'add_new_item'               => __( 'Add New Career', 'movie-library' ),
			'new_item_name'              => __( 'New Career', 'movie-library' ),
			'separate_items_with_commas' => __( 'Separate Careers with commas', 'movie-library' ),
			'add_or_remove_items'        => __( 'Add or remove Careers', 'movie-library' ),
			'choose_from_most_used'      => __( 'Choose from the most used Careers', 'movie-library' ),
			'not_found'                  => __( 'No Careers found.', 'movie-library' ),
			'no_terms'                   => __( 'No Careers', 'movie-library' ),
			'menu_name'                  => __( 'Careers', 'movie-library' ),
			'items_list_navigation'      => __( 'Careers list navigation', 'movie-library' ),
			'items_list'                 => __( 'Careers list', 'movie-library' ),
			'most_used'                  => _x( 'Most Used', 'career', 'movie-library' ),
			'back_to_items'              => __( '&larr; Back to Careers', 'movie-library' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'career',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'career_init' );

/**
 * Sets the post updated messages for the `career` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `career` taxonomy.
 */
function career_updated_messages( $messages ) {

	$messages['career'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Career added.', 'movie-library' ),
		2 => __( 'Career deleted.', 'movie-library' ),
		3 => __( 'Career updated.', 'movie-library' ),
		4 => __( 'Career not added.', 'movie-library' ),
		5 => __( 'Career not updated.', 'movie-library' ),
		6 => __( 'Careers deleted.', 'movie-library' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'career_updated_messages' );
