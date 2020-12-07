<?php
function uni_add_breadcrums() {
    if ( function_exists('yoast_breadcrumb') && ! is_front_page() ) {
    	echo '<div id="dark-breadcrumbs" class="hide-for-sticky">';
	    	echo '<div class="container">';
	    		yoast_breadcrumb( '<div id="breadcrumbs">','</div>' );
		    	if( is_page( ) || is_single( ) ) {
		            echo '<h1>'. get_the_title( ) .'</h1>';
		        } elseif( is_archive() ) {
		            ?><h1><?php single_term_title(); ?></h1><?php
		        } elseif( is_search() ) {
		            echo '<h1>'.__('Search for keyword', 'shtheme').': '. get_search_query() .'</h1>';
		        } elseif( is_404() ) {
		            echo '<h1>'.__('404 Not Found', 'shtheme').'</h1>';
		        }
		        if ( class_exists( 'WooCommerce' ) ) {
		            if( is_shop() ) {
		                echo '<h1>'.__('Products', 'shtheme').'</h1>';
		            }
		        }
	        echo '</div>';
        echo '</div>';
    }
}
// add_action( 'flatsome_after_header_bottom','uni_add_breadcrums' );
// add_action( 'flatsome_after_header_bottom','uni_add_breadcrums' );
// add_action( 'flatsome_before_page','uni_add_breadcrums' );
