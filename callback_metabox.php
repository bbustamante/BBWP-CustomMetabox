<?php
function bbwp_meta_box_callback( $post, $args = array() ) {
  // El nonce es opcional pero recomendable. Vea http://codex.wordpress.org/Function_Reference/wp_nonce_field
  wp_nonce_field( 'bbwp_meta_box', 'bbwp_meta_box_noncename' );

  // Obtenermos los meta data actuales para rellenar los custom fields
  // en caso de que ya tenga valores
  $post_meta = get_post_custom($post->ID);

  // Recorremos los campos para imprimir por pantalla
  foreach ($args['args'] as $field){
    $current_value = '';

    if( isset( $post_meta[$field['key']][0] ) ) {
      $current_value = trim($post_meta[$field['key']][0]);
    }

    echo  '<p>';
      if($field['title']!=''){
        echo  '<label class="label" for="' . $field['key'] . '"><strong>' . $field['title'] . '</strong></label><br />';
      }

    switch ( $field['type'] ){
      case 'separator':
        echo '<hr />';
        break;
      case 'column':
        if($field['settings']['close']){
          echo '</div>';
        }
        if($field['settings']['action'] == 'left'){
          echo '<div style="width:49%;float:left;">';
        }
        if($field['settings']['action'] == 'right'){
          echo '<div style="width:49%;float:right;">';
        }
        if($field['settings']['action'] == 'clear'){
          echo '<div style="clear:both;"></div>';
        }
        break;
      // WYSIWYG EDITOR
      case 'wysiwyg':
        echo  '</p>';
              //Create The Editor
              wp_editor($current_value, $field['key'], $field['settings']);
        break;
      // IMAGE FIELD
      case 'image':
      // GALLERY FIELD
      case 'gallery':
        echo  '</p>';
        break;
      // IMPUT TEXT
      case 'text':
        echo  '<input  type="text"
                        id="' . $field['key'] . '"
                        name="' . $field['key'] . '"
                        style="width:100%;"
                        value="' . $current_value . '">
              </p>';
        break;
        // IMPUT NUMBER
        case 'number':
          echo  '<input  type="text"
                          id="' . $field['key'] . '"
                          name="' . $field['key'] . '"
                          pattern="^-?\d+(,\d+)*(\.\d+(e\d+)?)?$"
                          style="width:100%;"
                          value="' . $current_value . '">
                </p>';
          break;
        // TEXTAREA
        case 'textarea':
        // HTML TEXTAREA
        case 'html':
          echo  '<textarea   id="' . $field['key'] . '"
                              name="' . $field['key'] . '"
                              style="width:100%;">' .
                    $current_value .
                  '</textarea>
                </p>';
          break;
        case 'select':
          echo  '<select name="' . $field['key'] . '" id="' . $field['key'] . '" style="width:100%;">';
          foreach ($field['values'] as $value){
                      echo'<option value="' . $value . '"' . selected( $current_value, $value) . '>
                        ' . $value . '
                      </option>';
          }
          echo     '</select>
                  </p>';
          break;
        // RADIO BUTTON
        case 'radio':
          foreach ($field['values'] as $value){
            echo '<input  type="radio"
                          id="' . $field['key'].'-' . $value . '"
                          name="' . $field['key'].'"
                          value="' . $value . '"';

            checked( $current_value, $value );

          echo  '>
                <label class="label" for="' . $field['key'].'-' . $value . '">' . $value . '</label><br>';
          }
          echo  '</p>';

          echo  '<p style="padding-left:10px">
                  <a  href="#"
                      id="' . $field['key'].'-radio-clean"
                      class="radio-clean">Borrar</a>
                </p>';
          break;
        // INLINE RADIO BUTTON
        case 'short-radio':
          foreach ($field['values'] as $value){
            echo '<input  type="radio"
                          id="' . $field['key'].'-' . $value . '"
                          name="' . $field['key'].'"
                          value="' . $value . '"';

            checked( $current_value, $value );

          echo  '>
                <label class="label" for="' . $field['key'].'-' . $value . '">' . $value . '</label>|';
          }
          echo  '</p>';

          echo  '<p style="padding-left:10px">
                  <a  href="#"
                      id="' . $field['key'].'-radio-clean"
                      class="radio-clean">Borrar</a>
                </p>';
          break;
        // CHECKBOX
        case 'checkbox':
          foreach ($field['values'] as $value){
            $chk_key = $field['key'].'-'.str_replace(' ', '-', strtolower($value));
            $current_value = trim($post_meta[$chk_key][0]);
            echo '<input  type="checkbox"
                          id="' . $chk_key . '"
                          name="' . $chk_key .'"
                          value="' . $value . '"';

            checked( $current_value, $value );

            echo '>
                  <label class="label" for="' . $chk_key . '">' . $value . '</label><br>';
          }
          echo  '</p>';
          break;
        // INLINE CHECKBOX
        case 'short-checkbox':
          foreach ($field['values'] as $value){
            $chk_key = $field['key'].'-'.str_replace(' ', '-', strtolower($value));
            $current_value = trim($post_meta[$chk_key][0]);
            echo '<input  type="checkbox"
                          id="' . $chk_key . '"
                          name="' . $chk_key .'"
                          value="' . $value . '"';

            checked( $current_value, $value );

            echo '>
                  <label class="label" for="' . $chk_key . '">' . $value . '</label>|';
          }
          echo  '</p>';
          break;
        // SWITCH CHECKBOX
        case 'switch':
          foreach ($field['values'] as $value){
            $chk_key = $field['key'].'-'.str_replace(' ', '-', strtolower($value));
            $current_value = trim($post_meta[$chk_key][0]);
            echo '<input  type="checkbox"
                          id="' . $chk_key . '"
                          name="' . $chk_key .'"
                          class="switch"
                          value="' . $value . '"';

            checked( $current_value, $value );

            echo '>
                  <label class="label" for="' . $chk_key . '">' . $value . '</label><br>';
          }
          echo  '</p>';

          echo '<div class="' . $chk_key . '"';
            if ($current_value != $value) {
              echo 'style="display:none;"';
            }
          echo '>';
          break;
        case 'switch-end':
          echo '<hr />';
          echo '</div>';
          break;
        // COLOR
        case 'color':
          echo  '<input  type="color"
                          id="' . $field['key'] . '-value"
                          name="' . $field['key'] . '-value"
                          class="color-field"
                          value="' . ($current_value!=''?$current_value:'#FFFFFF') . '">
                  <input  type="text"
                          id="' . $field['key'] . '"
                          name="' . $field['key'] . '"
                          value="' . $current_value . '"
                          class="field-disabled"
                          >';
          $src = get_template_directory_uri() . '/ico/' . 'cross.png';
          echo  ' <img    src="'.$src.'"
                          id="' . $field['key'] . '-cleaner"
                          name="' . $field['key'] . '-cleaner"
                          class="field-cleaner" />
                </p>';
          break;
    }
    if($field['desc']!=''){
      echo '<p><em class="text-muted">* ' . $field['desc'] . '</em></p>';
    }
  }
}
?>
