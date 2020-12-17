<?php  
function shortcode_uni_wg_fb($atts, $content = null, $tag) {

    extract(shortcode_atts(array(
        'title'      => '',
        'tag_name'   => 'h4',
        'link'    	 => '',
        'include_root' => false,
    ), $atts));
    
    ob_start();

    $html = '';

    $html .= '<div class="widget widget_fb">';
        
        if( $title ) $html .= '<'. $tag_name . ' class="widget-title"><span>'.$title.'</span></' . $tag_name .'>';

        if( $include_root ) {
            $html .= '<div id="fb-root"></div>';
            $html .= 'abc';
        }

        $html .= '<script async defer crossorigin="anonymous" src="https://connect.facebook.net/'. __('en_US','shtheme') .'/sdk.js#xfbml=1&version=v9.0" nonce="hZjUcokj"></script>';
        $html .= '<div class="fb-page" data-href="'. $link .'" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>';

    $html .= '</div>';

    echo $html;

    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('uni_wg_fb', 'shortcode_uni_wg_fb');
