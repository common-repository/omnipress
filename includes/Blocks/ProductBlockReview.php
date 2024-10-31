<?php


namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;

/**
 * Woocommerce Product Title Block.
 */
class ProductBlockReview extends ProductBlockAbstract {

	/**
	 * {@inheritdoc}
	 *
	 * This property inherits its documentation from the parent class.
	 */
	public static function render_view( $attributes, $content ) {
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
	private static function render_content( $product_id, $content_type ) {
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
	private static function get_category( $product_id ) {
		return get_the_terms( $product_id, 'product_cat' );
	}
}
