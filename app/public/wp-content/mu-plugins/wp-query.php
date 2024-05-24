<?php

/**
 * Wp_Query Demo
 */


add_action('template_redirect', function () {
    global $wp_query;

    // echo '<pre>';
    // print_r($wp_query->get_queried_object_id());
    // print_r($wp_query->get_queried_object());
    // echo '</pre>';
    // die;
});
