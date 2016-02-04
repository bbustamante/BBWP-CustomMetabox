<?php
function bbwp_add_meta_boxes() {
  $meta_boxes = bbwp_create_meta_boxes();

  foreach ($meta_boxes as $meta_box){
    add_meta_box(
      $meta_box['id'],
      $meta_box['title'],
      $meta_box['callback'],
      $meta_box['screen'],
      $meta_box['context'],
      $meta_box['priority'],
      $meta_box['callback_args']
    );
  }
}
?>
