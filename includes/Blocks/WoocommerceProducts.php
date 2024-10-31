<?php

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;

/**
 * WoocommerceProducts Class.
 */
abstract class WoocommerceProducts extends AbstractBlock {

	/**
	 * @var \WC_Product[]
	 */
	private array $products;

	/**
	 * @var array
	 */
	private array $query_args;

	/**
	 * Fetch all Woocommerce products.
	 *
	 * @return void
	 * @throws \Exception Throw an error if query args are not set.
	 */
	public function set_Products() {
		if ( class_exists( 'Products' ) ) {
			if ( ! function_exists( 'wc_get_products' ) ) {
				include_once WC()->plugin_path() . '/includes/wc-core-functions.php';
			}
		}

		if ( ! $this->query_args ) {
			throw new \Exception( 'Query arguments are not set' );
		}
		$args = $this->query_args;

		$this->products = wc_get_products( $args );
	}

	/**
	 * Get Product according to Query arguments.
	 *
	 * @return \WC_Product[]
	 */
	public function get_products() {
		return $this->products ?? array();
	}

	/**
	 * Set Query arguments.
	 *
	 * @param string $key query argument key.
	 * @param mixed  $value query argument value.
	 * @return void
	 */
	public function set_single_query_args( $key, $value ) {
		$this->query_args[ $key ] = $value;
	}


	/**
	 * Set Query arguments.
	 *
	 * @param array $args query arguments.
	 *
	 * @return void
	 */
	public function set_query_args( array $args ) {
		$this->query_args = $args;
	}

	/**
	 * Get Query arguments.
	 *
	 * @return array
	 */
	public function get_query_args() {
		return $this->query_args;
	}

	/**
	 * Get Categories lists for a product.
	 *
	 * @param  \WC_Product[] $product_slugs The product object.
	 * @return array|string[] Array of product list names.
	 * @throws \Exception Throw an error if Woocommerce is not installed.
	 */
	public function get_handpicked_products( array $product_slugs ) {
		$products = array();
		foreach ( $product_slugs as $slug ) {
			$product_id = get_page_by_path( $slug, OBJECT, 'product' )->ID;
			$products[] = wc_get_product( $product_id );
		}

		return $products;
	}
}
