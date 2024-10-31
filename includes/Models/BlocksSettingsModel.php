<?php

namespace Omnipress\Models;

use Omnipress\Abstracts\ModelsBase;
use Omnipress\Helpers;
use WP_REST_Request;

class BlocksSettingsModel extends ModelsBase {
	const  TABLE                  = 'op_blocks_settings';
	const DISABLED_BLOCKS_OPTION  = 'op_disabled_blocks';
	const   BLOCK_SETTINGS_OPTION = 'op_block_settings';


	/**
	 * Name of key which save inside option table.
	 *
	 * @var string
	 */
	private static $setting_name;

	/**
	 * Save settings to database.
	 *
	 * @param WP_REST_Request $request
	 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
	 */
	public static function save_settings( WP_REST_Request $request ) {
		$settings           = $request->get_json_params();
		self::$setting_name = $settings['setting_name'];

		$data = array_filter( $settings );

		update_option( self::BLOCK_SETTINGS_OPTION, $settings );// save different setting's with categories.
		return rest_ensure_response( array( 'message' => 'Settings saved successfully!' ) );
	}

	/**
	 * Delete settings from database.
	 *
	 * @param WP_REST_Request $request
	 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
	 */
	public static function delete_settings( WP_REST_Request $request ) {
		$settings = $request->get_param( 'setting_name' );

		delete_option( self::BLOCK_SETTINGS_OPTION );
		return rest_ensure_response( array( 'message' => 'Settings deleted successfully!' ) );
	}

	/**
	 * Get Default settings value from database.
	 *
	 * @param WP_REST_Request $request
	 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
	 */
	public static function get_settings( WP_REST_Request $request ) {
		$settings = $request->get_param( 'setting_name' );

		$settings = get_option( self::BLOCK_SETTINGS_OPTION, array() );
		return rest_ensure_response( $settings );
	}

	/**
	 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
	 */
	public static function get_blocks_lists() {

		// with cache.
		$blocks_lists = get_transient( 'omnipress_blocks_lists' );

		if ( empty( get_option( self::DISABLED_BLOCKS_OPTION ) ) ) {
			$blocks_lists['reset'] = true;
		}

		if ( $blocks_lists ) {
			return rest_ensure_response( $blocks_lists );
		}

		$block_types = file_get_contents( OMNIPRESS_PATH . 'blocks.json' );
		$block_types = json_decode( $block_types );

		foreach ( $block_types as $key => $block_type ) {
			if ( str_contains( $block_type->name, 'omnipress/' ) ) {
				if ( str_contains( $block_type->name, '-' ) ) {
					$block_type->name = Helpers::kebab_case_to_camel_case( $block_type->name );
				}

				$block_type->name = explode( '/', $block_type->name )[1];
				$disabled_blocks  = get_option( self::DISABLED_BLOCKS_OPTION, array() );
				$enable           = ! in_array( $block_type->name, $disabled_blocks, true );

				$blocks_lists['blocks'][] = array(
					'name'        => $block_type->name,
					'label'       => $block_type->label,
					'enable'      => $enable,
					'category'    => $block_type->category,
					'description' => $block_type->description,
					'required'    => $block_type->required,
					'iconName'    => $key,
				);
			}
		}

		set_transient( 'omnipress_blocks_lists', $blocks_lists, DAY_IN_SECONDS );

		return rest_ensure_response( $blocks_lists );
	}

	/**
	 * Get that block's list which disabled by user from settings.
	 *
	 * @return false|array
	 */
	public static function get_disabled_blocks() {
		return get_option( self::DISABLED_BLOCKS_OPTION, array() );
	}

	public static function enable_all_blocks() {
		delete_option( self::DISABLED_BLOCKS_OPTION );

		return array( 'message' => 'All blocks are enabled!' );
	}

	public static function update_disable_blocks( WP_REST_Request $request ) {
		$block_name = $request->get_param( 'block_name' );
		$action     = $request->get_param( 'action' );

		if ( 'can-edit' === $action ) {
			return rest_ensure_response( self::user_can_edit_block_settings() );
		}

		$disabled_blocks = get_option( self::DISABLED_BLOCKS_OPTION, array() );

		if ( 'add' === $action ) {
			if ( ! in_array( $block_name, $disabled_blocks, true ) ) {
				$disabled_blocks[] = $block_name;
			}
		} elseif ( 'remove' === $action ) {
			if ( ( $key = array_search( $block_name,  $disabled_blocks) ) !== false ) { //phpcs:ignore
				unset( $disabled_blocks[ $key ] );
			}
		}

		if ( empty( $disabled_blocks ) ) {
			delete_option( self::DISABLED_BLOCKS_OPTION );
			return rest_ensure_response( array( 'message' => 'All blocks are enabled!' ) );
		}

		$disabled_blocks = array_unique( $disabled_blocks );
		add_filter( self::DISABLED_BLOCKS_OPTION, fn( $disabled_blocks ) => $disabled_blocks, 10, 2 );

		update_option( self::DISABLED_BLOCKS_OPTION, $disabled_blocks );

		return rest_ensure_response( array( 'message' => 'Settings saved successfully!' ) );
	}

	public static function user_can_edit_block_settings() {
		$block_settings = get_option( self::BLOCK_SETTINGS_OPTION, array() );

		if ( ! $block_settings ) {
			return true;
		}
		$current_user = wp_get_current_user();

		$user_role = $current_user->roles[0];

		if ( ! empty( $user_role ) && isset( $block_settings[ $user_role ] ) ) {
			return $block_settings[ $user_role ];
		}

		return true;
	}

	public function get_all_menu_pages() {
		$menus = apply_filters(
			'omnipress_menus',
			array(
				array(
					'page_title' => 'Omnipress',
					'page_slug'  => 'omnipress',
					'capability' => 'manage_options',
					'icon'       => 'data:image/svg+xml;base64,' . base64_encode( file_get_contents( OMNIPRESS_PATH . 'assets/images/omnipress-dashboard-menu-icon.svg' ) ),
					'callback'   => '',
					'position'   => 30,
				),
				array(
					'page_title' => 	__( 'Templates', 'omnipress' ),
					'page_slug'  => 'omnipress-templates',
					'capability' => 'manage_options',
					'callback'   => array( $this, 'register_template_page' ),
					'position'   => 30,
					'icon'       => 'data:image/svg+xml;base64,' . base64_encode( file_get_contents( OMNIPRESS_PATH . 'assets/images/omnipress-template-icon.svg' ) ),
				),
			)
		);

		return $menus;
	}
	public function register_template_page() {
		echo '<div class="omnipress_templates--wrapper"><h2>Templates</h2></div>';
	}
	public function get_all_sub_menus() {
		$sub_menus = apply_filters(
			'omnipress_sub_menus',
			array(
				array(
					'parent_slug' => 'omnipress',
					'page_title'  => __( 'Dashboard', 'omnipress' ),
					'menu_title'  => __( 'Dashboard', 'omnipress' ),
					'capability'  => 'manage_options',
					'menu_slug'   => 'omnipress',
				),
				array(
					'parent_slug' => 'omnipress',
					'page_title'  => __( 'Omnipress Library', 'omnipress' ),
					'menu_title'  => __( 'Omnipress Library', 'omnipress' ),
					'capability'  => 'manage_options',
					'menu_slug'   => 'omnipress&route=library',
				),
				array(
					'parent_slug' => 'omnipress',
					'page_title'  => __( 'Settings', 'omnipress' ),
					'menu_title'  => __( 'Settings', 'omnipress' ),
					'capability'  => 'manage_options',
					'menu_slug'   => 'omnipress&route=settings',
				),

			)
		);

		return $sub_menus;
	}

	public function coming_soon_template() {
		echo '<div class="op-max-w-sm op-p-6 op-bg-white op-border op-border-gray-200 op-rounded-lg op-shadow op-dark:bg-gray-800 op-dark:border-gray-700 op-m-auto op-mt-[200px]"><svg class="op-w-7 op-h-7 op-text-gray-500 op-dark:text-gray-400 op-mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z"/></svg><a href="#"><h5 class="op-mb-2 op-text-2xl op-font-semibold op-tracking-tight op-text-gray-900 op-dark:text-white">Coming Soon ?</h5></a><p class="op-mb-3 op-font-normal op-text-gray-500 op-dark:text-gray-400">WE Are working on this feature</p><a href="https://omnipressteam.com/" target="_blank" class="op-inline-flex op-font-medium op-items-center op-text-blue-600 hover:op-underline">Visit our site <svg class="op-w-3 op-h-3 op-ms-2.5 rtl:op-rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/> </svg></a></div>';
	}
}
