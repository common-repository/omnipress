<?php

namespace Omnipress\RestApi\Controllers\V1;

use Omnipress\Abstracts\RestControllersBase;
use Omnipress\Models\WoocommerceModel;

( defined( 'ABSPATH' ) ) || exit;

/**
 * WoocommerceController class to handle woocommerce related functionalities.
 */
class WoocommerceController extends RestControllersBase {
	/**
	 * {@inheritDoc}
	 */
	public function register_routes() {
		$this->register_rest_route(
			array(
				array(
					'methods'             => \WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_all_products' ),
					'permission_callback' => array( $this, 'get_items_permissions_check' ),
				),
			),
			'products'
		);

		$this->register_rest_route(
			array(
				array(
					'methods'             => \WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_all_categories' ),
					'permission_callback' => array( $this, 'get_items_permissions_check' ),
				),
			),
			'categories'
		);
	}

	/**
	 * Get Woocommerce products.
	 *
	 * @param \WP_REST_Request $request Request object.
	 * @return object|array
	 */
	public function get_all_products( $request ) {
		$args     = $this->sanitize_all_params( $request->get_params() );
		$wc_modal = WoocommerceModel::get_instance();

		$args = array(
			'limit'               => $args['posts_per_page'],
			'offset'              => $args['offset'] ?? 0,
			'order'               => $args['order'] ?? 'DESC',
			'orderby'             => $args['orderby'] ?? 'date',
			'product_category_id' => isset( $args['category'] ) ? array( $args['category'] ) : array(),
		);

		return $wc_modal->get_all_products( $args );
	}

	/**
	 * Get all Woocommerce products.
	 *
	 * @param \WP_REST_Request $request Request object.
	 * @return object|array
	 */
	public function get_all_categories( \WP_REST_Request $request ) {
		$params   = $request->get_params();
		$wc_modal = WoocommerceModel::get_instance();
		$params   = $this->sanitize_all_params( $request->get_params() );

		return $wc_modal->get_all_categories( $params );
	}

	/**
	 * Sanitize all params.
	 *
	 * @param array $params Params.
	 * @return array
	 */
	public function sanitize_all_params( $params ) {

		return $params;
	}
}
