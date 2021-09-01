<?php  
function uni_ux_builder_title_products(){
    add_ux_builder_shortcode('uni_title_products', array(
        'name'      => __('Uni - Title Products','shtheme'),
        'category'  => __('Uni Creation - Woocommerce','shtheme'),
        'options'   => array(
            'id' => array(
                'type'          => 'select',
                'heading'       => 'Categories',
                'config'        => array(
                    'multiple'      => false,
                    'placeholder'   => 'Select...',
                    'termSelect'    => array(
                        // 'post_type'     => 'product_cat',
                        'taxonomies'    => 'product_cat'
                    )
                )
            ),
            'sub_ids' => array(
                'type'          => 'select',
                'heading'       => 'Sub Categories',
                'config'        => array(
                    'multiple'      => true,
                    'placeholder'   => 'Select...',
                    'termSelect'    => array(
                        // 'post_type'     => 'product_cat',
                        'taxonomies'    => 'product_cat'
                    )
                )
            ),
            'advanced_options' => require get_template_directory() . '/inc/builder/shortcodes/commons/advanced.php',
        ),
    ));
}
add_action('ux_builder_setup', 'uni_ux_builder_title_products');