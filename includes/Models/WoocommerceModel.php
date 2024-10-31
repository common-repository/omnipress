<?php

namespace Omnipress\Models;

use Omnipress\Transient;

( defined( 'ABSPATH' ) ) || exit;

/**
 * WoocommerceModel class to handle all woocommerce related functionalities.
 */
class WoocommerceModel {

	private static $instance = null;
	private array $query_params;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new static();
		}
		return self::$instance;
	}

	private function __construct() {
		if ( ! class_exists( 'Woocommerce' ) ) {
			exit; // early exit if Product class not found.
		}
	}

	public function get_all_categories( $args = array() ) {
		$default_args = array(
			'orderby'      => 'name',
			'order'        => 'ASC',
			'taxonomy'     => 'product_cat',
			'show_count'   => 0,
			'pad_counts'   => 0,
			'hierarchical' => 1,
			'title_li'     => '',
			'hide_empty'   => 0,
			'number'       => 4,
			'parent'       => 0,
			'offset'       => 0,
		);

		$args      = wp_parse_args( $args, $default_args );
		$cache_key = 'categories_' . md5( wp_json_encode( $args ) );
		$transient = new Transient( $cache_key );

		$cached_categories = $transient->get();

		if ( false !== $cached_categories ) {
			return $cached_categories;
		}

		$terms = get_categories( $args );
		$transient->set( $terms );

		return $terms;
	}
	private function format_product_data( \WC_Product $product ) {
		$regular_price       = $product->get_regular_price();
		$sale_price          = $product->get_sale_price();
		$discount_percentage = 0;

		if ( $sale_price && $regular_price ) {
			$discount_percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
		}
		return array(
			'id'                  => $product->get_id(),
			'name'                => $product->get_name(),
			'description'         => $product->get_description(),
			'short_description'   => $product->get_short_description(),
			'sku'                 => $product->get_sku(),
			'stock_status'        => $product->get_stock_status(),
			'price'               => $product->get_price(),
			'regular_price'       => $product->get_regular_price(),
			'sale_price'          => $product->get_sale_price(),
			'price_html'          => $product->get_price_html(),
			'discount_percentage' => $discount_percentage,
			'currency'            => get_woocommerce_currency(),
			'currency_symbol'     => get_woocommerce_currency_symbol(),
			'categories'          => wp_get_post_terms( $product->get_id(), 'product_cat', array( 'fields' => 'names' ) ),
			'tags'                => wp_get_post_terms( $product->get_id(), 'product_tag', array( 'fields' => 'names' ) ),
			'images'              => array_map(
				function ( $image_id ) {
					return array(
						'src' => wp_get_attachment_url( $image_id ),
						'alt' => get_post_meta( $image_id, '_wp_attachment_image_alt', true ),
					);
				},
				$product->get_gallery_image_ids()
			),
			'thumbnail'           => $product->get_image(
				'woocommerce_thumbnail',
				array(
					'class' => 'op-product-thumbnail op-woo__media-wrapper-img',
				)
			),
			'attributes'          => $product->get_attributes(),
			'variations'          => $product->is_type( 'variable' ) ? $product->get_children() : array(),
			'is_in_stock'         => $product->is_in_stock(),
			'is_on_sale'          => $product->is_on_sale(),
			'average_rating'      => $product->get_average_rating(),
			'review_count'        => $product->get_review_count(),
			'featured'            => $product->is_featured(),
			'type'                => $product->get_type(),
			'add_to_cart'         => $product->add_to_cart_url(),
			'add_to_cart_text'    => $product->add_to_cart_text(),
			'permalink'           => $product->get_permalink(),
		);
	}


	/**
	 * Retrieve all products.
	 *
	 * @since 1.4.0
	 * @param array $args Arguments for the query.
	 * @return array|mixed
	 */
	public function get_all_products( $args ) {
		// $args = array(
		// 'limit'   => $args['posts_per_page'] ?? 6,
		// 'orderby' => $args['orderby'] ?? 'date',
		// 'order'   => $args['order'] ?? 'DESC',
		// 'page'    => $args['page'] ?? 1,
		// 'offset'  => $args['offset'] ?? 0,
		// 'status'  => 'publish',
		// );

		$products = wc_get_products( $args );

		$formatted_products = array();

		foreach ( $products as $product ) {
			$formatted_products[] = $this->format_product_data( $product );
		}

		return $formatted_products;
	}

	public function get_product( $id ) {
		return wc_get_product( $id );
	}

	/**
	 * Get the product categories.
	 *
	 * @param int $product_id Product ID.
	 * @return array
	 */
	public function get_product_categories( $product_id ) {
		return wc_get_product_term_ids( $product_id, 'product_cat' );
	}

	/**
	 * Get the product tags.
	 *
	 * @param int $product_id Product ID.
	 * @return array
	 */
	public function get_product_tags( $product_id ) {
		return wc_get_product_term_ids( $product_id, 'product_tag' );
	}

	/**
	 * Get the product type.
	 *
	 * @param int $product_id Product ID.
	 * @return string
	 */
	public function get_product_type( $product_id ) {
		return get_post_meta( $product_id, '_product_type', true );
	}

	/**
	 * Get the product cross sells.
	 *
	 * @param int $product_id Product ID.
	 * @return array
	 */
	public function get_product_cross_sells( $product_id ) {
		return get_post_meta( $product_id, '_crosssell_ids', true );
	}

	/**
	 * Get the product upsells.
	 *
	 * @param int $product_id Product ID.
	 * @return array
	 */
	public function get_product_up_sells( $product_id ) {
		return get_post_meta( $product_id, '_upsell_ids', true );
	}

	/**
	 * Get the product related products.
	 *
	 * @param int $product_id Product ID.
	 * @return array
	 */
	public function get_product_related( $product_id ) {
		return get_post_meta( $product_id, '_related_product_ids', true );
	}

	/**
	 * Get the product variations.
	 *
	 * @param int $product_id Product ID.
	 * @return array
	 */
	public function get_product_variations( $product_id ) {
		return get_post_meta( $product_id, '_product_attributes', true );
	}

	/**
	 * Get the product variations.
	 *
	 * @param int $product_id Product ID.
	 * @return array
	 */
	public function get_product_custom_fields( $product_id ) {
		return get_post_meta( $product_id, '_product_custom_fields', true );
	}
}
