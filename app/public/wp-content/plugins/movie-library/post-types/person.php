<?php

/**
 * Registers the `person` post type.
 */
function person_init() {
	register_post_type(
		'person',
		[
			'labels'                => [
				'name'                  => __( 'People', 'movie-library' ),
				'singular_name'         => __( 'Person', 'movie-library' ),
				'all_items'             => __( 'All People', 'movie-library' ),
				'archives'              => __( 'Person Archives', 'movie-library' ),
				'attributes'            => __( 'Person Attributes', 'movie-library' ),
				'insert_into_item'      => __( 'Insert into Person', 'movie-library' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Person', 'movie-library' ),
				'featured_image'        => _x( 'Featured Image', 'person', 'movie-library' ),
				'set_featured_image'    => _x( 'Set featured image', 'person', 'movie-library' ),
				'remove_featured_image' => _x( 'Remove featured image', 'person', 'movie-library' ),
				'use_featured_image'    => _x( 'Use as featured image', 'person', 'movie-library' ),
				'filter_items_list'     => __( 'Filter People list', 'movie-library' ),
				'items_list_navigation' => __( 'People list navigation', 'movie-library' ),
				'items_list'            => __( 'People list', 'movie-library' ),
				'new_item'              => __( 'New Person', 'movie-library' ),
				'add_new'               => __( 'Add New', 'movie-library' ),
				'add_new_item'          => __( 'Add New Person', 'movie-library' ),
				'edit_item'             => __( 'Edit Person', 'movie-library' ),
				'view_item'             => __( 'View Person', 'movie-library' ),
				'view_items'            => __( 'View People', 'movie-library' ),
				'search_items'          => __( 'Search People', 'movie-library' ),
				'not_found'             => __( 'No People found', 'movie-library' ),
				'not_found_in_trash'    => __( 'No People found in trash', 'movie-library' ),
				'parent_item_colon'     => __( 'Parent Person:', 'movie-library' ),
				'menu_name'             => __( 'People', 'movie-library' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title', 'editor','excerpt','thumbnail','author','revisions' ],
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => 6,
			'menu_icon'             => 'dashicons-admin-users',
			'show_in_rest'          => true,
			'rest_base'             => 'person',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);

}

add_action( 'init', 'person_init' );

/**
 * Sets the post updated messages for the `person` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `person` post type.
 */
function person_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['person'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Person updated. <a target="_blank" href="%s">View Person</a>', 'movie-library' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'movie-library' ),
		3  => __( 'Custom field deleted.', 'movie-library' ),
		4  => __( 'Person updated.', 'movie-library' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Person restored to revision from %s', 'movie-library' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Person published. <a href="%s">View Person</a>', 'movie-library' ), esc_url( $permalink ) ),
		7  => __( 'Person saved.', 'movie-library' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Person submitted. <a target="_blank" href="%s">Preview Person</a>', 'movie-library' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Person scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Person</a>', 'movie-library' ), date_i18n( __( 'M j, Y @ G:i', 'movie-library' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Person draft updated. <a target="_blank" href="%s">Preview Person</a>', 'movie-library' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'person_updated_messages' );

/**
 * Sets the bulk post updated messages for the `person` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `person` post type.
 */
function person_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['person'] = [
		/* translators: %s: Number of People. */
		'updated'   => _n( '%s Person updated.', '%s People updated.', $bulk_counts['updated'], 'movie-library' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Person not updated, somebody is editing it.', 'movie-library' ) :
						/* translators: %s: Number of People. */
						_n( '%s Person not updated, somebody is editing it.', '%s People not updated, somebody is editing them.', $bulk_counts['locked'], 'movie-library' ),
		/* translators: %s: Number of People. */
		'deleted'   => _n( '%s Person permanently deleted.', '%s People permanently deleted.', $bulk_counts['deleted'], 'movie-library' ),
		/* translators: %s: Number of People. */
		'trashed'   => _n( '%s Person moved to the Trash.', '%s People moved to the Trash.', $bulk_counts['trashed'], 'movie-library' ),
		/* translators: %s: Number of People. */
		'untrashed' => _n( '%s Person restored from the Trash.', '%s People restored from the Trash.', $bulk_counts['untrashed'], 'movie-library' ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'person_bulk_updated_messages', 10, 2 );
