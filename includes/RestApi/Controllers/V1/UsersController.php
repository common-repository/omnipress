<?php

namespace Omnipress\RestApi\Controllers\V1;

use Omnipress\Abstracts\RestControllersBase;
use Omnipress\Models\UsersModel;

class UsersController extends RestControllersBase {
	public function get_roles() {
		return UsersModel::get_roles();
	}

	/**
	 * {@inheritdoc}
	 */
	public function register_routes() {
		$this->register_rest_route(
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_roles' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
			),
		);
	}
}
