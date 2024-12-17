<?php  
function shortcode_uni_wg_fb($atts, $content = null) {

    extract(shortcode_atts(array(
        'class' => '',
        'visibility' => '',
        'title'      => '',
        'tag_name'   => 'h4',
        'link'    	 => '',
        'include_root' => false,
    ), $atts));

    if($visibility == 'hidden') return;

    // Add Button Classes.
    $classes   = array();
    $classes[] = 'widget widget_fb';
    if ( $class ) {
        $classes[] = $class;
    }
    if ( $visibility ) {
        $classes[] = $visibility;
    }
    $attributes['class'] = $classes;
    $attributes          = flatsome_html_atts( $attributes );

    $content .= '<div '. $attributes .'>';
        
        if( $title ) $content .= '<'. $tag_name . ' class="widget-title"><span>'.$title.'</span></' . $tag_name .'>';

        if( $include_root ) {
            $content .= '<div id="fb-root"></div>';
        }

        $content .= '<script async defer crossorigin="anonymous" src="https://connect.facebook.net/'. __('en_US','shtheme') .'/sdk.js#xfbml=1&version=v11.0" nonce="CBYg7DQe"></script>';
        $content .= '<div class="fb-page" data-href="'. $link .'" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>';

    $content .= '</div>';

    return $content;
}

add_shortcode('uni_wg_fb', 'shortcode_uni_wg_fb');
