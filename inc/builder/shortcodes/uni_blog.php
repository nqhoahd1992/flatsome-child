<?php  
function uni_ux_builder_blog(){
    add_ux_builder_shortcode('uni_blog', array(
        'name'      => __('Uni - Blog','shtheme'),
        'category'  => __('Uni Creation','shtheme'),
        'options'   => array(
            'ids' => array(
                'type'          => 'select',
                'heading'       => 'Categories',
                'config'        => array(
                    'multiple'      => false,
                    'placeholder'   => 'Select...',
                    // 'postSelect' => array(
                    //     'post_type' => 'post',
                    // ),
                    'termSelect'    => array(
                        'taxonomies'    => 'category'
                    ),
                )
            ),
            'number' => array(
                'type' => 'slider',
                'heading' => __('Total posts','shtheme'),
                'default' => 10,
                'max' => 50,
                'min' => 1,
            ),
            'layout' => array(
                'type' => 'select',
                'heading' => __('Style','shtheme'),
                'default' => '1',
                'options' => array(
                    '1'     => __('Style 1','shtheme'),
                    '2'     => __('Style 2','shtheme'),
                    '3'     => __('Style 3','shtheme'),
                    '4'     => __('Style 4','shtheme'),
                    '5'     => __('Style 5','shtheme'),
                    '6'     => __('Style 6','shtheme'),
                    '7'     => __('Style 7','shtheme'),
                    '8'     => __('Style 8','shtheme'),
                )
            ),
            'hide_category' => array(
                'type' => 'radio-buttons',
                'heading' => __('Show categories','shtheme'),
                'default' => '0',
                'options' => array(
                    '0'  => array( 'title' => 'Off'),
                    '1'  => array( 'title' => 'On'),
                ),
            ),
            'btn_viewmore' => array(
                'type' => 'radio-buttons',
                'heading' => __('Show button viewmore','shtheme'),
                'default' => '0',
                'options' => array(
                    '0'  => array( 'title' => 'Off'),
                    '1'  => array( 'title' => 'On'),
                ),
            ),
            'viewmore_text' => array(
                'conditions' => 'btn_viewmore == "1"',
                'type' => 'textfield',
                'heading' => 'Text viewmore',
                'default' => __( 'Read more', 'shtheme' ),
            ),
            'hide_meta' => array(
                'type' => 'radio-buttons',
                'heading' => __('Show meta','shtheme'),
                'default' => '1',
                'options' => array(
                    '0'  => array( 'title' => 'Off'),
                    '1'  => array( 'title' => 'On'),
                ),
            ),
            'hide_thumb' => array(
                'type' => 'radio-buttons',
                'heading' => __('Show thumbnail','shtheme'),
                'default' => '1',
                'options' => array(
                    '0'  => array( 'title' => 'Off'),
                    '1'  => array( 'title' => 'On'),
                ),
            ),
            'hide_desc' => array(
                'type' => 'radio-buttons',
                'heading' => __('Show description','shtheme'),
                'default' => '1',
                'options' => array(
                    '0'  => array( 'title' => 'Off'),
                    '1'  => array( 'title' => 'On'),
                ),
            ),
            'number_character' => array(
                'conditions' => 'hide_desc == "1"',
                'type' => 'slider',
                'heading' => 'Excerpt Length',
                'default' => 200,
                'max' => 500,
                'min' => 10,
            ),
            'show_pagination' => array(
                'type' => 'radio-buttons',
                'heading' => __('Show pagination','shtheme'),
                'default' => '0',
                'options' => array(
                    '0'  => array( 'title' => 'Off'),
                    '1'  => array( 'title' => 'On'),
                ),
            ),
            'advanced_options' => require get_template_directory() . '/inc/builder/shortcodes/commons/advanced.php',
        ),
    ));
}
add_action('ux_builder_setup', 'uni_ux_builder_blog');