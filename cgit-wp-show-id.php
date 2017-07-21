<?php

/*

Plugin Name: Castlegate IT WP Show ID
Plugin URI: http://github.com/castlegateit/cgit-wp-show-id
Description: Show post and page ID in WordPress admin panel.
Version: 1.1
Author: Castlegate IT
Author URI: http://www.castlegateit.co.uk/
License: MIT

*/

if (!defined('ABSPATH')) {
    wp_die('Access denied');
}

require_once __DIR__ . '/classes/autoload.php';

$plugin = new \Cgit\ShowPostId\Plugin();

do_action('cgit_show_id_loaded');
