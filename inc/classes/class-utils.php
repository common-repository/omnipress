<?php
/**
 * Class that provides necessary utility methods.
 *
 * @package Omnipress
 */

namespace Omnipress;

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class that provides necessary utility methods.
 *
 * @since 1.0.0
 */
class Utils {

	/**
	 * Loads the template file from `inc/templates` folder.
	 *
	 * @param string $template Absolute path to template file without `.php` extension.
	 * @param array  $args Arguments for the template file.
	 * @return void
	 */
	public static function load_template( $template, $args = array() ) {
		$file = wp_normalize_path( OMNIPRESS_TEMPLATE_DIR_PATH . $template . '.php' );

		$args = apply_filters( 'omnipress_filter_template_renderer_args', $args, $template );

		do_action( 'omnipress_before_template_rendered', $template, $args );

		load_template( $file, false, $args );

		do_action( 'omnipress_after_template_rendered', $template, $args );
	}
}
