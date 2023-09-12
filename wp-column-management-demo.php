<?php
/*
 * Plugin Name:       wp-column-management-demo
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Rezwanul Haque
 */

if (!defined('ABSPATH')) {
   exit;
}

add_filter('manage_posts_columns', 'wp_column_posts');
function wp_column_posts($columns)
{
   print_r($columns);
   unset($columns['tags']);
   unset($columns['author']);
   $columns['tags'] = 'Tags';
   $columns['author'] = 'Author';
   $columns['id'] = __('Post Id', 'cd');
   return $columns;
}
add_action('manage_posts_custom_column', 'wp_column_posts_data', 10, 2);

function wp_column_posts_data($column, $post_id)
{
   echo $post_id;
}
