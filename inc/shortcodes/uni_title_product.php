<?php  
function shortcode_uni_title_products($atts, $content, $html_cat) {

    extract(shortcode_atts(array(
        'class' => '',
        'visibility' => '',
        'id'       => '',
        'sub_ids'  => '',
    ), $atts));
    
    if($visibility == 'hidden') return;

    // Add Button Classes.
    $classes   = array();
    $classes[] = 'uni-titlepro';
    if ( $class ) {
        $classes[] = $class;
    }
    if ( $visibility ) {
        $classes[] = $visibility;
    }
    $attributes['class'] = $classes;
    $attributes          = flatsome_html_atts( $attributes );
    
    $args = array(
        'taxonomy'      => 'product_cat',
        'include'       => $sub_ids,
        'hide_empty'	=> false,
        'orderby'       => 'include',
    );
    $product_categories = get_terms( $args );
    $html_cat = '<ul class="ul-reset">';
    if ( $product_categories ) {
        foreach ( $product_categories as $category ) {
            $term_link = get_term_link( $category );
            $html_cat .= '<li><a href="'.$term_link.'">'.$category->name.'</a></li>';
        }
    }
    $html_cat .= '<li><a class="viewall" href="'. get_dm_link($id,'product_cat') .'">'. __('View all','shtheme') .' <i class="fas fa-arrow-circle-right"></i></a></li>';
    $html_cat .= '</ul>';

    $content .= '<div '. $attributes .'>';
    	$content .= '<div class="uni-titlepro__main">';
		    $content .= '<h2 class="heading"><a href="'. get_dm_link($id,'product_cat') .'" title="'. get_dm_name($id,'product_cat') .'">'. get_dm_name($id,'product_cat') .'</a></h2>';
		    $content .= '<div class="open-subcat">'. __('Categories','shtheme') .' <i class="fas fa-caret-down"></i></div>';
	    $content .= '</div>';
	    $content .= $html_cat;
    $content .= '</div>';
    $content .= '<script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery(".open-subcat").on("click",function(){
                jQuery(this).parents(".uni-titlepro").find("ul").slideToggle();
            })
        }); 
    </script>';

    return $content;
}

add_shortcode('uni_title_products', 'shortcode_uni_title_products');
