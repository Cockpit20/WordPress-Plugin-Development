<?php
/*
 * Plugin Name:       Movie  Library
 * Plugin URI:        https://learn.rtcamp.com
 * Description:       This plugin provides features to create movie library
 * Version:           1.0.0
 * Requires at least: 5.0
 * Requires PHP:      7.2
 * Author:            Soumyadeep Chandra
 * Author URI:        https://learn.rtcamp.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://learn.rtcamp.com
 * Text Domain:       movie-library
 * Domain Path:       /languages
 */

require_once __DIR__ . '/post-types/movie.php';
require_once __DIR__ . '/taxonomies/genre.php';
require_once __DIR__ . '/post-types/person.php';
require_once __DIR__ . '/taxonomies/career.php';

function mlb_activation()
{
    // Add functionality to run on plugin activation.
    movie_init();
    genre_init();
    person_init();
    career_init();
    flush_rewrite_rules();
}

register_activation_hook(
    __FILE__,
    'mlb_activation'
);

function mlb_deactivation()
{
    // Add functionality to run on plugin deactivation.
}

register_deactivation_hook(
    __FILE__,
    'mlb_deactivation'
);
