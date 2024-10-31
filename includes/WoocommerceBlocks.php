<?php

/**
 * Main class for handling blocks registration.
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
 * Main class for handling blocks registration.
 *
 * @since 1.1.0
 */
class WoocommerceBlocks {

	/**
	 * @param  array $block_categories all registered categories.
	 * @return array
	 */
	public function register_category( array $block_categories ): array {
		return array_merge(
			array(
				array(
					'slug'  => 'omnipress-woo',
					'title' => __( 'Omnipress-Woo', 'omnipress' ),
				),
			),
			$block_categories,
		);
	}

	/**
	 * It will render the view.
	 *
	 * @param string $template template name.
	 * @param array  $data     other related to current template data.
	 *
	 * @return string|bool
	 */
	public static function render_template( string $template, array $data = array() ): bool|string {
		$view_path = OMNIPRESS_TEMPLATES_PATH . $template . '.php';
		if ( file_exists( $view_path ) ) {
			ob_start();

			if ( is_array( $data ) && ! empty( $data ) ) {
				foreach ( $data as $key => $value ) {
					$$key = $value;
				}
			}

			include_once $view_path;
			return ob_get_clean();
		}

		return false;
	}
}
