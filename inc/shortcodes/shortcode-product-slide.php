<?php
/**
 * Shortcode Product
 *
 * @link 
 *
 * @package Uni_Theme
 */

class uni_product_slide_shortcode {

	public static $args;

	public function __construct() {

		add_shortcode( 'uniproductslide', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $atts, $content = '') {

		extract( shortcode_atts( array(
			// 'style'             => '1',
		    'posts_per_page'        => '10',
		    'items_desktop_large'   => '3',
		    'items_desktop'         => '2',
		    'items_tablets'         => '2',
		    'items_mobile'          => '1',
		    'number_row'            => '1',
		    // 'order'                 => 'desc',
		    // 'orderby'               => 'date',
		    'categories'            => '',
		    'data_dots'             => 'true',
		    'data_arrows'           => 'false',
		    // 'el_class'              => '',
		    // 'css'                   => '',
		), $atts ) );

		$args = array(
    		'post_type' => 'product',
		    'tax_query' => array(
		        array(
		            'taxonomy'  => 'product_cat',
		            'field'     => 'id',
		            'terms'     => $categories
		        )
		    ),
		    'posts_per_page'    => $posts_per_page,
		);
		$the_query = new WP_Query( $args );

		// The Loop
		if ( $the_query->have_posts() ) {
			wp_enqueue_script( 'slick-js' );
		    wp_enqueue_style( 'slick-style' );
		    wp_enqueue_style( 'slick-theme-style' );

	        echo '<div class="sh-product-shortcode sh-product-slider-shortcode">';
		    	echo '<div class="slick-carousel product-slider list-products" data-item="'. $items_desktop_large .'" data-item_md="'. $items_desktop .'" data-item_sm="'. $items_tablets .'" data-item_mb="'. $items_mobile .'" data-row="'. $number_row .'" data-dots="'. $data_dots .'" data-arrows="'. $data_arrows .'" data-vertical="false">';
	                
	                while ( $the_query->have_posts() ) { 
	                	$the_query->the_post();

	                    /**
	                     * Hook: woocommerce_shop_loop.
	                     *
	                     * @hooked WC_Structured_Data::generate_product_data() - 10
	                     */
	                    do_action( 'woocommerce_shop_loop' );

	                    wc_get_template_part( 'content', 'product' );
	                    
	                }
	                wp_reset_postdata();

	            echo '</div>';



	        echo '</div>';

		}
		
	}

}
new uni_product_slide_shortcode();