<?php
add_action('restrict_manage_posts', 'column_image_sorting');
function  column_image_sorting()
{

   if (isset($_GET['post_type']) && $_GET['post_type'] != 'post') {

      return;
   }
   $filter_value = isset($_GET['THFILTER']) ? $_GET['THFILTER'] : '';
   $values = array(
      '0' => 'Thumbnail Status',
      '1' => 'Has Thumbnail',
      '2' => 'No Thumbnail'
   );
?>

 
      <?php

      echo '<select name="THFILTER">';

      // Loop through the $values array to create <option> elements
      foreach ($values as $key => $value) {
         // Check if the current option should be selected
         // $selected = $key == $filter_value ? 'selected="selected"' : "";
         if ($key == $filter_value) {
            $selected = 'selected="selected"';
         } else {
            $selected = '';
         }
         // Use printf to generate the <option> element
         printf('<option value="%s" %s>%s</option>', htmlspecialchars($key), $selected, htmlspecialchars($value));
      }

      // Close the <select> element
      echo '</select>';
   }
   add_action('pre_get_posts', 'image_data_filter_data');
   function image_data_filter_data($wpquery)
   {
      if (!is_admin()) {
         return;
      }
      $filter_value = isset($_GET['THFILTER']) ? $_GET['THFILTER'] : '';
      if ('1' == $filter_value) {
         $wpquery->set('meta_query', array(
            array(
               'key' => '_thumbnail_id',
               'compare' => 'EXISTS',
            )
         ));
      } elseif ('2' == $filter_value) {
         $wpquery->set('meta_query', array(
            array(
               'key' => '_thumbnail_id',
               'compare' => 'NOT EXISTS',
            )
         ));
      }
   }
      ?>