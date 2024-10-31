<?php

namespace Omnipress\RestApi\Controllers\V1;

use Omnipress\Abstracts\RestControllersBase;

/**
 * Changelog Controller class.
 */
final class ChangelogController extends RestControllersBase {
	public function fetch_changelog() {
		$url = 'https://plugins.svn.wordpress.org/omnipress/trunk/changelog.txt';

		$response = wp_remote_get( $url );

		if ( is_wp_error( $response ) ) {
			return 'Error fetching content';
		} else {
			$body = wp_remote_retrieve_body( $response );
			return $body;
		}
	}


	public function register_routes() {
		$this->register_rest_route(
			array(
				'methods'             => \WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'fetch_changelog' ),
				'permission_callback' => array( $this, 'update_item_permissions_check' ),
			),
		);
	}
}
