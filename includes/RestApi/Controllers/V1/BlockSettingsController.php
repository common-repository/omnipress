<?php

namespace Omnipress\RestApi\Controllers\V1;

use Omnipress\Abstracts\RestControllersBase;
use Omnipress\Models\BlocksSettingsModel;

class BlockSettingsController extends RestControllersBase {

	/**
	 * @param string $option_name
	 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
	 */
	public function get_settings( $option_name ) {
		return BlocksSettingsModel::get_settings( $option_name );
	}

	/**
	 * @param $data
	 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
	 */
	public function save_settings( $data ) {
		return BlocksSettingsModel::save_settings( $data );
	}

	/**
	 * @param $request
	 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
	 */
	public function delete_setting( $request ) {
		return BlocksSettingsModel::delete_settings( $request );
	}

	/**
	 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
	 */
	public function get_blocks_lists() {
		return BlocksSettingsModel::get_blocks_lists();
	}

	/**
	 * Register the routes for the objects of the controller.
	 *
	 * @return void
	 */
	public function register_routes() {
		$this->register_rest_route(
			array(
				'methods'             => \WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'save_settings' ),
				'permission_callback' => array( $this, 'update_item_permissions_check' ),
			),
		);

		$this->register_rest_route(
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_settings' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
			),
		);

		$this->register_rest_route(
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_blocks_lists' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
			),
			'blocks'
		);

		$this->register_rest_route(
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => array( BlocksSettingsModel::class, 'user_can_edit_block_settings' ),
				'permission_callback' => function () {
					return true;
				},
			),
			'can-edit'
		);

		$this->register_rest_route(
			array(
				'methods'             => \WP_REST_Server::CREATABLE,
				'callback'            => array( BlocksSettingsModel::class, 'update_disable_blocks' ),
				'permission_callback' => array( $this, 'update_item_permissions_check' ),
				'args'                => array(
					'block_name' => array(
						'validate_callback' => function ( $param ) {
							return is_string( $param ) && ! empty( $param );
						},
						'sanitize_callback' => 'sanitize_text_field',
						'description'       => 'The name of the block to be added or removed.',
					),
					'action'     => array(
						'required'          => true,
						'validate_callback' => function ( $param ) {
							return in_array( $param, array( 'add', 'remove', 'can-edit' ), true );
						},
						'description'       => 'The action to perform: "add" to add the block, "remove" to remove the block.',
					),
				),
			),
			'blocks/disabled'
		);

		$this->register_rest_route(
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => array( BlocksSettingsModel::class, 'get_disabled_blocks' ),
				'permission_callback' => array( $this, 'update_item_permissions_check' ),
			),
			'blocks/disabled'
		);
		$this->register_rest_route(
			array(
				'methods'             => \WP_REST_Server::DELETABLE,
				'callback'            => array( BlocksSettingsModel::class, 'enable_all_blocks' ),
				'permission_callback' => array( $this, 'update_item_permissions_check' ),
			),
			'blocks/disabled'
		);

		$this->register_rest_route(
			array(
				'methods'             => \WP_REST_Server::DELETABLE,
				'callback'            => array( $this, 'delete_setting' ),
				'permission_callback' => array( $this, 'delete_item_permissions_check' ),
			),
		);
	}
}
