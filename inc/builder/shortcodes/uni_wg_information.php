<?php  
function uni_ux_builder_wg_information(){
    add_ux_builder_shortcode('uni_wg_information', array(
        'name'      => __('Uni - Information contact','shtheme'),
        'category'  => __('Uni Creation','shtheme'),
        'options'   => array(
            'title' => array(
                'type'       => 'textfield',
                'heading'    => __( 'Title', 'shtheme' ),
                'default'    => '',
                // 'auto_focus' => true,
            ),
            'tag_name' => array(
                'type'    => 'select',
                'heading' => 'Tag',
                'default' => 'h4',
                'options' => array(
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ),
            ),
            'company' => array(
                'type'       => 'textfield',
                'heading'    => __( 'Company', 'shtheme' ),
                'default'    => '',
            ),
            'address' => array(
                'type'       => 'textfield',
                'heading'    => __( 'Address', 'shtheme' ),
                'default'    => '',
            ),
            'tel' => array(
                'type'       => 'textfield',
                'heading'    => __( 'Telephone', 'shtheme' ),
                'default'    => '',
            ),
            'hotline' => array(
                'type'       => 'textfield',
                'heading'    => __( 'Hotline', 'shtheme' ),
                'default'    => '',
            ),
            'fax' => array(
                'type'       => 'textfield',
                'heading'    => __( 'Fax', 'shtheme' ),
                'default'    => '',
            ),
            'email' => array(
                'type'       => 'textfield',
                'heading'    => __( 'Email', 'shtheme' ),
                'default'    => '',
            ),
            'website' => array(
                'type'       => 'textfield',
                'heading'    => __( 'Website', 'shtheme' ),
                'default'    => '',
            ),
            'style_options' => array(
                'type'    => 'group',
                'heading' => __( 'Advanced', 'shtheme' ),
                'options' => array(
                    'hide_label' => array(
                        'type'    => 'checkbox',
                        'heading' => __( 'Hide label', 'shtheme' ),
                        'default' => 'false',
                    ),
                    'hide_icon' => array(
                        'type'    => 'checkbox',
                        'heading' => __( 'Hide icon', 'shtheme' ),
                        'default' => 'false',
                    ),
                ),
            ),
            'advanced_options' => require get_template_directory() . '/inc/builder/shortcodes/commons/advanced.php',
        ),
    ));
}
add_action('ux_builder_setup', 'uni_ux_builder_wg_information');