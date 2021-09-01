<?php  
function uni_ux_builder_product(){
    add_ux_builder_shortcode('uni_product', array(
        'name'      => __('Uni - Product','shtheme'),
        'category'  => __('Uni Creation - Woocommerce','shtheme'),
        'options'   => array(
            'cat' => array(
                'type'          => 'select',
                'heading'       => 'Categories',
                'config'        => array(
                    'multiple'      => false,
                    'placeholder'   => 'Select...',
                    'termSelect'    => array(
                        // 'post_type'     => 'product',
                        'taxonomies'    => 'product_cat'
                    )
                )
            ),
            'products' => array(
                'type' => 'slider',
                'heading' => __('Total posts','shtheme'),
                'default' => 15,
                'max' => 50,
                'min' => 5,
            ),
            'col_spacing' => array(
                'type' => 'select',
                'heading' => __('Column Spacing','shtheme'),
                'default' => 'normal',
                'options' => array(
                    'collapse' => 'Collapse',
                    'xsmall' => 'X Small',
                    'small' => 'Small',
                    'normal' => 'Normal',
                    'large' => 'Large',
                ),
            ),
            'columns' => array(
                'type' => 'slider',
                'heading' => __('Columns','shtheme'),
                'default' => '4',
                'responsive' => true,
                'max' => '8',
                'min' => '1',
            ),
            'layout_options' => array(
                'type' => 'group',
                'heading' => __( 'Layout' ),
                'options' => array(
                    'animate' => array(
                        'type' => 'select',
                        'heading' => __( 'Animate' ),
                        'default' => 'none',
                        'options' => require( get_template_directory() . '/inc/builder/shortcodes/values/animate.php' ),
                    ),
                ),
            ),
            'box_options' => array(
                'type'    => 'group',
                'heading' => __( 'Box' ),
                'options' => array(
                    'show_cat' => array(
                        'type'    => 'checkbox',
                        'heading' => __( 'Category' ),
                        'default' => 'true',
                    ),
                    'show_title' => array(
                        'type'    => 'checkbox',
                        'heading' => __( 'Title' ),
                        'default' => 'true',
                    ),
                    'show_rating' => array(
                        'type'    => 'checkbox',
                        'heading' => __( 'Rating' ),
                        'default' => 'true',
                    ),
                    'show_price' => array(
                        'type'    => 'checkbox',
                        'heading' => __( 'Price' ),
                        'default' => 'true',
                    ),
                    'show_add_to_cart' => array(
                        'type'    => 'checkbox',
                        'heading' => __( 'Add To Cart' ),
                        'default' => 'true',
                    ),
                    'show_quick_view' => array(
                        'type'    => 'checkbox',
                        'heading' => __( 'Quick View' ),
                        'default' => 'true',
                    ),
                    'equalize_box' => array(
                        'type'    => 'checkbox',
                        'heading' => __( 'Equalize Items' ),
                        'default' => 'false',
                    ),
                ),
            ),
            'filter_posts' => array(
                'type' => 'group',
                'heading' => __( 'Filter Posts' ),
                // 'conditions' => 'ids === ""',
                'options' => array(
                     'orderby' => array(
                        'type' => 'select',
                        'heading' => __( 'Order By' ),
                        'default' => 'normal',
                        'options' => array(
                            'normal' => 'Normal',
                            'title' => 'Title',
                            'sales' => 'Sales',
                            'rand' => 'Random',
                            'date' => 'Date'
                        )
                    ),
                    'order' => array(
                        'type' => 'select',
                        'heading' => __( 'Order' ),
                        'default' => 'desc',
                        'options' => array(
                            'asc' => 'ASC',
                            'desc' => 'DESC',
                        )
                    ),
                    'show' => array(
                        'type' => 'select',
                        'heading' => __( 'Show' ),
                        'default' => '',
                        'options' => array(
                            '' => 'All',
                            'featured' => 'Featured',
                            'onsale' => 'On Sale',
                        )
                    ),
                     'out_of_stock' => array(
                         'type'    => 'select',
                         'heading' => __( 'Out Of Stock' ),
                         'default' => '',
                         'options' => array(
                             ''        => 'Include',
                             'exclude' => 'Exclude',
                         ),
                     ),
                )
            ),
            'advanced_options' => require get_template_directory() . '/inc/builder/shortcodes/commons/advanced.php',
        ),
    ));
}
add_action('ux_builder_setup', 'uni_ux_builder_product');