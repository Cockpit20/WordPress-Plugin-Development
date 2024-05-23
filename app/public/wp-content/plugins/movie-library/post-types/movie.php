<?php

/**
 * Registers the `movie` post type.
 */
function movie_init()
{
	register_post_type(
		'movie',
		[
			'labels'                => [
				'name'                  => __('Movies', 'movie-library'),
				'singular_name'         => __('Movie', 'movie-library'),
				'all_items'             => __('All Movies', 'movie-library'),
				'archives'              => __('Movie Archives', 'movie-library'),
				'attributes'            => __('Movie Attributes', 'movie-library'),
				'insert_into_item'      => __('Insert into Movie', 'movie-library'),
				'uploaded_to_this_item' => __('Uploaded to this Movie', 'movie-library'),
				'featured_image'        => _x('Movie Poster', 'movie', 'movie-library'),
				'set_featured_image'    => _x('Set movie poster', 'movie', 'movie-library'),
				'remove_featured_image' => _x('Remove featured image', 'movie', 'movie-library'),
				'use_featured_image'    => _x('Use as featured image', 'movie', 'movie-library'),
				'filter_items_list'     => __('Filter Movies list', 'movie-library'),
				'items_list_navigation' => __('Movies list navigation', 'movie-library'),
				'items_list'            => __('Movies list', 'movie-library'),
				'new_item'              => __('New Movie', 'movie-library'),
				'add_new'               => __('Add New', 'movie-library'),
				'add_new_item'          => __('Add New Movie', 'movie-library'),
				'edit_item'             => __('Edit Movie', 'movie-library'),
				'view_item'             => __('View Movie', 'movie-library'),
				'view_items'            => __('View Movies', 'movie-library'),
				'search_items'          => __('Search Movies', 'movie-library'),
				'not_found'             => __('No Movies found', 'movie-library'),
				'not_found_in_trash'    => __('No Movies found in trash', 'movie-library'),
				'parent_item_colon'     => __('Parent Movie:', 'movie-library'),
				'menu_name'             => __('Movies', 'movie-library'),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => ['title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions'],
			'has_archive'           => 'movies',
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => 6,
			'menu_icon'             => 'dashicons-video-alt2',
			'show_in_rest'          => true, //help us to use the block editor instaed of the calssic editor
			'rest_base'             => 'movie',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'taxonomies'			=> ['category', 'post_tag'],
		]
	);
}

add_action('init', 'movie_init');

/**
 * Sets the post updated messages for the `movie` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `movie` post type.
 */
function movie_updated_messages($messages)
{
	global $post;

	$permalink = get_permalink($post);

	$messages['movie'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf(__('Movie updated. <a target="_blank" href="%s">View Movie</a>', 'movie-library'), esc_url($permalink)),
		2  => __('Custom field updated.', 'movie-library'),
		3  => __('Custom field deleted.', 'movie-library'),
		4  => __('Movie updated.', 'movie-library'),
		/* translators: %s: date and time of the revision */
		5  => isset($_GET['revision']) ? sprintf(__('Movie restored to revision from %s', 'movie-library'), wp_post_revision_title((int) $_GET['revision'], false)) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf(__('Movie published. <a href="%s">View Movie</a>', 'movie-library'), esc_url($permalink)),
		7  => __('Movie saved.', 'movie-library'),
		/* translators: %s: post permalink */
		8  => sprintf(__('Movie submitted. <a target="_blank" href="%s">Preview Movie</a>', 'movie-library'), esc_url(add_query_arg('preview', 'true', $permalink))),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf(__('Movie scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Movie</a>', 'movie-library'), date_i18n(__('M j, Y @ G:i', 'movie-library'), strtotime($post->post_date)), esc_url($permalink)),
		/* translators: %s: post permalink */
		10 => sprintf(__('Movie draft updated. <a target="_blank" href="%s">Preview Movie</a>', 'movie-library'), esc_url(add_query_arg('preview', 'true', $permalink))),
	];

	return $messages;
}

add_filter('post_updated_messages', 'movie_updated_messages');

/**
 * Sets the bulk post updated messages for the `movie` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `movie` post type.
 */
function movie_bulk_updated_messages($bulk_messages, $bulk_counts)
{
	global $post;

	$bulk_messages['movie'] = [
		/* translators: %s: Number of Movies. */
		'updated'   => _n('%s Movie updated.', '%s Movies updated.', $bulk_counts['updated'], 'movie-library'),
		'locked'    => (1 === $bulk_counts['locked']) ? __('1 Movie not updated, somebody is editing it.', 'movie-library') :
			/* translators: %s: Number of Movies. */
			_n('%s Movie not updated, somebody is editing it.', '%s Movies not updated, somebody is editing them.', $bulk_counts['locked'], 'movie-library'),
		/* translators: %s: Number of Movies. */
		'deleted'   => _n('%s Movie permanently deleted.', '%s Movies permanently deleted.', $bulk_counts['deleted'], 'movie-library'),
		/* translators: %s: Number of Movies. */
		'trashed'   => _n('%s Movie moved to the Trash.', '%s Movies moved to the Trash.', $bulk_counts['trashed'], 'movie-library'),
		/* translators: %s: Number of Movies. */
		'untrashed' => _n('%s Movie restored from the Trash.', '%s Movies restored from the Trash.', $bulk_counts['untrashed'], 'movie-library'),
	];

	return $bulk_messages;
}

add_filter('bulk_post_updated_messages', 'movie_bulk_updated_messages', 10, 2);


/**
 * Add Actors Information Metabox
 * 
 * @return void
 */

function mlb_actors_metabox()
{
	add_meta_box(
		'mlb_actors_metabox',
		__('Actors', 'movie-library'),
		'mlb_actors_metabox_html',
		'movie',
		'side'
	);
}

add_action('add_meta_boxes', 'mlb_actors_metabox');

/**
 * Render Actors Information Metabox.
 * 
 * @param WP_Post $post Post Object
 * 
 * @return void
 */

function mlb_actors_metabox_html($post)
{
	$mlb_actors = (array)get_post_meta($post->ID, 'actors', true);
	$people = get_posts([
		'post-type' => 'person',
		'post_status' => 'publish',
		'posts_per_page' => 10,
		'suppress_filters' => false,
	]);
	wp_nonce_field('mlb_actors', 'mlb_actors_nonce', false, true);

?>

	<select name="actors[]" id="mlb_actors" multiple size="5">
		<?php
		foreach ($people as $person) {
			printf(
				'<option value="%1$d" %2$s>%3$s</option>',
				esc_attr($person->ID),
				selected(in_array($person->ID, $mlb_actors, true), true, false),
				esc_html(get_the_title($person->ID))
			);
		}
		?>
	</select>

<?php
}

/**
 * 	Save actors information in post meta.
 * 
 * @param int $post_id Post ID
 * 
 * @return void
 */

function mlb_save_actors($post_id)
{
	$is_autosave = wp_is_post_autosave($post_id);
	$is_revision = wp_is_post_revision($post_id);

	if ($is_autosave || $is_revision) {
		return;
	}

	if (!current_user_can('edit_post')) {
		return;
	}

	$mlb_actors_nonce = sanitize_text_field(filter_input(INPUT_POST, 'mlb_actors_nonce'));

	if (!wp_verify_nonce($mlb_actors_nonce, 'mlb_actors')) {
		return;
	}

	$actors = filter_input(INPUT_POST, 'actors', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);

	if (!empty($actors) && is_array($actors)) {
		$actors = array_map('absint', $actors);
		update_post_meta($post_id, 'actors', $actors);
	} else {
		delete_post_meta($post_id, 'actors');
	}
}

add_action('save_post_movie', 'mlb_save_actors');
