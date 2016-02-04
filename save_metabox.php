<?php
function bbwp_save_custom_fields( $post_id, $post ){
  // Comprobamos los permisos de escritura sobre el post que se esta guardando
  if ( 'post' == $post->post_type || ! current_user_can( 'edit_post', $post_id ) ) {
    return;
  }

  // Comprobamos el nonce como medida de seguridad
  if ( !isset( $_POST['bbwp_meta_box_noncename'] ) || ! wp_verify_nonce( $_POST['bbwp_meta_box_noncename'], 'bbwp_meta_box' ) ) {
    return;
  }

  // Obtenemos la información del metabox que se ha generado
  $meta_boxes = bbwp_create_meta_boxes();

  // Recorremos lo metabox generados
  foreach ($meta_boxes as $meta_box) {
    // Recorremos los campos para imprimir por pantalla
    foreach ($meta_box['callback_args'] as $field) {
      switch ( $field['type'] ) {
        // IMPUT TEXT
        case 'text':
        // IMPUT NUMBER
        case 'number':
        // TEXTAREA
        case 'textarea':
          if( isset( $field['key'] ) &&  $field['key']  != "" ) {
            update_post_meta( $post_id, $field['key'], sanitize_text_field( $_POST[$field['key']] ) );
          } else {
            if ( isset( $post_id ) ) {
              delete_post_meta($post_id, $field['key']);
            }
          }
          break;
        // WYSIWYG EDITOR
        case 'wysiwyg':
        // HTML TEXTAREA
        case 'html':
        // COLOR
        case 'color':
          if( isset( $field['key'] ) &&  $field['key']  != "" ) {
            update_post_meta( $post_id, $field['key'], $_POST[$field['key']] );
          } else {
            if ( isset( $post_id ) ) {
              delete_post_meta($post_id, $field['key']);
            }
          }
          break;
        // SELECT
        case 'select':
        // RADIO BUTTON
        case 'radio':
        // INLINE RADIO BUTTON
        case 'short-radio':
          if( isset( $field['key'] ) &&  $field['key']  != "" ) {
            update_post_meta( $post_id, $field['key'], $_POST[$field['key']] );
          } else {
            if ( isset( $post_id ) ) {
              delete_post_meta($post_id, $field['key']);
            }
          }
          break;
        // CHECKBOX
        case 'checkbox':
        // INLINE CHECKBOX
        case 'short-checkbox':
        // SWITCH CHECKBOX
        case 'switch':
          foreach ($field['values'] as $value){
            $chk_key = $field['key'].'-'.str_replace(' ', '-', strtolower($value));
            if( isset( $chk_key ) &&  $chk_key  != "" ) {
              update_post_meta( $post_id, $chk_key, $_POST[$chk_key] );
            } else {
              if ( isset( $post_id ) ) {
                delete_post_meta($post_id, $chk_key);
              }
            }
          }
          break;
      }
    }
  }
}
?>
