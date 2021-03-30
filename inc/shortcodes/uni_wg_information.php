<?php  
function shortcode_uni_wg_information($atts, $content = null) {

    extract(shortcode_atts(array(
        'class'      => '',
        'visibility' => '',
        'title'      => '',
        'tag_name'   => 'h4',
        'company'    => '',
        'address'    => '',  
        'tel'        => '',
        'hotline'    => '',
        'fax'        => '',
        'email'      => '',
        'website'    => '',
        'hide_label' => false,
        'hide_icon'  => false,
    ), $atts));
    
    if($visibility == 'hidden') return;

    // Add Button Classes.
    $classes   = array();
    $classes[] = 'widget widget_information';
    if ( $class ) {
        $classes[] = $class;
    }
    if ( $visibility ) {
        $classes[] = $visibility;
    }
    $attributes['class'] = $classes;
    $attributes          = flatsome_html_atts( $attributes );

    $hide_label = ( $hide_label == true ) ? 'hidden' : '';
    $hide_icon  = ( $hide_icon == true ) ? 'hidden_icon' : '';

    $content .= '<div '. $attributes .'>';
        
        if( $title ) $content .= '<'. $tag_name . ' class="widget-title"><span>'.$title.'</span></' . $tag_name .'>';

        $content .= '<ul>';
            if( $company ) {
                $content .= '<li class="label-company"><i class="fab fa-windows"></i>'. $company .'</li>';
            }
            if( $address ) {
                $content .= '<li class="'. $hide_icon .'"><i class="far fa-map-marker-alt"></i><span class="'. $hide_label .'">'. __( 'Address', 'shtheme' ) .':</span> '. $address .'</li>';
            }
            if( $tel ) {
                $content .= '<li class="'. $hide_icon .'"><i class="fas fa-phone-alt"></i><span class="'. $hide_label .'">'. __( 'Telephone', 'shtheme' ) .':</span> '. $tel .'</li>';
            }
            if( $hotline ) {
                $content .= '<li class="'. $hide_icon .'"><i class="far fa-mobile-alt"></i><span class="'. $hide_label .'">'. __( 'Hotline', 'shtheme' ) .':</span> '. $hotline .'</li>';
            }
            if( $fax ) {
                $content .= '<li class="'. $hide_icon .'"><i class="far fa-fax"></i><span class="'. $hide_label .'">'. __( 'Fax', 'shtheme' ) .':</span> '. $fax .'</li>';
            }
            if( $email ) {
                $content .= '<li class="'. $hide_icon .'"><i class="far fa-envelope"></i><span class="'. $hide_label .'">'. __( 'Email', 'shtheme' ) .':</span> '. $email .'</li>';
            }
            if( $website ) {
                $content .= '<li class="'. $hide_icon .'"><i class="far fa-globe"></i><span class="'. $hide_label .'">'. __( 'Website', 'shtheme' ) .':</span> '. $website .'</li>';
            }
        $content .= '</ul>';

    $content .= '</div>';

    return $content;
}

add_shortcode('uni_wg_information', 'shortcode_uni_wg_information');
