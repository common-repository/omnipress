<?php
namespace Omnipress;

use Omnipress\Blocks\Utils;
use Omnipress\Helpers;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.


if ( ! class_exists( 'BlocksAssetsHelper' ) ) {
	/**
	 * Blocks Assets Helper class.
	 */
	class BlocksAssetsHelper {


		const BLOCK_DIR = OMNIPRESS_PATH . 'assets/scripts';
		/**
		 * Get Current block's render class which have contains current block's related assets and contents related methods and properties.
		 *
		 * @param string $block_name  Now rendering block name.
		 * @return mixed|null
		 */
		public static function get_block_class_instance_by_name( $block_name ) {
			if ( ! $block_name ) {
				return null;
			}

			$block_name_parts = explode( '/', $block_name );

			$block_name = Helpers::convert_kebab_to_pascal_case( $block_name_parts[1] );

			// Dynamically include the class file if it exists.
			$class_file = OMNIPRESS_PATH . "includes/Blocks/$block_name.php";
			$class_name = "Omnipress\\Blocks\\$block_name";

			$block_instance = null;

			if ( file_exists( $class_file ) ) {
				include_once $class_file;

				if ( class_exists( $class_name ) ) {
					$block_instance = new $class_name();
				}
			}

			return $block_instance;
		}

		/**
		 * Enqueue block's view scripts.
		 *
		 * @return string
		 */
		public static function enqeue_view_scripts( $block_name ) {
			if ( file_exists( self::BLOCK_DIR . '/' . $block_name . '-view.js' ) ) {
				$script = file_get_contents( self::BLOCK_DIR . '/' . $block_name . '-view.js' ); //phpcs:ignore

				if ( $script ) {
					echo '<script id="op-view-' . esc_html( $block_name ) . '">' . esc_html( $script ) . '</script>';
				}
			}
		}
	}

}
