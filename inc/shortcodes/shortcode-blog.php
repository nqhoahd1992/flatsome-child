<?php
/**
 * Shortcode Blog
 *
 * @link 
 *
 * @package Uni_Theme
 */

class uni_blog_shortcode {

	public static $args;

	public function __construct() {

		add_shortcode( 'uniblog', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $atts, $content = null ) {
		$css_class = $el_class = '';

		extract( shortcode_atts( array(
			'style'   						=> '1',
			'posts_per_page'				=> '5',
			'categories'					=> '',
			'viewmore_text'					=> __( 'Read more', 'shtheme' ),
			'hide_category'					=> '1',
			'btn_viewmore'					=> '1',
			'hide_meta'						=> '1',
			'hide_thumb'					=> '1',
			'hide_desc'						=> '1',
			'number_character'				=> 200,
			'show_pagination'				=> '0',
		), $atts ) );

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $posts_per_page,
		);

		if( $categories ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' 	=> 'category',
					'field'     => 'id',
					'terms' 	=> $categories
				)
			);
		}

		if( $show_pagination ) {
			if ( get_query_var('paged') ) {
		        $paged = get_query_var('paged');
		    } else if ( get_query_var('page') ) {
		        $paged = get_query_var('page');
		    } else {
		        $paged = 1;
		    }
		    $args['paged'] = $paged;
		}

		$the_query = new WP_Query( $args );
		// The Loop
		if ( $the_query->have_posts() ) {

			$content .= '<div class="sh-blog-shortcode style-'. $style .' '. $css_class .' '. $el_class .'">';
			switch ( $style ) {
				case '1':
					$content .= $this->sh_blog_style_1( $the_query, $atts );
					break;
				case '2':
					$content .= $this->sh_blog_style_2( $the_query, $atts );
					break;
				case '3':
					$content .= $this->sh_blog_style_3( $the_query, $atts );
					break;
				case '4':
					$content .= $this->sh_blog_style_4( $the_query, $atts );
					break;
				case '5':
					$content .= $this->sh_blog_style_5( $the_query, $atts );
					break;
				case '6':
					$content .= $this->sh_blog_style_6( $the_query, $atts );
					break;
				case '7':
					$content .= $this->sh_blog_style_7( $the_query, $atts );
					break;
				case '8':
					$content .= $this->sh_blog_style_8( $the_query, $atts );
					break;
				default:
					$content .= $this->sh_general_post_html( $the_query, $atts );
					break;
			}
			$content .= '</div>';

		}

		if( $show_pagination ) {
			$content .= get_uni_custom_pagination( $the_query, $paged );
		}

		return $content;
		
	}

	/**
	 *
	 * Blog style 1
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 1
	 *
	 */
	function sh_blog_style_1 ( $the_query, $atts ) {

		$image_size 			= 'medium';	
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$post_class[] 			= 'col pb-0';

		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post();

			$html .= $this->sh_general_post_html( $post_class, $atts, $image_size );

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;

	}
	
	/**
	 *
	 * Blog style 2
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 2
	 *
	 */
	function sh_blog_style_2 ( $the_query, $atts ) {

		$image_size 			= 'large';
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$post_class[] 			= 'col medium-6 pb-0';
		$atts['hide_category'] 	= '0';
		$atts['hide_meta']		= '1';

		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post();

			$html .= $this->sh_general_post_html( $post_class, $atts, $image_size );

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;

	}

	/**
	 *
	 * Blog style 3
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 3
	 *
	 */
	function sh_blog_style_3 ( $the_query, $atts ) {
		
		$image_size 			= 'medium_large';
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$post_class[] 			= 'col medium-6 small-12 large-4 pb-0';
		$atts['hide_category'] 	= '0';
		$atts['hide_meta']		= '1';
		
		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post();

			$html .= $this->sh_general_post_html( $post_class, $atts, $image_size );

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;
	}

	/**
	 *
	 * Blog style 4
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 4
	 *
	 */
	function sh_blog_style_4 ( $the_query, $atts ) {

		$image_size 			= 'medium';
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$post_class[] 			= 'col medium-6 small-12 large-3 pb-0';
		$atts['hide_category'] 	= '0';
		$atts['hide_meta']		= '1';

		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post();

			$html .= $this->sh_general_post_html( $post_class, $atts, $image_size );

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;
	}

	/**
	 *
	 * Blog style 5
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 5
	 *
	 */
	function sh_blog_style_5 ( $the_query, $atts ) {
		
		$image_size 			= 'medium';
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$post_class[] 			= 'col medium-6 pb-0';
		$atts['hide_category'] 	= '0';
		$atts['hide_meta']		= '1';

		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post();

			$html .= $this->sh_general_post_html( $post_class, $atts, $image_size );

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;
	}

	/**
	 *
	 * Blog style 6
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 6
	 *
	 */
	function sh_blog_style_6 ( $the_query, $atts ) {

		$i = 0;
		$image_size 			= 'medium';
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$atts['hide_category'] 	= '0';

		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post(); $i++;

			if ( $i == 1 ) {
				$image_size 					= 'large';
				$atts['btn_viewmore']			= '0';
				
				$html .= '<div class="col medium-6 first-element-layout">';
				$html .= $this->sh_general_post_html( $post_class, $atts, $image_size );
				$html .= '</div>';
				if( count( $the_query->posts ) > 1 ) {
					$html .= '<div class="col medium-6 second-element-layout">';
				}
			} else {
				$image_size 					= 'medium';
				// $atts['hide_meta'] 				= '0';
				$atts['hide_desc'] 				= '0';
				
				$html .= $this->sh_general_post_html( $post_class, $atts, $image_size );
			}
			if ( $i == count( $the_query->posts ) && $i != 1 ) {
				$html .= '</div>';
			}

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;
	}

	/**
	 *
	 * Blog style 7
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 7
	 *
	 */
	function sh_blog_style_7 ( $the_query, $atts ) {

		$i = 0;
		$image_size 			= 'medium';
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$atts['hide_category'] 	= '0';

		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post(); $i++;

			if ( $i == 1 ) {
				$image_size 					= 'large';
				$atts['btn_viewmore']			= '1';

				$html .= '<div class="col medium-12 first-element-layout">';
				$html .= $this->sh_general_post_html( $post_class, $atts, $image_size );
				$html .= '</div>';
				if( count( $the_query->posts ) > 1 ) {
					$html .= '<div class="col medium-12 second-element-layout">';
				}
			} else {
				$image_size 					= 'medium';
				$atts['hide_thumb'] 			= '0';
				$atts['hide_meta'] 				= '0';
				$atts['btn_viewmore'] 			= '0';
				$atts['hide_desc'] 				= '0';
				
				$html .= $this->sh_general_post_html( $post_class, $atts, $image_size );
			}
			if ( $i == count( $the_query->posts ) && $i != 1 ) {
				$html .= '</div>';
			}

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;
	}

	/**
	 *
	 * Blog style 8
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 8
	 *
	 */
	function sh_blog_style_8 ( $the_query, $atts ) {

		$i = 0;
		$image_size 			= 'medium';
		$post_class 			= array( 'element', 'hentry', 'post-item', 'dark' );
		$atts['hide_category'] 	= '0';
		$atts['hide_meta'] 		= '1';
		$atts['btn_viewmore'] 	= '0';
		$atts['hide_desc'] 		= '0';

		$html = '';
		$html .= '<div class="row row-small">';
		while ( $the_query->have_posts() ) { $the_query->the_post(); $i++;

			if ( $i == 1 ) {
				$image_size 			= 'large';
				
				$html .= '<div class="col medium-12 first-element-layout">';
				$html .= $this->sh_general_post_html( $post_class, $atts, $image_size );
				$html .= '</div>';
				if( count( $the_query->posts ) > 1 ) {
					$html .= '<div class="col medium-12 second-element-layout pb-0"><div class="row row-small">';
				}
			} else {
				$image_size 			= 'medium';
				$post_class[] 			= 'col medium-6 small-12 large-4';
				
				$html .= $this->sh_general_post_html( $post_class, $atts, $image_size );
			}
			if ( $i == count( $the_query->posts ) && $i != 1 ) {
				$html .= '</div></div>';
			}

		}
		wp_reset_postdata();
		$html .= '</div>';
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
	function sh_general_post_html ( $post_class = array(), $atts = array(), $image_size = 'medium' ) {
		extract( shortcode_atts( array(
			'posts_per_page'				=> '5',
			'categories'					=> '',
			'viewmore_text'					=> __( 'Read more', 'shtheme' ),
			'hide_category'					=> '0',
			'btn_viewmore'					=> '0',
			'hide_meta'						=> '0',
			'hide_thumb'					=> '1',
			'hide_desc'						=> '1',
			'number_character'				=> 200,
		), $atts ) );

		$html = '';
		$html .= '<article id="post-'. get_the_ID() .'" class="'. implode( ' ', get_post_class( $post_class ) ) .'"><div class="post-inner">';
		// Check display thumb of post
		if ( $hide_thumb == '1' && has_post_thumbnail() ) :
			$html .= '<a href="'. get_the_permalink() .'" class="box box-blog-post has-hover entry-thumb">';
				$html .= '<div class="box-image">';
					$html .= '<div class="image-zoom image-cover">';
						$html .= get_the_post_thumbnail( get_the_ID(), $image_size, array( "alt" => get_the_title() ) );
						$html .= '</div>';
				$html .= '</div>';
			$html .= '</a>';
		endif;
		$html .= '<div class="entry-content">';
			// Check display category
			if ( $hide_category == '1' ) {
				$categories = wp_get_post_categories( get_the_ID() );
				if ( count( $categories ) > 0 ) {
					$html .= '<div class="entry-cat">';
					foreach ( $categories as $key => $cat_id ) {
						$category = get_category( $cat_id );
						if ( $key == ( count( $categories ) - 1 ) ) {
							$html .= '<a href="'. get_term_link( $category ) .'" title="'. $category->name .'">'. $category->name .'</a>';	
						} else {
							$html .= '<a href="'. get_term_link( $category ) .'" title="'. $category->name .'">'. $category->name .'</a>, ';
						}
					}
					$html .= '</div>';
				}
			}
			$html .= '<h3 class="entry-title"><a href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a></h3>';
			// Metadata
			if ( $hide_meta == '1' ) {
				$html .= '<div class="entry-meta">';
					$html .= '<span class="date-time"><i class="far fa-calendar-alt"></i>'. get_the_time('d/m/Y') .'</span>';
					$html .= '<span class="view-post ml-half"><i class="far fa-eye"></i>'. postview_get( get_the_ID() ) .'</span>';
					// $comments_count = wp_count_comments( get_the_ID() );
					// $html .= '<span class="number-comment ml-half"><i class="far fa-comment-dots"></i>'. $comments_count->approved . ' ' . __( 'Comments', 'shtheme' ) . '</span>';
				$html .= '</div>';
			}
			// Check display description
			if ( $hide_desc == '1' ) {
				$html .= '<div class="entry-description">'. get_the_content_limit( $number_character,' ' ) .'</div>';
			}
			// Check display view more button
			if ( $btn_viewmore == '1' ) {
				$html .= '<a href="'. get_permalink() .'" title="'. get_the_title() .'" class="view-more">'. $viewmore_text .' <i class="far fa-angle-double-right"></i></a>';
			}
		$html .= '</div>';
		$html .= '</div></article>';
		return $html;
	}

}
new uni_blog_shortcode();