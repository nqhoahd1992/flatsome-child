<?php  
function shortcode_uni_product($atts, $content = null, $tag) {

    extract(shortcode_atts(array(
        'ids'           => '',
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
        'show_cat' => 'true',
        'show_title' => 'true',
        'show_rating' => 'true',
        'show_price' => 'true',
        'show_add_to_cart' => 'true',
        'show_quick_view' => 'true',
    ), $atts));
    
    ob_start();
    $array_ids = explode(',', $ids);
    
    if( is_array($array_ids) ) {
        foreach ($array_ids as $key => $idpost) {
            echo '<h2 class="heading"><a title="'. get_dm_name( $idpost, 'product_cat' ) .'" href="'. get_dm_link( $idpost, 'product_cat' ) .'">'. get_dm_name( $idpost, 'product_cat' ) .'</a></h2>';
            echo do_shortcode('[ux_products style="normal" col_spacing="'. $col_spacing .'" columns="' . $columns . '" animate="'. $animate .'" show_cat="'. $show_cat .'" show_title="'. $show_title .'" show_rating="'. $show_rating .'" show_price="'. $show_price .'" show_add_to_cart="'. $show_add_to_cart .'" show_quick_view="'. $show_quick_view .'" equalize_box="'. $equalize_box .'" cat="' . $idpost . '"products="' . $products . '" orderby="' . $orderby . '" order="' . $order . '" ]');
        }
    }

    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('uni_product', 'shortcode_uni_product');
