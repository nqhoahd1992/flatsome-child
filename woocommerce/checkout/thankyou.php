<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see              https://docs.woocommerce.com/document/template-structure/
 * @package          WooCommerce\Templates
 * @version          8.1.0
 * @flatsome-version 3.17.7
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order row">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>
			<div class="large-12 col order-failed">
				<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

				<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
					<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
					<?php if ( is_user_logged_in() ) : ?>
						<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
					<?php endif; ?>
				</p>
			</div>

		<?php else : ?>
    
		<div class="large-4 col">
			<div class="col-inner">
				<div class="order-information">
					<div class="order-information__inner">
						<div class="icon-box featured-box icon-box-center text-center">
							<div class="icon-box-img" style="width: 60px">
								<div class="icon">
									<div class="icon-inner">
										<svg width="61" height="60" viewBox="0 0 61 60" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M44.27 16.74L24.5 36.51L13.73 25.77L9.5 30L24.5 45L48.5 21L44.27 16.74ZM30.5 0C13.94 0 0.5 13.44 0.5 30C0.5 46.56 13.94 60 30.5 60C47.06 60 60.5 46.56 60.5 30C60.5 13.44 47.06 0 30.5 0ZM30.5 54C17.24 54 6.5 43.26 6.5 30C6.5 16.74 17.24 6 30.5 6C43.76 6 54.5 16.74 54.5 30C54.5 43.26 43.76 54 30.5 54Z"/>
										</svg>
									</div>
								</div>
							</div>
							<div class="icon-box-text last-reset">
								<p class="success-color woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><strong><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong></p>
							</div>
						</div>
						<div class="line"></div>
						<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

							<li class="woocommerce-order-overview__order order">
								<?php esc_html_e( 'Order number:', 'woocommerce' ); ?>
								<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
							</li>

							<li class="woocommerce-order-overview__date date">
								<?php esc_html_e( 'Date:', 'woocommerce' ); ?>
								<strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
							</li>

							<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
								<li class="woocommerce-order-overview__email email">
									<?php esc_html_e( 'Email:', 'woocommerce' ); ?>
									<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
								</li>
							<?php endif; ?>

							<li class="woocommerce-order-overview__total total">
								<?php esc_html_e( 'Total:', 'woocommerce' ); ?>
								<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
							</li>

							<?php if ( $order->get_payment_method_title() ) : ?>
								<li class="woocommerce-order-overview__payment-method method">
									<?php esc_html_e( 'Payment method:', 'woocommerce' ); ?>
								<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
								</li>
							<?php endif; ?>

						</ul>
					</div>
				</div>
				

				<div class="clear"></div>
			</div>
		</div>

		<div class="large-8 col">
			<div class="col-order-details">
			    <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
				<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
			</div>
	    </div>

		<?php endif; ?>

	<?php else : ?>

		<?php if ( fl_woocommerce_version_check( '8.1' ) ) : ?>
			<?php wc_get_template( 'checkout/order-received.php', array( 'order' => false ) ); ?>
		<?php else : ?>
			<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		<?php endif; ?>

	<?php endif; ?>

</div>
