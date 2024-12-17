<?php
/**
 * WC_List_Grid class
 **/
if ( ! class_exists( 'WC_List_Grid' ) ) {

	class WC_List_Grid {

		public function __construct() {
			// Hooks
			add_action( 'wp', array( $this, 'setup_gridlist' ), 20);
			add_action( 'init', array( $this, 'remove_parent_theme_hook' ), 99 );
		}

		// Setup
		function setup_gridlist() {
			if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
				// add_action( 'wp_enqueue_scripts', array( $this, 'setup_scripts_script' ), 20 );
				// add_action( 'uni_frontend_wc_listgrid', array( $this, 'gridlist_toggle_button' ), 10 );
				// add_action( 'woocommerce_after_shop_loop_item', array( $this, 'gridlist_description' ), 9);
				add_action( 'woocommerce_archive_description', array( $this, 'frontend_wc_listgrid' ), 9 );
			}
		}

		function remove_parent_theme_hook() {
			remove_action( 'flatsome_category_title_alt', 'woocommerce_result_count', 20 );
			remove_action( 'flatsome_category_title_alt', 'woocommerce_catalog_ordering', 30 );
		}

		// Scripts & styles
		function setup_scripts_script() {
			wp_enqueue_script( 'cookie', UNI_DIR . '/assets/js/jquery.cookie.min.js', array( 'jquery' ), '1.4.1', true );
			wp_enqueue_script( 'grid-list-scripts', UNI_DIR . '/assets/js/gridlist-product/jquery.gridlistview.js', array( 'jquery' ), '1.0', true );
		}

		// Toggle button
		function gridlist_toggle_button() {

			$grid_view = __( 'Grid view', 'shtheme' );
			$list_view = __( 'List view', 'shtheme' );

			$output = sprintf( '<div class="view-mode-switcher"><a class="mr-half" href="#" id="grid" title="%1$s"><i class="fas fa-th"></i></a><a href="#" id="list" title="%2$s"><i class="far fa-list-ul"></i></a></div>', $grid_view, $list_view );

			echo apply_filters( 'gridlist_toggle_button_output', $output, $grid_view, $list_view );
		}

		function frontend_wc_listgrid(){
			if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
				<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
			<?php endif;
			global $wp_query;
			if( $wp_query->found_posts > 0 ) :
				?>
				<div class="uni-toolbox">
					<?php //do_action( 'uni_frontend_wc_listgrid' ); ?>
					<?php woocommerce_result_count(); ?>
					<!-- <div class="hide-for-small"> -->
						<?php woocommerce_catalog_ordering(); ?>
					<!-- </div> -->
					<!-- <div class="show-for-small"> -->
						<?php //wc_get_template_part( 'loop/filter-button' );?>
					<!-- </div> -->
				</div>
				<?php
			endif;
		}

		// Description wrap
		function gridlist_description() {
			global $post;
			echo '<div class="gridlist-description">';
				$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
				echo strip_tags( $short_description );
			echo '</div>';
		}

	}

	new WC_List_Grid();
}
