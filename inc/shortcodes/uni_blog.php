<?php  
function shortcode_uni_blog($atts, $content = null) {

    extract(shortcode_atts(array(
        'class' => '',
        'visibility' => '',
        'ids'           => '',
        'number'   	    => '10',
        'layout'	    => '1',
        'viewmore_text' => __( 'Read more', 'shtheme' ),
        'hide_category' => '0',
        'btn_viewmore'  => '0',
        'hide_meta'     => '1',
        'hide_thumb'    => '1',
        'hide_desc'     => '1',
        'number_character' => '200',
    ), $atts));

    if($visibility == 'hidden') return;

    // Add Button Classes.
    $classes   = array();
    $classes[] = 'uni_blog';
    if ( $class ) {
        $classes[] = $class;
    }
    if ( $visibility ) {
        $classes[] = $visibility;
    }
    $attributes['class'] = $classes;
    $attributes          = flatsome_html_atts( $attributes );

    $content .= '<div '. $attributes .'>';

    // $array_ids = explode(',', $ids);
    
    // foreach ($array_ids as $key => $idpost) {
		// $content .= '<h2 class="heading"><a title="'. get_cat_name( $idpost ) .'" href="'. get_category_link( $idpost ) .'">'. get_cat_name( $idpost ) .'</a></h2>';
		$content .= do_shortcode('[uniblog posts_per_page="' . $number . '" categories="' . $ids . '" style="' . $layout . '" viewmore_text="'. $viewmore_text .'" hide_category="'. $hide_category .'" btn_viewmore="'. $btn_viewmore .'" hide_meta="'. $hide_meta .'" hide_thumb="'. $hide_thumb .'" hide_desc="'. $hide_desc .'" number_character="'. $number_character .'"]');
	// }

    $content .= '</div>';

    return $content;
}

add_shortcode('uni_blog', 'shortcode_uni_blog');
