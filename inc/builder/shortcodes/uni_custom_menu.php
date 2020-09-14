<?php  
function uni_ux_builder_uni_custom_menu(){

    $options = array(
        '' => 'Select...',
    );
    // Get menus.
    $menus = wp_get_nav_menus();
    foreach ( $menus as $menu ) : 
        $options[$menu->term_id] = $menu->name;
    endforeach;

    add_ux_builder_shortcode('uni_custom_menu', array(
        'name'      => __('Uni Custom Menu','shtheme'),
        'category'  => __('Uni Creation','shtheme'),
        'options'   => array(
            'text' => array(
                'type'       => 'textfield',
                'heading'    => 'Title',
                'default'    => '',
                // 'auto_focus' => true,
            ),
            'tag_name' => array(
                'type'    => 'select',
                'heading' => 'Tag',
                'default' => 'h3',
                'options' => array(
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ),
            ),
            'nav_menu' => array(
                'type' => 'select',
                'heading' => 'Select Menu',
                'default' => '',
                'options' => $options,
            ),
        ),
    ));
}
add_action('ux_builder_setup', 'uni_ux_builder_uni_custom_menu');