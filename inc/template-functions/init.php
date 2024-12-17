<?php
/**
 * Remove Title
 */
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    }
    return $title;
});

/* Disable XML RPC */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Display Pagination
**/
if ( ! function_exists( 'get_uni_pagination' ) ) {
	function get_uni_pagination() {
		$html = '';
		global $wp_query;
		$big = 999999999;

		$pages = paginate_links( array(
            'base' 		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' 	=> '?paged=%#%',
            'current' 	=> max( 1, get_query_var('paged') ),
			'total' 	=> $wp_query->max_num_pages,
            'prev_text' => '<i class="icon-angle-left"></i>',
            'next_text' => '<i class="icon-angle-right"></i>',
            'type' => 'array',
        ));

		if ( is_array( $pages ) ) {
			$paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
			$html .= '<ul class="page-numbers nav-pagination links text-center">';
			foreach ( $pages as $page ) {
				$page = str_replace( 'page-numbers', 'page-number', $page );
				$html .= '<li>' . $page . '</li>';
			}
			$html .= '</ul>';
		}
		return $html;
	}
}

/**
 * Custom Pagination
**/
if ( ! function_exists( 'get_uni_custom_pagination' ) ) {
	function get_uni_custom_pagination( $custom_query, $current_page ) {
		$html = '';
		$total_pages = $custom_query->max_num_pages;
		$big = 999999999;
		if ( $total_pages > 1 ) {
	        $pages = paginate_links( array(
	            'base' 		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	            'format' 	=> '?paged=%#%',
	            'current' 	=> $current_page,
	            'total' 	=> $total_pages,
	            'prev_text' => '<i class="icon-angle-left"></i>',
	            'next_text' => '<i class="icon-angle-right"></i>',
	            'type' => 'array',
	        ));

	        if ( is_array( $pages ) ) {
				$paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
				$html .= '<ul class="page-numbers nav-pagination links text-center">';
				foreach ( $pages as $page ) {
					$page = str_replace( 'page-numbers', 'page-number', $page );
					$html .= '<li>' . $page . '</li>';
				}
				$html .= '</ul>';
			}
	    }
		return $html;
	}
}

/**
 * Set view post
**/
function postview_set( $postID ) {
    $count_key 	= 'postview_number';
    $count 		= get_post_meta( $postID, $count_key, true );
    if( $count == '' ) {
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    } else {
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}

/**
 * Get view post
**/
function postview_get( $postID ){
    $count_key 	= 'postview_number';
    $count 		= get_post_meta( $postID, $count_key, true );
    if ( $count == '' ){
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
        return '0 '.__( 'views', 'shtheme' );
    }
    return $count.' '. __( 'views', 'shtheme' );
}

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/**
 * Get term name
 */
function get_dm_name( $cat_id, $taxonomy ) {
	$cat_id 	= (int) $cat_id;
	$category 	= get_term( $cat_id, $taxonomy );
	if ( ! $category || is_wp_error( $category ) )
	return '';
	return $category->name;
}

/**
 * Get term link
 */
function get_dm_link( $category, $taxonomy ) {
	if ( ! is_object( $category ) )
	$category = (int) $category;
	$category = get_term_link( $category, $taxonomy );
	if ( is_wp_error( $category ) )
	return '';
	return $category;
}

/*
 * Dupplicate Post - Page
 */
function uni_duplicate_post_as_draft(){
    global $wpdb;
    if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'uni_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
      	wp_die('No post to duplicate has been supplied!');
    }

    /*
     * Nonce verification
     */
    if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
  	return;

    /*
     * get the original post id
     */
    $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
    /*
     * and all the original post data then
     */
    $post = get_post( $post_id );

    /*
     * if you don't want current user to be the new post author,
     * then change next couple of lines to this: $new_post_author = $post->post_author;
     */
    $current_user = wp_get_current_user();
    $new_post_author = $current_user->ID;

    /*
     * if post data exists, create the post duplicate
     */
    if (isset( $post ) && $post != null) {

	    /*
	     * new post data array
	     */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);

		/*
		* insert the post by wp_insert_post() function
		*/
		$new_post_id = wp_insert_post( $args );

		/*
		* get all current post terms ad set them to the new post draft
		*/
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}

	    /*
	     * duplicate all post meta just in two SQL queries
	     */
	    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
	    if (count($post_meta_infos)!=0) {
	        $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
	        foreach ($post_meta_infos as $meta_info) {
	            $meta_key = $meta_info->meta_key;
	            if( $meta_key == '_wp_old_slug' ) continue;
	            $meta_value = addslashes($meta_info->meta_value);
	            $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
	        }
	        $sql_query.= implode(" UNION ALL ", $sql_query_sel);
	        $wpdb->query($sql_query);
	    }

	    /*
	     * finally, redirect to the edit post screen for the new draft
	     */
	    wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
	    exit;
    } else {
        wp_die('Post creation failed, could not find original post: ' . $post_id);
    }
}
add_action( 'admin_action_uni_duplicate_post_as_draft', 'uni_duplicate_post_as_draft' );

/*
 * Add the duplicate link to action list for post_row_actions
 */
function uni_duplicate_post_link( $actions, $post ) {
    if (current_user_can('edit_posts')) {
        $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=uni_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="'.__('Duplicate this item','shtheme').'" rel="permalink">'.__('Duplicate','shtheme').'</a>';
    }
    return $actions;
}

add_filter( 'post_row_actions', 'uni_duplicate_post_link', 10, 2 );
add_filter('page_row_actions', 'uni_duplicate_post_link', 10, 2);

function create_uni_copyright_shortcode( $atts, $content ) {
	extract( shortcode_atts( array(
		'name'   => '',
	), $atts ) );
    $content .= '©' . do_shortcode( '[ux_current_year]' ).' ';
    $content .= sprintf( __('Copyright belong to <span>%s</span><span class="hide-for-medium"> - </span><br class="show-for-medium"><a href="https://univn.vn/thiet-ke-website-tron-goi/" target="_blank" rel="nofollow">Design</a> by <a href="https://univn.vn/" target="_blank" rel="nofollow">Uni Creation</a>','shtheme'),$name );
	return $content;
}
add_shortcode('uni_copyright', 'create_uni_copyright_shortcode');

/*
 * Responsive video youtube content
 */
function responsive_video_youtube_content($content) {
	// match any iframes
	/*$pattern = '~<iframe.*</iframe>|<embed.*</embed>~'; // Add it if all iframe*/
	$pattern = '~<iframe.*src=".*(youtube.com|youtu.be).*</iframe>|<embed.*</embed>~'; //only iframe youtube
	preg_match_all($pattern, $content, $matches);
	foreach ($matches[0] as $match) {
		// wrap matched iframe with div
		$wrappedframe = '<div class="video video-fit mb" style="padding-top:56.25%;">' . $match . '</div>';
		//replace original iframe with new in content
		$content = str_replace($match, $wrappedframe, $content);
	}
	return $content; 
}
// add_filter('the_content', 'responsive_video_youtube_content');

function uni_get_image_sizes( $sizes = array() ) {
	$image_sizes      = get_intermediate_image_sizes();
	$additional_sizes = wp_get_additional_image_sizes();

	$sizes['original'] = __( 'Original', 'flatsome' );

	foreach ( $image_sizes as $key ) {
	if ( isset( $additional_sizes[ $key ] ) ) {
		$width  = $additional_sizes[ $key ]['width'];
		$height = $additional_sizes[ $key ]['height'];
	} else {
		$width  = get_option( $key . '_size_w' );
		$height = get_option( $key . '_size_h' );
	}

	$name = ucfirst( str_replace( '_', ' ', $key ) );
	$size = join( 'x', array_filter( array( $width, $height ) ) );

	if ( $size != $key ) {
		$name .= " ($size)";
	}

	$sizes[ $key ] = $name;
	}

	if ( is_woocommerce_activated() ) {
		foreach ( array( 'shop_catalog', 'shop_single', 'shop_thumbnail' ) as $key ) {
			if ( array_key_exists( $key, $sizes ) ) {
				unset( $sizes[ $key ] );
			}
		}
	}

	return $sizes;
}

function univn_check_spam_form_cf7($html){
    $html = '<div style="display: none"><p><span class="wpcf7-form-control-wrap" data-name="univn"><input size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" value="" type="text" name="univn"></span></p></div>' . $html;
    return $html;
}
add_filter('wpcf7_form_elements', 'univn_check_spam_form_cf7');

function univn_check_spam_form_cf7_vaild($posted_data) {
    $submission = WPCF7_Submission::get_instance();
    if (!empty($posted_data['univn'])) {
        $submission->set_status( 'spam' );
        $submission->set_response( 'You are Spamer' );
    }
    unset($posted_data['univn']);
    return $posted_data;
}
add_action('wpcf7_posted_data', 'univn_check_spam_form_cf7_vaild');
