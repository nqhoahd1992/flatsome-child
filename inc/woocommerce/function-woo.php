<?php
require PARENT_DIR . '/inc/woocommerce/grid-list-toggle.php';
// Shortcode woocommerce
require PARENT_DIR . '/inc/shortcodes/uni_product.php';
require PARENT_DIR . '/inc/shortcodes/uni_title_product.php';

/**
 * Optimize Woocommerce
 */
function uni_wc_lib_scripts(){
	wp_dequeue_style( 'wc-block-style' );
	wp_enqueue_style( 'woo-style', UNI_DIR .'/assets/css/woo.css' );
}
add_action( 'wp_enqueue_scripts', 'uni_wc_lib_scripts', 1 );

add_action( 'admin_head', function() {
	remove_action( 'in_admin_header', array( 'Automattic\WooCommerce\Admin\Loader', 'embed_page_header' ) ); 
	echo '<style>#wpadminbar + #wpbody { margin-top:0; }</style>';
});

/**
 * Display feature image of category product
 */
function woocommerce_category_image( $products ) {
    $thumbnail_id  = get_woocommerce_term_meta( $products, 'thumbnail_id', true );
    $thumbnail_arr = wp_get_attachment_image_src( $thumbnail_id, 'full' );
    $image = $thumbnail_arr[0];
    if ( $image ) {
	    $image_category = '<img src="' . $image . '" alt="" />';
	} else {
		$image_category = '<img src="'. get_stylesheet_directory_uri() .'/assets/img/img-not-available.jpg" alt="" />';
	}
	return $image_category;
}

/**
 * Add button continue shopping
 */
function uni_continue_shopping_button() {
	$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
	echo '<div class="continue_shopping"><a href="'. $shop_page_url .'" class="button">'. __('Continue Shopping','shtheme') .' →</a></div>';
}
add_action( 'woocommerce_proceed_to_checkout', 'uni_continue_shopping_button' );

/**
 * Overwrite field checkout
 */
function custom_override_checkout_fields( $fields ) {
    unset( $fields['billing']['billing_company'] );
    unset( $fields['billing']['billing_country'] );
    unset( $fields['billing']['billing_postcode'] );
    unset( $fields['billing']['billing_address_2'] );
    // $fields['billing']['billing_email']['required'] = false;
    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'custom_override_checkout_fields' );

/**
 * Tab Woocommerce
 */
function woo_remove_product_tabs( $tabs ) {
	// unset( $tabs['description'] );
    // unset( $tabs['reviews'] );
    unset( $tabs['additional_information'] );
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_rename_tabs( $tabs ) {
	$tabs['description']['title'] 	= __( 'Information', 'shtheme' );
	$tabs['image']['title'] 		= __( 'Gallery', 'shtheme' );
	$tabs['video']['title'] 		= __( 'Video', 'shtheme' );
	$tabs['document']['title'] 		= __( 'Attachments', 'shtheme' );

	$tabs['image']['priority']		= 50;
	$tabs['video']['priority']		= 60;
	$tabs['document']['priority']	= 70;

	$tabs['image']['callback']		= 'content_tab_image';
	$tabs['video']['callback']		= 'content_tab_video';
	$tabs['document']['callback']	= 'content_tab_document';
	return $tabs;
}
// add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );

/**
 * Change text button add to cart in single product
 */
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Add to cart', 'shtheme' ); 
}
// add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' );

/**
 * Add Button Quick Buy Simple Product In Single Product
 */
function insert_btn_quick_buy() {
	global $product;
	if ( $product->is_type( 'simple' ) ) {
		echo '<a class="button buy_now ml-3" href="?quick_buy=1&add-to-cart='. $product->ID .'&quantity=1" class="qn_btn" data-product_id="'. $product->ID .'">'. __('Quick buy','shtheme') .'</a>';
		?>
		<script type="text/javascript">
			jQuery(function($) { 
		        jQuery( ".product-summary" ).on( "click", ".quantity input", function() {
		            return false;
		        } );
		        jQuery( ".product-summary" ).on( "change input", ".quantity .qty", function() {
		            var add_to_cart_button = jQuery( this ).parents('form').find( ".buy_now" );
		            // For AJAX add-to-cart actions
		            add_to_cart_button.attr( "data-quantity", jQuery( this ).val() );
		            // For non-AJAX add-to-cart actions
		            add_to_cart_button.attr( "href", "?quick_buy=1&add-to-cart=" + add_to_cart_button.attr( "data-product_id" ) + "&quantity=" + jQuery( this ).val() );
		        } );
			});
		</script>
		<?php
	}
}
// add_action( 'woocommerce_after_add_to_cart_button', 'insert_btn_quick_buy', 1 );

/**
 * Redirect To Checkout Page After Click Button Quick Buy
 */
function redirect_to_checkout( $checkout_url ) {
    global $woocommerce;
    if( ! empty( $_GET['quick_buy'] ) ) {
        $checkout_url = $woocommerce->cart->get_checkout_url();
    }
    return $checkout_url;
}
// add_filter( 'woocommerce_add_to_cart_redirect', 'redirect_to_checkout' );

/**
 * Count Rating Product
 */
function count_ratings( $product_id, $rating ) {
	$args = array(
		'post_id' => $product_id,
		'status' => 'approve',
		'parent' => 0,
		'count' => true
	);
	if( 0 === $rating ) {
		$args['meta_query'][] = array(
			'key' => 'rating',
			'value'   => 0,
			'compare' => '>',
			'type'    => 'numeric'
		);
	} else if( $rating > 0 ){
		$args['meta_query'][] = array(
			'key' => 'rating',
			'value'   => $rating,
			'compare' => '=',
			'type'    => 'numeric'
		);
	}
	return get_comments( $args );
}

/**
 * Add text before price html
 */
function add_text_before_price_html( $price ) {
	if ( ! is_admin() ) {
		$price = '<span class="text_price">' . __('Price','shtheme') . ':</span> ' . $price;
	}
	return $price;
}
// add_filter( 'woocommerce_get_price_html', 'add_text_before_price_html' );

/**
 * Modify price html
 */
function uni_formatted_sale_price( $price, $regular_price, $sale_price ) {
	global $product;
	$price_html = '';
    $price_html .= '<ins>' . ( is_numeric( $sale_price ) ? wc_price( $sale_price ) : $sale_price ) . '</ins> <del>' . ( is_numeric( $regular_price ) ? wc_price( $regular_price ) : $regular_price ) . '</del>';
    if( is_product() && $product->is_on_sale() ) {
    	$price_html .= '<span class="badge">' . __( 'Discount', 'shtheme' ) . ' ' . round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 ) . '%</span>';
    }
    return $price_html;
}
// add_filter( 'woocommerce_format_sale_price', 'uni_formatted_sale_price', 10, 3 );

function uni_custom_contact_for_price( $html ) {
	if ( ! is_admin() ) {
	    $html = '<span class="amount">'.__( 'Contact', 'shtheme' ).'</span>';
	}
    return $html;
}
// add_filter( 'woocommerce_empty_price_html', 'uni_custom_contact_for_price' );

/**
 * Show price min for variation product
 */
function shop_variable_product_price( $price, $product ) {
	if( ! is_product() ) :
	    $variation_min_reg_price 	= $product->get_variation_regular_price('min', true);
	    $variation_min_sale_price 	= $product->get_variation_sale_price('min', true);
	    if ( $product->is_on_sale() && ! empty( $variation_min_sale_price ) ) {
	        if ( ! empty( $variation_min_sale_price ) )
	            $price = '<ins>' .  woocommerce_price($variation_min_sale_price) . '</ins><del>' .  woocommerce_price($variation_min_reg_price) . '</del>';
	    } else {
	        if( ! empty($variation_min_reg_price ) )
	            $price = '<ins>'. woocommerce_price( $variation_min_reg_price ) .'</ins>';
	        else
	            $price = '<ins>'. woocommerce_price( $product->regular_price ) .'</ins>';
	    }
	endif;
    return $price;
}
// add_filter('woocommerce_variable_sale_price_html', 'shop_variable_product_price', 10, 2);
// add_filter('woocommerce_variable_price_html','shop_variable_product_price', 10, 2 );

/**
 * Display Price For Variable Product Equal Price
 */
function display_equalprice_variable_pro( $available_variations, \WC_Product_Variable $variable, \WC_Product_Variation $variation ) {
    if ( empty( $available_variations['price_html'] ) ) {
        $available_variations['price_html'] = '<p class="price">' . $variation->get_price_html() . '</p>';
    }
    return $available_variations;
}
// add_filter( 'woocommerce_available_variation', 'display_equalprice_variable_pro', 10, 3 );

/**
 * Customizer quantity single product
 */
function wrap_before_button_cart(){
	echo '<div class="d-flex flex-wrap align-items-center wrap-btn-cart">';
	echo '<span class="mr-5">'. __( 'Choose quantity', 'shtheme' ) .'</span>';
}
// add_action( 'woocommerce_before_add_to_cart_quantity', 'wrap_before_button_cart' );

function wrap_after_button_cart(){
	echo '</div>';
	echo '<div class="clearfix"></div>';
}
// add_action( 'woocommerce_after_add_to_cart_quantity', 'wrap_after_button_cart' );

/**
 * Button Detail In File content-product.php
 */
function insert_btn_detail(){
	?>
	<div class="text-center wrap-detail">
		<a href="<?php the_permalink( );?>" title="<?php _e( 'View detail', 'shtheme' );?>">
			<?php _e( 'View detail', 'shtheme' );?>
		</a>
	</div>
	<?php
}
// add_action( 'woocommerce_after_shop_loop_item', 'insert_btn_detail', 15 );

if ( ! function_exists( 'uni_header_add_to_cart_fragment_count' ) ) {
	/**
	 * Update cart number when default cart icon is selected
	 *
	 * @param $fragments
	 *
	 * @return mixed
	 */
	function uni_header_add_to_cart_fragment_count( $fragments ) {
		ob_start();
		?>
		<span class="uni-count-cart lowercase">
		    <?php echo sprintf ( _n( __('%d product','shtheme'), __('%d products','shtheme'), WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
	  	</span>
		<?php
		$fragments['.header .uni-count-cart'] = ob_get_clean();
		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'uni_header_add_to_cart_fragment_count' );

/**
 * Customizer Page Account
 */
function add_my_account_menu(){
	$current_user = wp_get_current_user();
	?>
	<div id="my-account-menu" class="uni-wcmap position-vertical-left layout-simple position-left">
		<div class="user-profile">
			<div class="user-avatar">
				<?php echo get_avatar( $current_user->ID, $avatar_size ); ?>
			</div>
			<div class="user-info">
				<span class="username"><?php echo esc_html( $current_user->display_name ); ?> </span>
				<span class="user-email"><?php echo esc_html( $current_user->user_email ); ?></span>
				<?php if ( isset( $current_user ) && $current_user->ID ) : ?>
					<span class="logout">
						<a href="<?php echo wc_logout_url(); ?>"><?php _e( 'Logout', 'shtheme' ); ?></a>
					</span>
				<?php endif; ?>
			</div>
		</div>
		<ul class="myaccount-menu">
			<?php if(function_exists('wc_get_account_menu_items') && flatsome_option('wc_account_links')){ ?>
			<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			    <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
			      <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			    </li>
		  	<?php endforeach; ?>
		  	<?php do_action('flatsome_account_links'); ?>
			<?php } ?>
		</ul>
	</div>
	<?php
}
add_action( 'woocommerce_account_navigation', 'add_my_account_menu', 10 );

add_action( 'init', function() {
	remove_action('woocommerce_account_dashboard','flatsome_my_account_dashboard');
});

/**
 * Hook Woocommerce
 */
// File archive-product.php
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
// remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
// remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// File content-product.php
// remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
// remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
// remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
// remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
// remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
// remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
// remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
// remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

// File content-single-product.php
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 6 );
