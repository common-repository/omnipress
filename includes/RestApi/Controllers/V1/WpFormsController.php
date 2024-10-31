<?php

namespace Omnipress\RestApi\Controllers\V1;

use Omnipress\Abstracts\RestControllersBase;
use Omnipress\Models\WpFormsModal;

/**
 * WPForms rest api controller.
 */
class WpFormsController extends RestControllersBase {

	/**
	 * {@inheritDoc}
	 */
	public function register_routes() {
		$this->register_rest_route(
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_items' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
			),
		);

		$this->register_rest_route(
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_form_markup' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
			),
			'(?P<form_id>\d+)',
		);
	}

	public function get_form_markup( $request ) {
		$callback = new WpFormsModal();
		return $callback->get_contact_form_7_html( $request );
	}

	/**
	 * Retrieves all WPForms fields.
	 *
	 * This function creates a new instance of the WpFormsModal class and calls its
	 * get_all_wpforms_fields() method to retrieve all the WPForms fields.
	 *
	 * @param mixed $request The request object.
	 * @return array An array containing all the WPForms fields.
	 */
	public function get_items( $request ) {
		$callback = new WpFormsModal();
		return $callback->get_all_wpforms_fields();
	}
}
