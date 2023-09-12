<?php
add_action('restrict_manage_posts', 'column_custom_sorting');
function  column_custom_sorting()
{

   if (isset($_GET['post_type']) && $_GET['post_type'] != 'post') {

      return;
   }
   $filter_value = isset($_GET['DEMOFILTER']) ? $_GET['DEMOFILTER'] : '';
   $values = array(
      '0' => 'Select Status',
      '1' => 'Some post',
      '2' => 'Some other post'
   );
?>

 
      <?php

      echo '<select name="DEMOFILTER">';

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
   add_action('pre_get_posts', 'code_demo_filter_data');
   function code_demo_filter_data($wpquery)
   {
      if (!is_admin()) {
         return;
      }
      $filter_value = isset($_GET['DEMOFILTER']) ? $_GET['DEMOFILTER'] : '';
      if ('1' == $filter_value) {
         $wpquery->set('post__in', array(388, 466, 495));
      } elseif (
         '2' == $filter_value
      ) {
         $wpquery->set('post__in', array(461, 512));
      }
   }
      ?>