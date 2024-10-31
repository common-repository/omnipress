<?php
/**
 * Include our required files.
 *
 * @package Omnipress
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Include our required files.
 *
 * @return void
 */
function omnipress_require_files() {
	$files = array(
		'inc/constants.php',

		'inc/classes/class-utils.php',
		'inc/classes/class-blocks.php',
		'inc/classes/class-blocks-api.php',

		'inc/classes/class-init.php',
	);

	if ( is_array( $files ) && ! empty( $files ) ) {
		foreach ( $files as $file ) {
			require_once OMNIPRESS_PATH . $file;
		}
	}
}
omnipress_require_files();
