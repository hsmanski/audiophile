<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $woocommerce;
$container = get_theme_mod( 'understrap_container_type' );


do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<div <?php echo esc_attr( $container ); ?>">
	<button class="button checkout-back-btn" onclick="history.back();">Go Back</button>
</div>


<div class="checkout-form-wrapper <?php echo esc_attr( $container ); ?>">
	
	<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

		<?php if ( $checkout->get_checkout_fields() ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div  id="customer_details">
				<div class="form-row checkout-billing">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>

				<div class="form-row checkout-shipping">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>

				
			</div>

			<div class="payment-details-container">
				<h2 class="checkout-sub-heading">Payment Details</h2>
				<div class="payment-details-content">
					<div class="payment-title">
						<h3 class="payment-title">Payment Method</h3>
					</div>
					<div class="payment-form-wrapper">
						<form action="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="payment-methods" method="Post">
							<div class="radio-wrapper btn-1">
								<input type="radio" id="emoney" class="emoney" name="radio" value="e-Money" >
								<label for="e-money">e-Money</label>
							</div>
							<div class="radio-wrapper btn-2">
								<input type="radio" id="cash" class="cash" name="radio" value="Cash on Delivery">
								<label for="cash">Cash on Delivery</label>
							</div>
							
						</form>
					</div>
					
				</div>
				<div class="payment-option-details-container">
				<div class="number-wrapper">
					<div class="row-wrapper">
						<div class="number-option">
							<label for="number">e-Money Number</label>
							<input type="text" name="number" class="number-input" placeholder="238521993">
						</div>
					</div>
					<div class="row-wrapper">
						<div class="pin-option">
							<label for="pin">e-Money PIN</label>
							<input type="text" name="pin" class="pin-input" placeholder="6891">
						</div>
					</div>
				</div>
				<div class="cash-wrapper">
					<img src="<?php echo get_template_directory_uri(); ?>/img/checkout/icon-cash-on-delivery.svg" alt="cash on delivery image" class="cash-delivery-img"></a>
					<p class="cash-on-delivery-text">The 'Cash on Delivery' option enables you to pay in cash when our delivery courier arrives at your residence. Just make sure your address is correct so that your order will not be cancelled.</p>
				</div>
			</div>
				
			</div>

			

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

			

		<?php endif; ?>

		<!-- Mini Cart added to checkout page -->
			<div class="checkout-mini-cart-summary">
		
			<?php if ( ! WC()->cart->is_empty() ) : ?>
				
				<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
					<?php
					do_action( 'woocommerce_before_mini_cart_contents' ); ?>

						<div class="mini-cart-header">
							<p>Summary</p>
							
						</div>

					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
							$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							
							
							<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
								<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_attr__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $cart_item_key ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
								?>
								<?php if ( empty( $product_permalink ) ) : ?>
									<?php echo $thumbnail . wp_kses_post( $product_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php else : ?>
									<a href="<?php echo esc_url( $product_permalink ); ?>">
										<?php echo $thumbnail . wp_kses_post( $product_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</a>
								<?php endif; ?>
								<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $product_price , $cart_item['quantity'] ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								

									
							</li>
							<?php
						}
					}

					do_action( 'woocommerce_mini_cart_contents' );
					?>
				</ul>

				<p class="woocommerce-mini-cart__total total">
					<?php
					/**
					 * Hook: woocommerce_widget_shopping_cart_total.
					 *
					 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
					 */
					do_action( 'woocommerce_widget_shopping_cart_total' );
					?>
				</p>
				<p class="woocommerce-mini-cart__shipping">
					<!-- shipping hook added here when set up -->
					<strong>Shipping</strong>
					<span>$50</span>
					<!-- <?php wc_cart_totals_shipping_html(); ?> -->
				
				</p>

				<p class="woocommerce-mini-cart__grand_total">
					<!-- Grand Toal hook or function added here when set up -->
					<strong>Grand Toal</strong>
					<span><?php wc_cart_totals_order_total_html(); ?></span>
					
				</p>

				<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

				<p class="woocommerce-mini-cart__buttons buttons">
					<!-- <?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?> -->
					<a href="#" class="continue-pay-btn button">Continue & Pay</a>
				</p>

				<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>

				<!-- <?php woocommerce_checkout_payment() ?> -->

				

			<?php else : ?>

				<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

			<?php endif; ?>


		</div>
	</div>
		

	</form>
	
	

<?php
do_action( 'woocommerce_after_checkout_form', $checkout );
