<?php
/**
 * Shortcode Blog
 *
 * @link 
 *
 * @package Uni_Theme
 */

class uni_blog_slide_shortcode {

	public static $args;

	public function __construct() {

		add_shortcode( 'uniblogslide', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $atts, $content = '') {
		$html = $css_class = $el_class = '';

		extract(shortcode_atts(array(
		    // 'style'             => '1',
		    'posts_per_page'        => '10',
		    'item'                  => '3',
		    'item_lg'               => '2',
		    'item_md'               => '2',
		    'item_sm'               => '1',
		    'item_mb'               => '1',
		    'number_row'            => '1',
		    'image_size'            => 'thumb300x200',
		    'hide_meta'             => '0',
		    'hide_desc'             => '0',
		    'number_character'      => '80',
		    'viewmore_text'         => __( 'Read more', 'shtheme' ),
		    'btn_viewmore'          => '0',
		    // 'order'                 => 'desc',
		    // 'orderby'               => 'date',
		    'categories'            => '',
		    'data_dots'             => 'true',
		    'data_arrows'           => 'false',
		    // 'el_class'              => '',
		    // 'css'                   => '',
		), $atts));

		$args = array(
			'post_type' => 'post',
			'tax_query' => array(
				array(
					'taxonomy' 	=> 'category',
					'field'     => 'id',
					'terms' 	=> $categories
				)
			),
			'posts_per_page'	=> $posts_per_page,
		);

		$the_query = new WP_Query( $args );
		// The Loop
		if ( $the_query->have_posts() ) {

		    wp_enqueue_script( 'slick-js' );
		    wp_enqueue_style( 'slick-style' );
		    wp_enqueue_style( 'slick-theme-style' );

	        $html .= '<div class="sh-blog-shortcode sh-blog-slide-shortcode">';

		        $html .= '<div class="slick-carousel blog-slider" data-item="'. $item .'" data-item_lg="'. $item_lg .'" data-item_md="'. $item_md .'" data-item_sm="'. $item_sm .'" data-item_mb="'. $item_mb .'" data-row="'. $number_row .'" data-dots="'. $data_dots .'" data-arrows="'. $data_arrows .'" data-vertical="false">';

	                while ( $the_query->have_posts() ) { $the_query->the_post();

	                    $html .= $this->sh_general_post_html( $post_class, $atts, $image_size );

	                }
	                wp_reset_postdata();

	            $html .= '</div>';

	        $html .= '</div>';

		}

		return $html;
		
	}

	/**
	 *
	 * General post html
	 *
	 * @param  $post_class: class of post
	 * @return $html: html of post
	 *
	 */
	function sh_general_post_html ( $post_class = array(), $atts = array(), $image_size = 'thumb300x200' ) {
		extract( shortcode_atts( array(
			'viewmore_text'					=> __( 'Read more', 'shtheme' ),
			'btn_viewmore'					=> '0',
			'hide_meta'						=> '0',
			'hide_desc'						=> '1',
			'number_character'				=> 200,
		), $atts ) );

		$html = '';
		
		$html .= '<div class="blog-slider__item">';
	        $html .= '<div class="blog-slider__item__inner">';
	        	if( has_post_thumbnail() ) :
		            $html .= '<div class="entry-thumb">';
		                $html .= '<a class="d-block" href="'. get_the_permalink() .'" title="'. get_the_title() .'">';
		                    $html .= '<div class="blog-slider__item__hover"><i class="far fa-link"></i></div>';
	                        $html .= '<img alt="'. get_the_title() .'" data-lazy="'. get_the_post_thumbnail_url( get_the_ID(), $image_size ) .'"/>';
		                $html .= '</a>';
		            $html .= '</div>';
	            endif;
	            $html .= '<div class="entry-content">';
	                $html .= '<h3 class="entry-title"><a href="'. get_the_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a></h3>';
	                // Metadata
	                if ( $hide_meta == '1' ) {
	                    $html .= '<div class="entry-meta">';
	                        $html .= '<span class="date-time"><i class="far fa-calendar-alt"></i> '. get_the_time('d/m/Y G:i') .'</span>';
	                    $html .= '</div>';
	                }
	                // Check display description
	                if ( $hide_desc == '1' ) {
	                    $html .= '<div class="entry-description">'. get_the_content_limit( $number_character,' ' ) .'</div>';
	                }
	                // Check display view more button
	                if ( $btn_viewmore == '1' ) {
	                    $html .= '<div class="text-left"><a class="view-detail" href="'. get_permalink() .'" title="'. get_the_title() .'">'. $viewmore_text .' <i class="far fa-angle-double-right"></i></a></div>';
	                }
	            $html .= '</div>';
	        $html .= '</div>';
	    $html .= '</div>';

		return $html;
	}

}
new uni_blog_slide_shortcode();