<?php

namespace Omnipress\Models;

defined( 'ABSPATH' ) || exit;
use Omnipress\Abstracts\ModelsBase;
use Omnipress\Helpers;

/**
 * Users Model Class.
 */
class UsersModel extends ModelsBase {

	/**
	 * Callback function to get all roles
	 *
	 * @return \WP_REST_Response|\WP_Error
	 */
	public static function get_roles() {
		global $wp_roles;
		$roles = false;

		$status['is_active'] = false;

		if ( ! class_exists( 'OmnipressPro\Edd\Edd' ) ) {
			return rest_ensure_response( array( 'error' => __( 'Permission denied', 'omnipress' ) ) );
		}

		$edd    = new \OmnipressPro\Edd\Edd();
		$status = $edd->get_license_status();

		if ( $status['is_active'] ) {
			foreach ( $wp_roles->roles as $key => $role ) {
				$roles[ $key ] = $role['name'];
			}
		}

		return rest_ensure_response( $roles );
	}
}
