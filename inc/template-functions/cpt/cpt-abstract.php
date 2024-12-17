<?php

abstract class CPT_Abstract
{
	function __construct()
	{
		load_child_theme_textdomain( 'shtheme', PARENT_DIR . '/languages' );
		add_action( 'Cpt\register_post_type', array( $this, 'register_post_type' ) );
	}

	public function register_post_type($cpt)
	{
	}
}