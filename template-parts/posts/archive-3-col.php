<?php if ( have_posts() ) : ?>

<?php
	// Create IDS
	$ids = array();
	while ( have_posts() ) : the_post();
		array_push($ids, get_the_ID());
	endwhile; // end of the loop.
	$ids = implode(',', $ids);
?>

	<?php
	echo flatsome_apply_shortcode( 'blog_posts', array(
		'type'        => get_theme_mod( 'blog_style_type', 'masonry' ),
		'depth'       => get_theme_mod( 'blog_posts_depth', 0 ),
		'depth_hover' => get_theme_mod( 'blog_posts_depth_hover', 0 ),
		'text_align'  => get_theme_mod( 'blog_posts_title_align', 'center' ),
		'columns'     => '3',
		'columns__sm' => '1',
		'columns__md' => '2',
		'col_spacing' => '',
		'show_date'   => get_theme_mod( 'blog_badge', 1 ) ? 'true' : 'false', // badge, text
		'ids'         => $ids,
		// 'excerpt' => 'false',
		// 'excerpt_length' => 20,
		'image_size'  => 'large',
		'image_width' => '',
		'image_height' => '62%',
		'image_hover' => 'zoom',
		'readmore' => __('Read more','shtheme'),
		'readmore_style' => 'link',
		// 'class' => '',
	) );
	?>

<?php flatsome_posts_pagination(); ?>

<?php else : ?>

	<?php get_template_part( 'template-parts/posts/content','none'); ?>

<?php endif; ?>
