<?php  
function uni_ux_builder_wg_information(){
    add_ux_builder_shortcode('uni_wg_information', array(
        'name'      => __('Uni - Information contact','shtheme'),
        'category'  => __('Uni Creation','shtheme'),
        'options'   => array(
            'title' => array(
                'type'       => 'textfield',
                'heading'    => __( 'Title', 'shtheme' ),
                'default'    => __( 'Information contact', 'shtheme' ),
                'auto_focus' => true,
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
                'heading' => __( 'Style' ),
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
        ),
    ));
}
add_action('ux_builder_setup', 'uni_ux_builder_wg_information');