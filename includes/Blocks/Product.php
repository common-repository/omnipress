<?php

declare( strict_types=1 );

namespace Omnipress\Blocks;

/**
 * Woocommerce Product Title Block.
 */
class Product {

	/**
	 * Render block's frontend content.
	 *
	 * @param array  $attributes Block Attributes.
	 * @param string $content    Block Content.
	 * @return string
	 */
	public static function render_view( array $attributes, string $content ): string {
		global $product, $post;


		return '';

		do_action( "omnipress_product_{$attributes['metaType']}_before_render" );

		if ( 'category' === $attributes['metaType'] ) {
			$product_meta = self::get_category( $attributes['productId'] )[0]->name;
			$product_meta = "<strong style='text-transform:uppercase;'>Category </strong> : " . $product_meta;
		} else {
			$product_meta = self::render_content( $attributes['productId'] ?? 0, $attributes['metaType'] );
		}
		if ( ! $product_meta ) {
			return 'Not found';
		}

		return str_replace( 'Product meta', $product_meta, $content );
	}

	/**
	 * Render current product title.
	 *
	 * @param int|null $product_id current product id.
	 * @param string   $content_type content type.
	 * @return string|bool
	 */
	private static function render_content( ?int $product_id, string $content_type ): string|bool {
		global $product, $post;

		if ( ! is_product() ) {
			$product = wc_get_product( $product_id );
		}

		$callback = "get_$content_type";

		return ! $product ? false : "<strong style='text-transform:uppercase;'>  $content_type </strong> : " . call_user_func( array( $product, "{$callback}" ) ) ?? false;
	}

	/**
	 * Get product category.
	 *
	 * @param int $product_id Product id .
	 * @return \WP_Error|false|\WP_Term[]
	 */
	private static function get_category( int $product_id ): bool|\WP_Error|array {
		return get_the_terms( $product_id, 'product_cat' );
	}
}
