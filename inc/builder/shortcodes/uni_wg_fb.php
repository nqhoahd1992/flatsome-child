<?php  
function uni_ux_builder_wg_fb(){
    add_ux_builder_shortcode('uni_wg_fb', array(
        'name'      => __('Uni - Fanpage Facebook','shtheme'),
        'category'  => __('Uni Creation','shtheme'),
        'options'   => array(
            'title' => array(
                'type'       => 'textfield',
                'heading'    => __( 'Title', 'shtheme' ),
                'default'    => '',
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
            'link' => array(
                'type'       => 'textfield',
                'heading'    => __( 'Link Fanpage', 'shtheme' ),
                'default'    => '',
                'auto_focus' => true,
            ),
            'style_options' => array(
                'type'    => 'group',
                'heading' => __( 'Advanced', 'shtheme' ),
                'options' => array(
                    'include_root' => array(
                        'type'    => 'checkbox',
                        'heading' => __( 'Include root', 'shtheme' ),
                        'default' => 'false',
                    ),
                ),
            ),
            'advanced_options' => require get_template_directory() . '/inc/builder/shortcodes/commons/advanced.php',
        ),
    ));
}
add_action('ux_builder_setup', 'uni_ux_builder_wg_fb');
