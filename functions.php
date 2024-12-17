<?php
define( 'PARENT_DIR', get_stylesheet_directory() );
define( 'UNI_DIR',  get_stylesheet_directory_uri() );
define( 'FUNCTIONS_DIR', PARENT_DIR . '/inc/template-functions' );
define( 'TAGS_DIR', PARENT_DIR . '/inc/template-tags' );

function uni_load_framework() {
	// Loads the child theme textdomain.
	load_child_theme_textdomain( 'shtheme', PARENT_DIR . '/languages' );
	// Load Functions.
	require_once( FUNCTIONS_DIR . '/init.php' );
	require_once( FUNCTIONS_DIR . '/breadcrumbs.php' );
	require_once( FUNCTIONS_DIR . '/dashboard.php' );
	require_once( TAGS_DIR . '/formatting.php' );
	// Load Options
	include_once( PARENT_DIR.'/inc/admin/advanced/options.php' );
	// Remove Flatsome notice
	remove_action('admin_notices', 'flatsome_maintenance_admin_notice');
    remove_action('tgmpa_register', 'flatsome_register_required_plugins');
    remove_filter( 'site_status_tests', 'flatsome_site_status_tests' );
}
add_action( 'after_setup_theme','uni_load_framework' );

/**
 * Load File
 */

// Load Custom Post Type
// require PARENT_DIR . '/inc/template-functions/cpt/cpt-abstract.php';
// require PARENT_DIR . '/inc/template-functions/cpt/khach-hang.php';
// require PARENT_DIR . '/inc/template-functions/cpt/cpt.php';
	
// Load Custom Taxonomy
// require PARENT_DIR . '/inc/template-functions/taxonomies/custom-taxonomy-abstract.php';
// require PARENT_DIR . '/inc/template-functions/taxonomies/khach-hang-cat.php';
// require PARENT_DIR . '/inc/template-functions/taxonomies/custom-taxonomy.php';

// Load Shortcode
require PARENT_DIR . '/inc/shortcodes/shortcode-blog.php';

// Load Ux Builder Shortcode
require PARENT_DIR . '/inc/shortcodes/uni_custom_menu.php';
require PARENT_DIR . '/inc/shortcodes/uni_blog.php';
require PARENT_DIR . '/inc/shortcodes/uni_wg_information.php';
require PARENT_DIR . '/inc/shortcodes/uni_wg_fb.php';
require PARENT_DIR . '/inc/shortcodes/uni_count_up.php';
if( get_theme_mod( 'customizer_element_col' ) ) {
	require PARENT_DIR . '/inc/shortcodes/uni_col.php';
}

require PARENT_DIR . '/inc/builder/shortcodes.php';

// Load Woocomerce
if ( class_exists( 'WooCommerce' ) ) {
	require PARENT_DIR . '/inc/woocommerce/function-woo.php';
}

// Load Widget
require PARENT_DIR . '/inc/widgets/wg-post-list.php';
require PARENT_DIR . '/inc/widgets/wg-view-post-list.php';
// require PARENT_DIR . '/inc/widgets/wg-information.php';

// Disable email verification.
add_filter( 'admin_email_check_interval', '__return_false' );

/**
 * Add Css Js
 */
function uni_lib_scripts(){

	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );

	// Font Awesome
	wp_enqueue_style( 'fontawesome-style', UNI_DIR .'/assets/css/font-awesome-all.css' );

	// Main js
	wp_enqueue_script( 'main-js', UNI_DIR . '/assets/js/main.js', array('jquery'), '1.0', true );
	wp_localize_script(	'main-js', 'ajax', array( 'url' => admin_url('admin-ajax.php') ) );

	// Slick Slider
	if( get_theme_mod( 'slick_slider' ) ) {
		wp_register_script( 'slick-js', UNI_DIR . '/assets/js/slick.min.js', array('jquery'), '1.8.1', true );
		wp_register_style( 'slick-style', UNI_DIR .'/assets/css/slick/slick.css' );
		wp_register_style( 'slick-theme-style', UNI_DIR .'/assets/css/slick/slick-theme.css' );
	}

	// AOS Animate
	if( get_theme_mod( 'aos_animate' ) ) {
		wp_enqueue_script( 'aos-js', UNI_DIR . '/assets/js/aos.js', array('jquery'), '2.0', true );
		wp_enqueue_style( 'aos-style', UNI_DIR .'/assets/css/aos.css' );
		wp_add_inline_script( 'aos-js', "AOS.init();");
	}
}
add_action( 'wp_enqueue_scripts', 'uni_lib_scripts', 1 );
