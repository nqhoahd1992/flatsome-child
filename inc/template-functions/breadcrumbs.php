<?php
function uni_add_breadcrumb() {
    flatsome_breadcrumb();
}
// add_action( 'flatsome_after_header_bottom','uni_add_breadcrumb' );
// add_action( 'flatsome_after_header_bottom','uni_add_breadcrumb' );
// add_action( 'flatsome_before_page','uni_add_breadcrumb' );

function uni_ux_builder_breadcrumb(){
    add_ux_builder_shortcode('uni_breadcrumb', array(
        'name'      => __('Uni - Breadcrumb','shtheme'),
        'category'  => __('Uni Creation','shtheme'),
        'options'   => array(
            'advanced_options' => require get_template_directory() . '/inc/builder/shortcodes/commons/advanced.php',
        ),
    ));
}
add_action('ux_builder_setup', 'uni_ux_builder_breadcrumb');

function shortcode_uni_breadcrumb($atts, $content = null) {

    extract(shortcode_atts(array(
        'class' => '',
        'visibility' => '',
    ), $atts));

    if($visibility == 'hidden') return;

    ob_start();

    // Add Button Classes.
    $classes   = array();
    $classes[] = 'uni_breadcrumb';
    if ( $class ) {
        $classes[] = $class;
    }
    if ( $visibility ) {
        $classes[] = $visibility;
    }
    $attributes['class'] = $classes;
    $attributes          = flatsome_html_atts( $attributes );

    echo '<div '. $attributes .'>';

    flatsome_breadcrumb();

    echo '</div>';

    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('uni_breadcrumb', 'shortcode_uni_breadcrumb');