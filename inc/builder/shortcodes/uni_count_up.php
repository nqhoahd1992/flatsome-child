<?php  
function uni_ux_builder_count_up(){
    add_ux_builder_shortcode('uni_count_up', array(
        'name'      => __('Uni - Count Up','shtheme'),
        'category'  => __('Uni Creation','shtheme'),
        'options'   => array(
            'title' => array(
                'type'       => 'textfield',
                'heading'    => __( 'Title', 'shtheme' ),
                'default'    => '',
                // 'auto_focus' => true,
            ),
            'number' => array(
                'type'       => 'textfield',
                'heading'    => __( 'Number', 'shtheme' ),
                'default'    => '',
            ),
            'advanced_options' => require get_template_directory() . '/inc/builder/shortcodes/commons/advanced.php',
        ),
    ));
}
add_action('ux_builder_setup', 'uni_ux_builder_count_up');