<?php

/*

Plugin Name: Castlegate IT WP Show ID
Plugin URI: http://github.com/castlegateit/cgit-wp-show-id
Description: Show post and page ID in WordPress admin panel.
Version: 1.0
Author: Castlegate IT
Author URI: http://www.castlegateit.co.uk/
License: MIT

*/

/**
 * Register ID column
 *
 * The column should only be visible to admin users. If the cgit_is_admin()
 * function is available from the Admin Tweaks plugin, this will be used to
 * determine whether the current user is an admin.
 */
function cgit_wp_show_id_register_column($columns) {

    $is_admin = current_user_can('manage_options');

    if (function_exists('cgit_is_admin')) {
        $is_admin = cgit_is_admin();
    }

    if ($is_admin) {
        return array_merge($columns, array('id' => 'ID'));
    }

    return $columns;

}

/**
 * Function to display the post ID
 */
function cgit_wp_show_id_column($name) {

    global $post;

    if ($name == 'id') {
        echo $post->ID;
    }

}

/**
 * Set width of custom column
 */
function cgit_wp_show_id_css() {
    echo '<style> .column-id { width: 5%; } </style>';
}

/**
 * Add column
 *
 * You can also use the manage_{$post_type}_posts_columns filter for custom post
 * types.
 */
add_filter('manage_posts_columns', 'cgit_wp_show_id_register_column');
add_filter('manage_pages_columns', 'cgit_wp_show_id_register_column');

/**
 * Make column sortable
 *
 * You can also use the manage_edit-{$post_type}_sortable_columns filter for
 * custom post types.
 */
add_filter('manage_edit-post_sortable_columns', 'cgit_wp_show_id_register_column');
add_filter('manage_edit-page_sortable_columns', 'cgit_wp_show_id_register_column');

/**
 * Add column data
 *
 * You can also use the manage_{$post_type}_posts_custom_column filter for
 * custom post types.
 */
add_action('manage_posts_custom_column', 'cgit_wp_show_id_column');
add_action('manage_pages_custom_column', 'cgit_wp_show_id_column');

/**
 * Add custom column CSS
 */
add_action('admin_head', 'cgit_wp_show_id_css');
