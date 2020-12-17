<?php  
function shortcode_uni_wg_information($atts, $content = null, $tag) {

    extract(shortcode_atts(array(
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
    
    ob_start();

    $html = '';
    $hide_label = ( $hide_label == true ) ? 'hidden' : '';
    $hide_icon  = ( $hide_icon == true ) ? 'hidden_icon' : '';

    $html .= '<div class="widget widget_information">';
        
        if( $title ) $html .= '<'. $tag_name . ' class="widget-title"><span>'.$title.'</span></' . $tag_name .'>';

        $html .= '<ul>';
            if( $company ) {
                $html .= '<li class="label-company"><i class="fab fa-windows"></i>'. $company .'</li>';
            }
            if( $address ) {
                $html .= '<li class="'. $hide_icon .'"><i class="far fa-map-marker-alt"></i><span class="'. $hide_label .'">'. __( 'Address', 'shtheme' ) .':</span> '. $address .'</li>';
            }
            if( $tel ) {
                $html .= '<li class="'. $hide_icon .'"><i class="fas fa-phone-alt"></i><span class="'. $hide_label .'">'. __( 'Telephone', 'shtheme' ) .':</span> '. $tel .'</li>';
            }
            if( $hotline ) {
                $html .= '<li class="'. $hide_icon .'"><i class="far fa-mobile-alt"></i><span class="'. $hide_label .'">'. __( 'Hotline', 'shtheme' ) .':</span> '. $hotline .'</li>';
            }
            if( $fax ) {
                $html .= '<li class="'. $hide_icon .'"><i class="far fa-fax"></i><span class="'. $hide_label .'">'. __( 'Fax', 'shtheme' ) .':</span> '. $fax .'</li>';
            }
            if( $email ) {
                $html .= '<li class="'. $hide_icon .'"><i class="far fa-envelope"></i><span class="'. $hide_label .'">'. __( 'Email', 'shtheme' ) .':</span> '. $email .'</li>';
            }
            if( $website ) {
                $html .= '<li class="'. $hide_icon .'"><i class="far fa-globe"></i><span class="'. $hide_label .'">'. __( 'Website', 'shtheme' ) .':</span> '. $website .'</li>';
            }
        $html .= '</ul>';

    $html .= '</div>';

    echo $html;

    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('uni_wg_information', 'shortcode_uni_wg_information');
