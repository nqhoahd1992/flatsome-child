<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see              https://docs.woocommerce.com/document/template-structure/
 * @package          WooCommerce/Templates
 * @version          4.3.0
 * @flatsome-version 3.19.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

$tab_style              = get_theme_mod( 'product_display' );
$review_ratings_enabled = wc_review_ratings_enabled();
?>

<div class="uni-review--wrap">

<?php
$count_ratings = count_ratings( get_the_ID(), 0 );

if( $count_ratings > 0 ) {
	$five = (float)count_ratings( get_the_ID(), 5 );
	$five_percent = floor( $five / $count_ratings * 100 );
	$five_rounding = $five / $count_ratings * 100 - $five_percent;
	$four = (float)count_ratings( get_the_ID(), 4 );
	$four_percent = floor( $four / $count_ratings * 100 );
	$four_rounding = $four / $count_ratings * 100 - $four_percent;
	$three = (float)count_ratings( get_the_ID(), 3 );
	$three_percent = floor( $three / $count_ratings * 100 );
	$three_rounding = $three / $count_ratings * 100 - $three_percent;
	$two = (float)count_ratings( get_the_ID(), 2 );
	$two_percent = floor( $two / $count_ratings * 100 );
	$two_rounding = $two / $count_ratings * 100 - $two_percent;
	$one = (float)count_ratings( get_the_ID(), 1 );
	$one_percent = floor( $one / $count_ratings * 100 );
} else {
	$one = $two = $three = $four = $five = 0;
	$one_percent = $two_percent = $three_percent = $four_percent = $five_percent = 0;
}

$average = 0;
$product = wc_get_product( get_the_ID() );
if( $product ) {
	$average = round($product->get_average_rating(),1);
	$percent = $average/5*100;
}
	
echo '<h4>'. __('Review for','shtheme') .'&nbsp;'. get_the_title() .'<span class="uni-label--count" style="background: rgb(220, 53, 69);">'. $count_ratings .'</span></h4>';
echo '<div class="uni-imf--review">';
	echo '<div class="row row-small align-middle">';
		echo '<div class="col large-4 small-12 medium-12">';
			echo '<div class="uni-point--wrap">';
				echo '<span>'. __('Average Rating Score','shtheme') .'</span><span class="uni-point">'. $average .'/5</span>';
				echo '<div class="list-star">';
					for ($i=0; $i < 5 ; $i++) { 
						echo '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 32 32">
	                        <path fill="none" fill-rule="evenodd" stroke="#ea9d02" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
	                    </svg>';
					}
					echo '<div class="fill-stars" style="width:'. $percent .'%">';
						for ($i=0; $i < 5 ; $i++) { 
							echo '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 32 32">
	                            <path fill="#ea9d02" fill-rule="evenodd" stroke="#ea9d02" stroke-width="1.5" d="M16 1.695l-4.204 8.518-9.401 1.366 6.802 6.631-1.605 9.363L16 23.153l8.408 4.42-1.605-9.363 6.802-6.63-9.4-1.367L16 1.695z"></path>
	                        </svg>';
						}
					echo '</div>';
				echo '</div>';
				if ( 0 === $count_ratings ) {
					echo '<span>' . __( 'There are no reviews yet', 'shtheme' ) . '</span>';
				} elseif ( 1 === $count_ratings ) {
					echo '<span>' . $count_ratings .'&nbsp;'. __( 'review', 'shtheme' ) . '</span>';
				} else {
					echo '<span>' . $count_ratings .'&nbsp;'. __( 'reviews', 'shtheme' ) . '</span>';
				}
			echo '</div>';
		echo '</div>';
		echo '<div class="col large-4 small-12 medium-12 uni-progress--list">';
			echo '<div class="uni-progress--item">
	            <label>5<i class="fas fa-star"></i></label>
	            <div class="uni-progress--bar"><span class="uni-value--rate" style="width: '.$five_percent.'%;"></span></div>
	            <span>'. $five .'</span>
	        </div>';
	        echo '<div class="uni-progress--item">
	            <label>4<i class="fas fa-star"></i></label>
	            <div class="uni-progress--bar"><span class="uni-value--rate" style="width: '.$four_percent.'%;"></span></div>
	            <span>'. $four .'</span>
	        </div>';
	        echo '<div class="uni-progress--item">
	            <label>3<i class="fas fa-star"></i></label>
	            <div class="uni-progress--bar"><span class="uni-value--rate" style="width: '.$three_percent.'%;"></span></div>
	            <span>'. $three .'</span>
	        </div>';
	        echo '<div class="uni-progress--item">
	            <label>2<i class="fas fa-star"></i></label>
	            <div class="uni-progress--bar"><span class="uni-value--rate" style="width: '.$two_percent.'%;"></span></div>
	            <span>'. $two .'</span>
	        </div>';
	        echo '<div class="uni-progress--item">
	            <label>1<i class="fas fa-star"></i></label>
	            <div class="uni-progress--bar"><span class="uni-value--rate" style="width: '.$one_percent.'%;"></span></div>
	            <span>'. $one .'</span>
	        </div>';
		echo '</div>';
		echo '<div class="col large-4 small-12 medium-12">';
			echo '<div class="c-rate__right text-center">';
				echo '<p class="mb-half">'. __('Have you used this product?','shtheme') .'</p>';
				echo '<a class="uni-review--btn button primary lowercase" href="#review_form">'. __('Submit your review','shtheme') .'</a>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</div>';
?>

<div id="reviews" class="woocommerce-Reviews row">

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<div id="review_form_wrapper" class="large-<?php if ( get_comment_pages_count() == 0 || $tab_style == 'sections' || $tab_style == 'tabs_vertical' ) { echo '12'; } else { echo '12'; } ?> col">
			<div id="review_form" class="col-inner">
				<div class="review-form-inner">
				<button type="button" class="close">×</button>
				<?php
				$commenter    = wp_get_current_commenter();
				$comment_form = array(
					/* translators: %s is product title */
					'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'woocommerce' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
					/* translators: %s is product title */
					'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
					'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
					'title_reply_after'    => '</h3>',
					'comment_notes_before' => '',
					'comment_notes_after'  => '',
					'label_submit'         => esc_html__( 'Submit', 'woocommerce' ),
					'logged_in_as'         => '',
					'comment_field'        => '',
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );
				$fields              = array(
					'author' => array(
						'label'    => __( 'Name', 'woocommerce' ),
						'type'     => 'text',
						'value'    => $commenter['comment_author'],
						'required' => $name_email_required,
					),
					'email'  => array(
						'label'    => __( 'Email', 'woocommerce' ),
						'type'     => 'email',
						'value'    => $commenter['comment_author_email'],
						'required' => $name_email_required,
					),
				);

				$comment_form['fields'] = array();

				foreach ( $fields as $key => $field ) {
					$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
					$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

					if ( $field['required'] ) {
						$field_html .= '&nbsp;<span class="required">*</span>';
					}

					$field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

					$comment_form['fields'][ $key ] = $field_html;
				}

				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}

				if ( $review_ratings_enabled ) {
					$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label>';
					$comment_form['comment_field'] .= '<div class="box-form-vote">
					        <label class="rate" data-number="1">
					            <i class="fas fa-star one-star"></i>
					            <span>' . esc_html__( 'Very poor', 'woocommerce' ) . '</span>
					        </label>
					        <label class="rate" data-number="2">
					            <i class="fas fa-star two-star"></i>
					            <span>' . esc_html__( 'Not that bad', 'woocommerce' ) . '</span>
					        </label>
					        <label class="rate" data-number="3">
					            <i class="fas fa-star three-star"></i>
					            <span>' . esc_html__( 'Average', 'woocommerce' ) . '</span>
					        </label>
					        <label class="rate" data-number="4">
					            <i class="fas fa-star four-star"></i>
					            <span>' . esc_html__( 'Good', 'woocommerce' ) . '</span>
					        </label>
					        <label class="rate" data-number="5">
					            <i class="fas fa-star five-star"></i>
					            <span>' . esc_html__( 'Perfect', 'woocommerce' ) . '</span>
					        </label>
					</div>';
					$comment_form['comment_field'] .= '<select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
					</select></div>';
				}
				$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
				</div>
			</div>
		</div>

	<?php else : ?>
		<div id="review_form_wrapper" class="large-<?php if ( get_comment_pages_count() == 0 || $tab_style == 'sections' || $tab_style == 'tabs_vertical' ) { echo '12'; } else { echo '5'; } ?> col">
			<div id="review_form" class="col-inner">
				<div class="review-form-inner has-border">
					<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div id="comments" class="col large-<?php if ( get_comment_pages_count() == 0 || $tab_style == 'sections' || $tab_style == 'tabs_vertical' ) { echo '12'; } else { echo '12'; } ?>">

		<?php if ( have_comments() ) : ?>
			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				$pagination = paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => '&larr;',
							'next_text' => '&rarr;',
							'type'      => 'list',
							'echo'      => false,
						)
					)
				);
				$pagination = str_replace( 'page-numbers', 'page-number', $pagination );
				$pagination = str_replace( "<ul class='page-number'>", '<ul class="page-numbers nav-pagination links text-center">', $pagination );
				echo $pagination;
				echo '</nav>';
			endif;
			?>
		<?php else : ?>
			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>
		<?php endif; ?>
	</div>

</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {
	    const REVIEWS = {
	        rating() {
            	jQuery('body').on('click', '.rate', function() {
		            jQuery(this).find('.fas').addClass('checked');
		            jQuery(this).prevAll().find('.fas').addClass('checked');
		            jQuery(this).nextAll().find('.fas').removeClass('checked');
		            jQuery(this).closest("#respond").find("#rating").val(jQuery(this).data('number'));
		        });
            },
            showModal() {
            	jQuery('body').on('click','.uni-review--btn',function(e){
		        	e.preventDefault();
			        jQuery('#review_form').show('fast');
			        jQuery('html').addClass('modal-open');
			    });
            },
            closeModal() {
            	jQuery('body').on('click','#review_form .close',function(){
			        jQuery('#review_form').hide('fast');
			        jQuery('html').removeClass('modal-open');
			    });
            },
	        init() {
	            this.rating();
	            this.showModal();
	            this.closeModal();
	        }
	    }
	    REVIEWS.init();
	});
</script>