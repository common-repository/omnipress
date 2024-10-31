<?php

/**
 * Add to cart frontend content.
 */

defined( 'ABSPATH' ) || exit;

$product_id   = $product->get_id();
$product_type = $product->get_type();

if ( ! is_single() && ! is_page() ) {
	return;
}



ob_start();

?>

<form class="op-block__add-to-cart op-block-<?php echo esc_attr( $blockId ); ?>  cart grouped_form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
	<table cellspacing="10" class="woocommerce-grouped-product-list group_table">
		<thead>
			<tr>
				<th><?php echo esc_html__( 'Name', 'omnipress' ); ?></th>
				<th><?php echo esc_html__( 'price', 'omnipress' ); ?></th>
				<th><?php echo esc_html__( 'Quantity', 'omnipress' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$quantites_required      = false;
			$previous_post           = $post;
			$grouped_product_columns = apply_filters(
				'woocommerce_grouped_product_columns',
				array(
					'label',
					'price',
					'quantity',
				),
				$product
			);
			$show_add_to_cart_button = false;

			do_action( 'woocommerce_grouped_product_list_before', $grouped_product_columns, $quantites_required, $product );

			foreach ( $grouped_products as $grouped_product_child ) {
				$group_child        = wc_get_product( $grouped_product_child );
				$post_object        = get_post( $grouped_product_child );
				$quantites_required = $quantites_required || ( $group_child->is_purchasable() && ! $group_child->has_options() );

				$post = $post_object; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				setup_postdata( $post );

				if ( $group_child->is_in_stock() ) {
					$show_add_to_cart_button = true;
				}

				echo ' <tr id="product-' . esc_attr( $grouped_product_child ) . '" class="woocommerce-grouped-product-list-item ' . esc_attr( implode( ' ', wc_get_product_class( '', $group_child ) ) ) . '">';

				// Output columns for each product.
				foreach ( $grouped_product_columns as $column_id ) {
					do_action( 'woocommerce_grouped_product_list_before_' . $column_id, $grouped_product_child );

					switch ( $column_id ) {
						case 'label':
							$value  = '<label for="product-' . esc_attr( $grouped_product_child ) . '">';
							$value .= $group_child->is_visible() ? '<a class="op-block__add-to-cart--child-label" href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', $group_child->get_permalink(), $group_child ) ) . '">' . $group_child->get_name() . '</a>' : $group_child->get_name();
							$value .= '</label>';
							break;

						case 'quantity':
							ob_start();

							echo '<div class="op-block__add-to-cart--child-count count-wrapper">
							<a class="cart_value-down" unselectable="unselectable"><span class="next-number-picker-handler next-number-picker-handler-down-inner" > - </span></a>';
							if ( ! $group_child->is_purchasable() || $group_child->has_options() || ! $group_child->is_in_stock() ) {
								woocommerce_template_loop_add_to_cart();
							} elseif ( $group_child->is_sold_individually() ) {
								echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product_child . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" id="' . esc_attr( 'quantity-' . $grouped_product_child ) . '" />';
								echo '<label for="' . esc_attr( 'quantity-' . $grouped_product_child ) . '" class="screen-reader-text">' . esc_html__( 'Buy one of this item', 'woocommerce' ) . '</label>';
							} else {
								do_action( 'woocommerce_before_add_to_cart_quantity' );

								woocommerce_quantity_input(
									array(
										'input_name'  => 'quantity[' . $grouped_product_child . ']',
										'input_value' => isset( $_POST['quantity'][ $grouped_product_child ] ) ? wc_stock_amount( wc_clean( wp_unslash( $_POST['quantity'][ $grouped_product_child ] ) ) ) : '', // phpcs:ignore WordPress.Security.NonceVerification.Missing
										'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $group_child ),
										'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $group_child->get_max_purchase_quantity(), $group_child ),
										'placeholder' => '0',
									)
								);

								do_action( 'woocommerce_after_add_to_cart_quantity' );
							}
							echo '<a class="cart_value-up next-number-picker-handler next-number-picker-handler-up" ><span class="next-number-picker-handler-up-inner"> + </span> </a></div>';

							$value = ob_get_clean();
							break;

						case 'price':
							$value = get_woocommerce_currency_symbol() . $group_child->get_price() . wc_get_stock_html( $group_child );
							break;
						default:
							$value = '';
							break;
					}

					echo '<td class="woocommerce-grouped-product-list-item__' . esc_attr( $column_id ) . '">' . apply_filters( 'woocommerce_grouped_product_list_column_' . $column_id, $value, $grouped_product_child ) . '</td>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

					do_action( 'woocommerce_grouped_product_list_after_' . $column_id, $grouped_product_child );
				}

				echo '</tr>';
			}
			$post = $previous_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			setup_postdata( $post );

			do_action( 'woocommerce_grouped_product_list_after', $grouped_product_columns, $quantites_required, $product );
			?>
		</tbody>
	</table>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

	<?php if ( $quantites_required && $show_add_to_cart_button ) : ?>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<button type="submit" class="single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>
</form>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php

do_action( 'woocommerce_product_meta_start' );
$content = ob_get_contents();
ob_end_clean();


echo $content;
