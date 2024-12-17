<?php
if ( ! function_exists( 'uni_customizer_options' ) ) {
	function uni_customizer_options() {

		global $of_options, $current_user;

		if( ! is_admin() || empty( $of_options ) ) {
			return;
		}

		// Set the Options Array.
		$array_options = array();

		$array_options[] = array(
			'name' => 'Uni Settings',
			'type' => 'heading',
		);

		if( $current_user->user_login == 'uniadmin' ) {
			$array_options[] = array(
				'name' => '',
				'type' => '',
				'desc' => '<h2 style="font-size:1rem; margin-top: 40px;">'. __( "Restrict Capabilities", "shtheme" ) .'</h2>',
			);
			$array_options[] = array(
				'name' => __( "Disble Restrict Capabilities", "shtheme" ),
				'id'   => 'disable_restrict_capabilities',
				'desc' => __( "Disble restrict capabilities for the customer's account", "shtheme" ),
				'std'  => 0,
				'type' => 'checkbox',
			);
		}

		$array_options[] = array(
			'name' => '',
			'type' => '',
			'desc' => '<h2 style="font-size:1rem; margin-top: 40px;">'. __( "Customizer Element Ux Builder", "shtheme" ) .'</h2>',
		);

		$array_options[] = array(
			'name' => __( "Column", "shtheme" ),
			'id'   => 'customizer_element_col',
			'desc' => __( "Enable additional options for element Column", "shtheme" ),
			'std'  => 0,
			'type' => 'checkbox',
		);

		$array_options[] = array(
			'name' => '',
			'type' => '',
			'desc' => '<h2 style="font-size:1rem; margin-top: 40px;">'. __( "Library", "shtheme" ) .'</h2>',
		);

		$array_options[] = array(
			'name' => __( "Slick Slider", "shtheme" ),
			'id'   => 'slick_slider',
			'desc' => __( "Enable Slick Slider", "shtheme" ),
			'std'  => 0,
			'type' => 'checkbox',
		);

		$array_options[] = array(
			'name' => __( "AOS Animate", "shtheme" ),
			'id'   => 'aos_animate',
			'desc' => __( "Enable AOS Animate", "shtheme" ),
			'std'  => 0,
			'type' => 'checkbox',
		);

		$of_options = array_merge_recursive($array_options, $of_options);

	}
}
add_action( 'init', 'uni_customizer_options' );

if ( ! function_exists( 'uni_admin_bar_helper' ) ) {
	function uni_admin_bar_helper(){

		global $wp_admin_bar;
		
		$advanced_url = get_admin_url().'admin.php?page=optionsframework&tab=';

		$wp_admin_bar->add_menu( array(
			'parent' => 'options_advanced',
			'id' => 'options_advanced_uni_settings',
			'title' => 'Uni Settings',
			'href' =>  $advanced_url.'of-option-unisettings'
		));

	}
}
add_action( 'admin_bar_menu', 'uni_admin_bar_helper', 1 );
