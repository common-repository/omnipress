<?php

declare(strict_types=1);

namespace Omnipress\Blocks;

use Omnipress\Blocks;
use Omnipress\Helpers;
use Omnipress\WoocommerceBlocks;

/**
 * Add to cart.
 */
class AddToCart {


	private static $instance = false;

	/**
	 * Render block content.
	 *
	 * @param  array  $attributes Block attributes.
	 * @param  string $content    Block content.
	 * @return string | null
	 */
	public static function render_block( $attributes, $content ) {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance->get_content( $attributes, $content );
	}

	/**
	 * Retrieve all content for add to cart block.
	 *
	 * @param array  $attributes
	 * @param string $content
	 * @return string|null
	 */
	public function get_content( array $attributes, string $content ) {

		if ( ! is_single() ) {
			return null;
		}
		global $product, $post;

		$args = array(
			'product'    => $product,
			'post'       => $post,
			'blockId'    => $attributes['blockId'],
			'showStock'  => $attributes['showStock'],
			'showBuyNow' => $attributes['showBuyNow'],
		);

		// phpcs:disable
		ob_start();

		if ( 'grouped' === $product->get_type() ) {
			echo $this->get_grouped( array_merge( $args, array( 'grouped_products' => $product->get_children() ) ) );
		}

		echo $this->get_single( $args );
		echo $content;
		echo $this->render_dialog( $args );

		return ob_get_clean();
	}

	/**
	 * Popup modal after added to the cart.
	 *
	 * @param array $args Single product and post.
	 * @return string|null
	 */
	private function render_dialog(  $args ) {
		if ( 'post' !== Helpers::get_request_method() ) {
			return null;
		}

		$cart_items = array();

		if ( ! empty( $_POST ) && isset( $_POST['quantity'] ) && is_array( $_POST['quantity'] ) ) {
			foreach ( wp_unslash( $_POST['quantity'] ) as $key => $value ) {
				if ( ! is_numeric( $value ) ) {
					continue;
				}

					$cart_items[ $key ] = absint( $value );
			}
		} elseif ( isset( $_POST['quantity'] ) && is_string( $_POST['quantity'] ) ) {
			$cart_items[ $args['product']->get_id() ] = absint( $_POST['quantity'] );
		}
		return null;

		/*
		if ( ! empty( $cart_items ) ) {
			return WoocommerceBlocks::render_template(
				'add-to-cart/cart-dialog',
				array_merge(
					$args,
					array(
						'quantities' => $cart_items,
					)
				)
			);
		} else {
			return null;
		}
		*/
		// phpcs:enable
	}


	/**
	 * Get single product add to cart template.
	 *
	 * @param array $args Post and product.
	 *
	 * @return string
	 */
	private function get_single( array $args ): string {
		return WoocommerceBlocks::render_template(
			'add-to-cart/single',
			$args
		);
	}

	/**
	 * Get grouped products add to cart template.
	 *
	 * @param array $args Post and product.
	 * @return string
	 */
	public function get_grouped( array $args ): string {
		return WoocommerceBlocks::render_template(
			'add-to-cart/group',
			$args
		);
	}
}
