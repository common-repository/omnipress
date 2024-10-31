<?php
namespace Omnipress\Blocks;

/**
 * Class WpFormsExtender.
 */
class WpFormsExtender {

	/**
	 * Constructor for the class.
	 *
	 * Registers the 'rest_api_init' action with the 'register_rest_routes'
	 * method of the current class. This ensures that the 'register_rest_routes'
	 * method is called when the REST API is initialized.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( __CLASS__, 'register_rest_routes' ) );
	}

	/**
	 * Retrieve all available WPForms.
	 *
	 * @return int[]|WP_Post[]
	 */
	public static function get_all_wpforms_fields(): array {
		return get_posts(
			array(
				'numberposts' => -1,
				'post_type'   => 'wpforms',
			)
		);
	}


	/**
	 * Retrieves all WPForms posts by the given ID.
	 *
	 * @param WP_REST_Request $request The REST request object.
	 * @return int[]|\WP_Post[] An array of WP_Post objects representing the WPForms posts.
	 */
	public function get_all_wpforms_by_id( WP_REST_Request $request ) {
		$id = $request->get_param( 'id' );

		return get_posts(
			array(
				'numberposts' => -1,
				'post_type'   => 'wpforms',
				'include'     => $id,
			)
		);
	}



	/**
	 * Register REST API routes for WPForms.
	 *
	 * @return void
	 */
	public static function register_rest_routes(): void {
		register_rest_route(
			'omnipress/v1',
			'/forms',
			array(
				'methods'             => 'GET',
				'callback'            => array( __CLASS__, 'get_all_wpforms_fields' ),
				'permission_callback' => current_user_can( 'manage_options' ),
			)
		);
	}
}
