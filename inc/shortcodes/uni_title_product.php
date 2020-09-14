<?php  
function shortcode_uni_title_products($atts, $content = null, $tag) {

    extract(shortcode_atts(array(
        'id'       => '',
        'sub_ids'  => '',
    ), $atts));
    
    ob_start();

    $html = $html_cat = '';
    $args = array(
        'taxonomy'      => 'product_cat',
        'include'       => $sub_ids,
        'hide_empty'	=> false,
    );
    $product_categories = get_terms( $args );
    $html_cat .= '<ul class="ul-reset">';
    if ( $product_categories ) {
        foreach ( $product_categories as $category ) {
            $term_link = get_term_link( $category );
            $html_cat .= '<li><a href="'.$term_link.'">'.$category->name.'</a></li>';
        }
    }
    $html_cat .= '<li><a class="viewall" href="'. get_dm_link($id,'product_cat') .'">'. __('View all','shtheme') .' <i class="fas fa-arrow-circle-right"></i></a></li>';
    $html_cat .= '</ul>';

    $html .= '<div class="uni-titlepro">';
    	$html .= '<div class="uni-titlepro__main">';
		    $html .= '<h2 class="heading"><a href="'. get_dm_link($id,'product_cat') .'" title="'. get_dm_name($id,'product_cat') .'">'. get_dm_name($id,'product_cat') .'</a></h2>';
		    $html .= '<div class="open-subcat">'. __('Categories','shtheme') .' <i class="fas fa-caret-down"></i></div>';
	    $html .= '</div>';
	    $html .= $html_cat;
    $html .= '</div>';
    echo $html;
   	?>
   	<script type="text/javascript">
   		jQuery(document).ready(function($) {
   			jQuery('.open-subcat').on('click',function(){
		        jQuery(this).parents('.uni-titlepro').find('ul').slideToggle();
		    })
   		});	
   	</script>
   	<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('uni_title_products', 'shortcode_uni_title_products');
