<?php
function bbwp_add_metabox_script()
{
  $handle     = 'metabox-script';
  $src        = get_template_directory_uri() . '/scripts.js';
  $deps       = array( 'jquery' );
  $ver        = false;
  $in_footer  = true;

  echo('<script>console.log("- DEBUG -");</script>');
  echo('<script>console.log("'.$src.'");</script>');

  wp_register_script( $handle, $src, $deps, $ver, $in_footer );
  wp_enqueue_script( $handle );
}
add_action( 'admin_enqueue_scripts', 'bbwp_add_metabox_script' );
?>
