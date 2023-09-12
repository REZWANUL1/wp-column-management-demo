<?php
register_activation_hook(__FILE__, 'my_plugin_activation');
function my_plugin_activation()
{
   $notices = get_option('my_plugin_deferred_admin_notices', array());
   $notices[] = "My Plugin: Custom Activation Message";
   update_option('my_plugin_deferred_admin_notices', $notices);
}

add_action('admin_init', 'my_plugin_admin_init');
function my_plugin_admin_init()
{
   $current_version = 1;
   $version = get_option('my_plugin_version');
   if ($version != $current_version) {
      // Do whatever upgrades needed here.
      update_option('my_plugin_version', $current_version);
      $notices = get_option('my_plugin_deferred_admin_notices', array());
      $notices[] = "My Plugin: Upgraded version $version to $current_version.";
      update_option('my_plugin_deferred_admin_notices', $notices);
   }
}

add_action('admin_notices', 'my_plugin_admin_notices');
function my_plugin_admin_notices()
{
   if ($notices = get_option('my_plugin_deferred_admin_notices')) {
      foreach ($notices as $notice) {
         echo "<div class='updated'><p>$notice</p></div>";
      }
      delete_option('my_plugin_deferred_admin_notices');
   }
}

register_deactivation_hook(__FILE__, 'my_plugin_deactivation');
function my_plugin_deactivation()
{
   delete_option('my_plugin_version');
   delete_option('my_plugin_deferred_admin_notices');
}
