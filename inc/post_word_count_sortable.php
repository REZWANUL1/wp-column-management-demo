<?php
//? add  word count sortable 
add_filter('manage_edit-post_sortable_columns', 'code_column_sortable');
function code_column_sortable($columns)
{
   $columns['word_count'] = 'wordn';
   return $columns;
}
//? add meta to your post
function set_word_count_demo()
{
   $posts = get_posts(
      array(
         'posts_per_page' => -1,
         'post_type' => 'post'
      )
   );
   foreach ($posts as $p) {
      $content = $p->post_content;
      $wordn = str_word_count(strip_tags($content));
      update_post_meta($p->ID, 'wordn', $wordn);
   }
}
add_action('init', 'set_word_count_demo');
//? add sortable post word number functionality
add_action('pre_get_posts', 'code_demo_sort_column_data');
function code_demo_sort_column_data($wpquery)
{
   if (!is_admin()) {
      return;
   }
   $orderby = $wpquery->get('orderby');
   if ('wordn' == $orderby) {
      $wpquery->set('meta_key', 'wordn');
      $wpquery->set('orderby', 'meta_value_num');
   }
}
//? add change word count after save
add_action('save_post', 'update_word_count_sort_data');
function update_word_count_sort_data($post_id)
{
   $p = get_post($post_id);
   $content = $p->post_content;
   $wordn = str_word_count(strip_tags($content));
   update_post_meta($p->ID, 'wordn', $wordn);
}
