<?php
require_once __DIR__ . '/shortcodes/uni_custom_menu.php';
require_once __DIR__ . '/shortcodes/uni_blog.php';
require_once __DIR__ . '/shortcodes/uni_wg_information.php';
require_once __DIR__ . '/shortcodes/uni_wg_fb.php';

if ( class_exists( 'WooCommerce' ) ) {
	require_once __DIR__ . '/shortcodes/uni_product.php';
	require_once __DIR__ . '/shortcodes/uni_title_product.php';
}
