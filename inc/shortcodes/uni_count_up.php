<?php  
function shortcode_uni_count_up($atts, $content = null) {

    extract(shortcode_atts(array(
        'class'      => '',
        'visibility' => '',
        'title'      => '',
        'number'     => '',
    ), $atts));
    
    if($visibility == 'hidden') return;

    // Add Button Classes.
    $classes   = array();
    $classes[] = 'uni_count_up';
    if ( $class ) {
        $classes[] = $class;
    }
    if ( $visibility ) {
        $classes[] = $visibility;
    }
    $attributes['class'] = $classes;
    $attributes          = flatsome_html_atts( $attributes );

    $content .= '<div '. $attributes .'>';
        
        if( $title ) $content .= '<div class="uni_count_up__title">'.$title.'</div>';
        if( $number ) $content .= '<span class="count-up">'.$number.'</span>';

    $content .= '</div>';

    return $content;
}

add_shortcode('uni_count_up', 'shortcode_uni_count_up');
