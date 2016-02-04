$(document).ready(function() {
    $('.color-field').change(function() {
      $id  = '#'.concat($(this).attr('id').replace('-value',''));
      $val = $(this).val();
      $( $id ).val( $val );
    });
    $('.field-disabled').keypress(function() {
      return false;
    });
    $('.field-cleaner').click(function() {
      $id  = '#'.concat($(this).attr('id').replace('-cleaner',''));
      $val = '';
      $( $id ).val( $val );
    });
    $('.radio-clean').click(function() {
      $name  = $(this).attr('id').replace('-radio-clean','');
      $("input:radio[name='"+$name+"']").each(function(i) {
        this.checked = false;
      });
      return false;
    });
    $( '.switch' ).change(function() {
      $element  = '.'.concat($(this).attr('id'));
      if($(this).is(":checked")) {
        $( $element ).show();
      } else {
        $( $element ).hide();
      }
    });
});
