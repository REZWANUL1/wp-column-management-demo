<?php

//? manage page column 
add_filter('manage_pages_columns', 'wp_column_pages');
function wp_column_pages($columns)
{
   // print_r($columns);
   // unset($columns['tags']);
   // unset($columns['author']);
   // $columns['tags'] = 'Tags';
   // $columns['author'] = 'Author';
   $columns['id'] = __('Page Id', 'cd');
   $columns['thumbnail'] = __('Page thumbnail', 'cd');
   return $columns;
}
add_action('manage_pages_custom_column', 'wp_column_pages_data', 10, 2);
function wp_column_pages_data($column, $post_id)
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
   }
}



?>