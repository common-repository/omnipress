<?php


defined( 'ABSPATH' ) || exit;


if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="op-block__add-to-cart op-block-<?php echo esc_attr( $blockId ); ?> cart simple_form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );
		do_action( 'omnipress_before_add_to_cart_button' );
		?>

	<div class="op-block__add-to-cart--parent-count count-wrapper">
		<a class="cart_value-down next-number-picker-handler" unselectable="unselectable">
			<span class="next-number-picker-handlers next-number-picker-handler-down-inner" > - </span>
		</a>
		<?php
			woocommerce_quantity_input(
				array(
					'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
					'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
					'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
				)
			);
		?>
		<a class="cart_value-up next-number-picker-handler next-number-picker-handler-up" ><span class="next-number-picker-handler-up-inner"> + </span> </a></div>
		<?php do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>

		<?php echo $showStock ?  '<span class="stock-status">' .  esc_html( $product->get_stock_status() ) . '</span>' : ''; ?>

		<div class="op-block__add-to-cart--button-wrapper">
			<?php
			if( $showBuyNow ){
				?>
					<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button add-to-cart alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html( $product->add_to_cart_text() ); ?></button>
				<?php
			}?>

			<button type="submit" name="op-shop--now" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_shop-now--button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html__( 'Buy Now', 'omnipress' ); ?></button>
		</div>


		<?php do_action( 'omnipress_after_add_to_cart_button' ); ?>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>
	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

	<?php
endif;
