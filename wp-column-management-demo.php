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

//? manage post column 
add_filter('manage_posts_columns', 'wp_column_posts');
function wp_column_posts($columns)
{
   // print_r($columns);
   // unset($columns['tags']);
   // unset($columns['author']);
   // $columns['tags'] = 'Tags';
   // $columns['author'] = 'Author';
   $columns['id'] = __('Post Id', 'cd');
   $columns['thumbnail'] = __('Post thumbnail', 'cd');
   $columns['word_count'] = __('Post word count', 'cd');
   return $columns;
}
add_action('manage_posts_custom_column', 'wp_column_posts_data', 10, 2);

function wp_column_posts_data($column, $post_id)
{
   if ($column == 'id') {
      esc_html_e($post_id);
   } elseif ($column == 'thumbnail') {
      $thumbnail = get_the_post_thumbnail_url($post_id, array(100, 100));
      if ($thumbnail) {
         echo '<img src="' . esc_url($thumbnail) . '" >';
      } else {
         echo 'No thumbnail available';
      }
   } elseif ($column == 'word_count') {
      // $_post = get_post($post_id);
      // $content = $_post->post_content;
      // $word_count = str_word_count(strip_tags($content));
      $word_count = get_post_meta($post_id, 'wordn', true);
      esc_html_e($word_count);
   }
}

require('inc/custom_sorting.php');
require('inc/post_word_count_sortable.php');
require('inc/page_column.php');
