<?php
define( 'PARENT_DIR', get_stylesheet_directory() );
define( 'UNI_DIR',  get_stylesheet_directory_uri() );
define( 'FUNCTIONS_DIR', PARENT_DIR . '/inc/template-functions' );
define( 'TAGS_DIR', PARENT_DIR . '/inc/template-tags' );

function uni_load_framework() {
	// Load Functions.
	require_once( FUNCTIONS_DIR . '/init.php' );
	require_once( FUNCTIONS_DIR . '/breadcrumbs.php' );
	require_once( FUNCTIONS_DIR . '/dashboard.php' );
	require_once( TAGS_DIR . '/formatting.php' );
}
add_action( 'after_setup_theme','uni_load_framework' );

/**
 * Register Widget Area
 */
function uni_widgets_init() {
	// Sidebar Widget
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'shtheme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'shtheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Secondary Sidebar', 'shtheme' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'shtheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
// add_action( 'widgets_init', 'uni_widgets_init' );

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
// require PARENT_DIR . '/inc/shortcodes/shortcode-blog-slide.php';

// Load Ux Builder Shortcode
require PARENT_DIR . '/inc/shortcodes/uni_custom_menu.php';
require PARENT_DIR . '/inc/shortcodes/uni_blog.php';
require PARENT_DIR . '/inc/shortcodes/uni_wg_information.php';
if ( class_exists( 'WooCommerce' ) ) {
	require PARENT_DIR . '/inc/shortcodes/uni_product.php';
	require PARENT_DIR . '/inc/shortcodes/uni_title_product.php';
}
require PARENT_DIR . '/inc/builder/shortcodes.php';

// Load Woocomerce
if ( class_exists( 'WooCommerce' ) ) {
// 	require PARENT_DIR . '/inc/shortcode/shortcode-product.php';
// 	require PARENT_DIR . '/inc/shortcode/shortcode-product-slide.php';
// 	require PARENT_DIR . '/inc/widgets/wg-product-slider.php';
	require PARENT_DIR . '/inc/function-woo.php';
}

// Load Widget
require PARENT_DIR . '/inc/widgets/wg-post-list.php';
require PARENT_DIR . '/inc/widgets/wg-support.php';
require PARENT_DIR . '/inc/widgets/wg-fblikebox.php';
require PARENT_DIR . '/inc/widgets/wg-view-post-list.php';
require PARENT_DIR . '/inc/widgets/wg-information.php';

/**
 * Loads the child theme textdomain.
 */
function uni_child_theme_setup() {
    load_child_theme_textdomain( 'shtheme', PARENT_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'uni_child_theme_setup' );

function uni_lib_scripts(){

	// Font Awesome
	wp_enqueue_style( 'fontawesome-style', UNI_DIR .'/assets/css/font-awesome-all.css' );

	// Main js
	wp_enqueue_script( 'main-js', UNI_DIR . '/assets/js/main.js', array('jquery'), '1.0', true );
	wp_localize_script(	'main-js', 'ajax', array( 'url' => admin_url('admin-ajax.php') ) );

	// Slick Slider
	wp_register_script( 'slick-js', UNI_DIR . '/assets/js/slick.min.js', array('jquery'), '1.8.1', true );
	wp_register_style( 'slick-style', UNI_DIR .'/assets/css/slick/slick.css' );
	wp_register_style( 'slick-theme-style', UNI_DIR .'/assets/css/slick/slick-theme.css' );
	
}
add_action( 'wp_enqueue_scripts', 'uni_lib_scripts', 1 );

/**
 * Add Thumb Size
**/
add_image_size( 'thumb300x200', 300, 200, array( 'center', 'center' ) );
