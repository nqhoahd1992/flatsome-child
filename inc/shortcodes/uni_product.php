<?php  
function shortcode_uni_product($atts, $content = null) {

    extract(shortcode_atts(array(
        'class' => '',
        'visibility' => '',
        'col_spacing'   => 'normal',
        'columns'	    => '4',
        'cat'           => '',
        'products'      => '15',
        // Layout
        'equalize_box' => 'false',
        // Posts Woo
        'orderby' => '', // normal, sales, rand, date
        'order' => '',
        'tags' => '',
        'show' => '', //featured, onsale
        'out_of_stock' => '', // exclude.
        // Box styles
        'animate' => '',
        // 'text_pos' => 'bottom',
        // 'text_padding' => '',
        // 'text_bg' => '',
        // 'text_color' => '',
        // 'text_hover' => '',
        // 'text_align' => 'center',
        // 'text_size' => '',
        // 'image_size' => '',
        // 'image_radius' => '',
        // 'image_width' => '',
        // 'image_height' => '',
        // 'image_hover' => '',
        // 'image_hover_alt' => '',
        // 'image_overlay' => '',
        'show_cat' => 'false',
        'show_title' => 'true',
        'show_rating' => 'true',
        'show_price' => 'true',
        'show_add_to_cart' => 'true',
        'show_quick_view' => 'true',
    ), $atts));

    if($visibility == 'hidden') return;

    // Add Button Classes.
    $classes   = array();
    $classes[] = 'uni_product';
    if ( $class ) {
        $classes[] = $class;
    }
    if ( $visibility ) {
        $classes[] = $visibility;
    }
    $attributes['class'] = $classes;
    $attributes          = flatsome_html_atts( $attributes );
    
    $content .= '<div '. $attributes .'>';
    // $content .= '<h2 class="heading"><a title="'. get_dm_name( $cat, 'product_cat' ) .'" href="'. get_dm_link( $cat, 'product_cat' ) .'">'. get_dm_name( $cat, 'product_cat' ) .'</a></h2>';
    $content .= do_shortcode('[ux_products col_spacing="'. $col_spacing .'" columns="' . $columns . '" animate="'. $animate .'" show_cat="'. $show_cat .'" show_title="'. $show_title .'" show_rating="'. $show_rating .'" show_price="'. $show_price .'" show_add_to_cart="'. $show_add_to_cart .'" show_quick_view="'. $show_quick_view .'" equalize_box="'. $equalize_box .'" cat="' . $cat . '"products="' . $products . '" orderby="' . $orderby . '" order="' . $order . '" ]');
    $content .= '</div>';

    return $content;
}

add_shortcode('uni_product', 'shortcode_uni_product');
