<?php  
function shortcode_uni_custom_menu($atts, $content = null) {

    extract(shortcode_atts(array(
        'class' => '',
        'visibility' => '',
        'title' => '',
        'tag_name' => 'h4',
        'nav_menu' => '',
    ), $atts));
    
    if($visibility == 'hidden') return;

    ob_start();

    // Add Button Classes.
    $classes   = array();
    $classes[] = 'uni_custom_menu';
    if ( $class ) {
        $classes[] = $class;
    }
    if ( $visibility ) {
        $classes[] = $visibility;
    }
    $attributes['class'] = $classes;
    $attributes          = flatsome_html_atts( $attributes );

    echo '<div '. $attributes .'>';
    if( $title ) echo '<'. $tag_name . ' class="widget-title"><span>'.$title.'</span></' . $tag_name .'>';

    // Get menu.
    $nav_menu = ! empty( $nav_menu ) ? wp_get_nav_menu_object( $nav_menu ) : false;

    if ( ! empty( $nav_menu ) ) {
        $format = current_theme_supports( 'html5', 'navigation-widgets' ) ? 'html5' : 'xhtml';

        /**
         * Filters the HTML format of widgets with navigation links.
         *
         * @since 5.5.0
         *
         * @param string $format The type of markup to use in widgets with navigation links.
         *                       Accepts 'html5', 'xhtml'.
         */
        $format = apply_filters( 'navigation_widgets_format', $format );

        if ( 'html5' === $format ) {
            // The title may be filtered: Strip out HTML and make sure the aria-label is never empty.
            $title      = trim( strip_tags( $title ) );
            $aria_label = $title ? $title : $default_title;

            $nav_menu_args = array(
                'fallback_cb'          => '',
                'menu'                 => $nav_menu,
                'container'            => 'nav',
                'container_aria_label' => $aria_label,
                'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            );
        } else {
            $nav_menu_args = array(
                'fallback_cb' => '',
                'menu'        => $nav_menu,
            );
        }
        wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu ) );
    }
    echo '</div>';

    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('uni_custom_menu', 'shortcode_uni_custom_menu');
