<?php

declare( strict_types=1 );

namespace Omnipress\Blocks;

use Omnipress\Helpers;

/**
 * Single Product Content.
 */
class ProductContent {
	/**
	 * Render block's frontend content.
	 *
	 * @param array  $attributes Block Attributes.
	 * @param string $content    Block Content.
	 * @return string
	 */
	public static function render_view( array $attributes, string $content = '' ): string {
		global $product;

		$product_title = self::render_title( $attributes['productId'] ?? 0 );

		if ( ! $product_title ) {
			return '';
		}

		$slug = $attributes['slug'];

		$inner_text = self::get_content( $product, $attributes );

		return self::render_view_content( $attributes, $product, $inner_text, $content );
	}

	/**
	 * Get content according to product block type.
	 *
	 * @param \WC_Product $product Woocommerce Product.
	 * @param array       $attributes Block's attributes.
	 * @return false|string
	 */
	public static function get_content( $product, $attributes ) {
		$id   = $product->get_id();
		$slug = $attributes['slug'];

		switch ( $slug ) {
			case 'product-short-description':
				return $product->get_short_description();
			case 'product-description':
				return $product->get_description();
			case 'product-sku':
				return $product->get_sku();
			case 'product-category':
				return Helpers::get_woocommerce_category_by_product_id( $id );
			case 'product-regular_price':
				return self::get_price( $product );
			case 'product-sale_price':
				return self::get_price( $product, 'sale_price' );
			default:
				return $product->get_title();
		}
	}

	/**
	 *
	 */
	public static function get_price( $product, $price_type = 'regular_price' ) {
		$currency_symbol = get_woocommerce_currency_symbol();
		$method_name     = 'get_' . $price_type;
		return $currency_symbol . $product->{$method_name}();
	}

	/**
	 * Render frontend contents.
	 *
	 * @param array       $attributes Block's attributes.
	 * @param \WC_Product $product current product.
	 * @param string      $inner_text current product's content type value.
	 * @return string
	 */
	public static function render_view_content( $attributes, $product, $inner_text = '', $content = '' ) {
		$contents = array(
			'slug'        => $attributes['slug'],
			'innerText'   => $inner_text,
			'blockId'     => $attributes['blockId'],
			'headingType' => $attributes['headingType'],
			'hasLink'     => $attributes['hasLink'],
			'productId'   => $attributes['productId'] ?? null,
			'product'     => $product,
			'content'     => $content,
		);

		if ( ! empty( $contents['hasLink'] ) ) {
			$contents['link']       = $contents['product']->get_permalink();
			$contents['linkTarget'] = $contents['product']->get_permalink();
			$contents['rel']        = 'nofollow';
			$contents['target']     = '_blank';
			$contents['ariaLabel']  = $contents['product']->get_title();

			$contents['linkId'] = 'omnipress-link-' . $contents['blockId'];
		}

		return self::get_render_view_contents( $contents );
	}


	/**
	 * Render block's frontend content.
	 *
	 * @param array $contents dynamic content which render inside templates.
	 * @return string
	 */
	public static function get_render_view_contents( $contents = array() ) {
		ob_start();

		if ( is_array( $contents ) && ! empty( $contents ) ) {
			foreach ( $contents as $key => $value ) {
				if ( ! isset( $contents[ $key ] ) ) {
					$contents[ $key ] = '';
				}

				$$key = $contents[ $key ];
			}
		}

		if ( $contents['hasLink'] ) {
			include OMNIPRESS_PATH . 'templates/single-product/product-content-with-link.php';
		} else {
			include OMNIPRESS_PATH . 'templates/single-product/product-content.php';
		}

		return ob_get_clean();
	}

	/**
	 * Render current product title.
	 *
	 * @param int|null $product_id current product id.
	 * @return string|bool
	 */
	private static function render_title( $product_id ) {
		global $product;

		if ( ! is_product() ) {
			$product = wc_get_product( $product_id );
		}

		return ! $product ? false : $product->get_title();
	}
}
