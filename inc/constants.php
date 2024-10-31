<?php
/**
 * Omnipress constants.
 *
 * @package Omnipress
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'OMNIPRESS_VERSION' ) ) {

	/**
	 * Omnipress version.
	 */
	define( 'OMNIPRESS_VERSION', ( get_file_data( OMNIPRESS_FILE, array( 'Version' => 'Version' ) )['Version'] ) );
}

if ( ! defined( 'OMNIPRESS_URL' ) ) {

	/**
	 * URL to Omnipress plugin folder.
	 */
	define( 'OMNIPRESS_URL', trailingslashit( plugin_dir_url( OMNIPRESS_FILE ) ) );
}


if ( ! defined( 'OMNIPRESS_TEMPLATE_DIR_PATH' ) ) {

	/**
	 * Path to Omnipress plugin templates folder.
	 */
	define( 'OMNIPRESS_TEMPLATE_DIR_PATH', OMNIPRESS_PATH . 'inc/templates/' );
}

if ( ! defined( 'OMNIPRESS_BUILD_DIR_PATH' ) ) {

	/**
	 * Path to Omnipress plugin build folder.
	 */
	define( 'OMNIPRESS_BUILD_DIR_PATH', OMNIPRESS_PATH . 'build/' );
}
