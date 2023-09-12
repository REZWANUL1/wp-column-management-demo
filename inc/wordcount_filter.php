<?php
add_action('restrict_manage_posts', 'word_count_column_custom_sorting');
function  word_count_column_custom_sorting()
{

   if (isset($_GET['post_type']) && $_GET['post_type'] != 'post') {
      return;
   }
   $filter_value = isset($_GET['WORDCOUNT']) ? $_GET['WORDCOUNT'] : '';
   $values = array(
      '0' => 'Select word Status',
      '1' => 'Above 400 words',
      '2' => '200 To 400',
      '3' => 'Below 200'

   );
?>

 
      <?php

      echo '<select name="WORDCOUNT">';

      // Loop through the $values array to create <option> elements
      foreach ($values as $key => $value) {
         // Check if the current option should be selected
         // $selected = $key == $filter_value ? 'selected="selected"' : "";
         if ($key == $filter_value) {
            $selected = 'selected="selected"';
         } else {
            $selected = '';
         }

         printf('<option value="%s" %s>%s</option>', htmlspecialchars($key), $selected, htmlspecialchars($value));
      }


      echo '</select>';
   }
   add_action('pre_get_posts', 'word_count_code_demo_filter_data');
   function word_count_code_demo_filter_data($wpquery)
   {
      if (!is_admin()) {
         return;
      }
      $filter_value = isset($_GET['WORDCOUNT']) ? $_GET['WORDCOUNT'] : '';
      if ('1' == $filter_value) {
         $wpquery->set('meta_query', array(
            [
               'key' => 'wordn',
               'value' => 400,
               'compare' => '>=',
               'type' => 'NUMERIC'
            ]
         ));
      } elseif ('2' == $filter_value) {
         $wpquery->set('meta_query', array(
            [
               'key' => 'wordn',
               'value' => array(200, 400),
               'compare' => 'BETWEEN',
               'type'  => 'NUMERIC',
            ]
         ));
      } elseif ('3' == $filter_value) {
         $wpquery->set('meta_query', array(
            [
               'key' => 'wordn',
               'value' => 200,
               'compare' => '<=',
               'type' => 'NUMERIC'
            ]
         ));
      }
   }
      ?>