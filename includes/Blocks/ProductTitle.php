<?php

declare( strict_types=1 );

namespace Omnipress\Blocks;

/**
 * Woocommerce Product Title Block.
 */
class ProductTitle {

	/**
	 * Render block's frontend content.
	 *
	 * @param array  $attributes Block Attributes.
	 * @param string $content    Block Content.
	 * @return string
	 */
	public static function render_view( array $attributes, string $content ): string {
		$product_title = self::render_title( $attributes['productId'] ?? 0 );

		if ( ! $product_title ) {
			return '';
		}
		return str_replace( 'Product Title', $product_title, $content );
	}

	/**
	 * Render current product title.
	 *
	 * @param int|null $product_id current product id.
	 * @return string|bool
	 */
	private static function render_title( ?int $product_id ) {
		global $product;

		if ( ! is_product() ) {
			$product = wc_get_product( $product_id );
		}

		return ! $product ? false : $product->get_title();
	}
}
