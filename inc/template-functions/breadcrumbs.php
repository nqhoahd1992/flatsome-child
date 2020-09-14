<?php
function uni_add_breadcrums() {
    if ( function_exists('yoast_breadcrumb') && ! is_front_page() ) {
        yoast_breadcrumb( '<div class="uni-breadcrumbs"><div class="container"><div id="breadcrumbs">','</div></div></div>' );
    }
}
add_action( 'flatsome_before_blog','uni_add_breadcrums' );
add_action( 'flatsome_before_page','uni_add_breadcrums' );