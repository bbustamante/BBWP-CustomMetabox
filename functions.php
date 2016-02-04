<?php
  include (plugin_dir_path( __FILE__ ) . '/create_metabox.php');
  include (plugin_dir_path( __FILE__ ) . '/add_metabox.php');
  include (plugin_dir_path( __FILE__ ) . '/callback_metabox.php');
  include (plugin_dir_path( __FILE__ ) . '/save_metabox.php');
  include (plugin_dir_path( __FILE__ ) . '/add_scripts.php');

  add_action('add_meta_boxes_post', 'bbwp_add_meta_boxes');
  add_action('save_post', 'bbwp_save_custom_fields', 10, 2);
?>
