<?php
function bbwp_create_meta_boxes() {
  /*
   *  --------------------------------------------------
   *    FIELD TYPES
   *  --------------------------------------------------
   *    text
   *      -> Create an input text file. Not HTML suport.
   *    number
   *      -> Create an only numbers input text file. Not HTML suport.
   *    textarea
   *      -> Create a textarea field. Not HTML suport.
   *    html
   *      -> Create a textarea field. Whith HTML suport.
   *    wysiwyg
   *      -> Create a wysiwyg field.
   *    image
   *      -> NOT WORKING YET.
   *    gallery
   *      -> NOT WORKING YET.
   *    select
   *      -> Create a dropdown slector field.
   *    radio
   *      -> Crete a multioption one selectio field.
   *    short-radio
   *      -> Same as radio but inline.
   *    checkbox
   *      -> Crete a multioption selectio field.
   *    switch
   *      -> A one element checkbox whitch active/deactivate extra options.
   *          * Must be closed whith switch-end.
   *    color
   *      -> Crete color picker field.
   *  --------------------------------------------------
   *    SHAPE ELEMENTS
   *  --------------------------------------------------
   *    column
   *      -> Create a floating div.
   *          * Need to bee closed.
   *          * Clear column must be created.
   *    separator
   *      -> Print an hr separator.
   */
   $meta_boxes = [
     [
       'id'              => 'bbwp-google-map-meta-box',
       'title'           => __('Google Map'),
       'callback'        => 'bbwp_meta_box_callback',
       'screen'          => 'post',
       'context'         => 'side',
       'priority'        => 'low',
       'callback_args'   => [
                               [
                                 'type'      => 'text',
                                 'key'       => 'bbwp-gmap-address',
                                 'title'     => 'Address',
                               ],
                               [
                                 'type'      => 'html',
                                 'key'       => 'bbwp-gmap-frame',
                                 'title'     => 'Insert map',
                                 'desc'      => 'Copy the Google Maps iframe code',
                               ],
                             ],
     ],
     [
      'id'              => 'bbwp-sale-meta-box',
      'title'           => __('Condiciones de la casa'),
      'callback'        => 'bbwp_meta_box_callback',
      'screen'          => 'post',
      'context'         => 'side',
      'priority'        => 'core',
      'callback_args'   => [
                              [
                                'type'      => 'switch',
                                'key'       => 'bbwp-product-sale',
                                'values'    => ['Sale'],
                              ],
                              [
                                'type'      => 'number',
                                'key'       => 'bbwp-product-sale-price',
                                'title'     => 'Product price',
                              ],
                              [
                                'type'      => 'select',
                                'key'       => 'bbwp-product-sale-availability',
                                'title'     => 'Availability',
                                'values'    => ['Available', 'Sold', 'Consult availability'],
                              ],
                              [
                                'type'      => 'wysiwyg',
                                'settings'  =>  [
                                                  'quicktags' => false,
                                                ],
                                'key'       => 'bbwp-product-sale-info',
                                'title'     => 'Product extra info',
                              ],
                              [
                                'type'      => 'switch-end',
                              ],
                            ],
    ],
  ];

  return $meta_boxes;
}
?>
