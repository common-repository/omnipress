<?php

/**
 * Abstract class for blocks registration class handler.
 *
 * @package Omnipress
 */

namespace Omnipress\Abstracts;

use Omnipress\Helpers;

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Abstract class for blocks registration class handler.
 *
 * @since 1.1.0
 */
/**
 * Abstract class for registering Gutenberg blocks.
 *
 * Provides methods to register blocks, enqueue scripts and styles, etc.
 *
 * Subclass should implement get_blocks(), get_categories(), get_dirpath() etc.
 */
abstract class BlocksBase {


	/**
	 * Blocks directory path.
	 *
	 * @var string
	 */
	protected static $dirpath = '';
	/**
	 * Blocks args.
	 *
	 * @var array
	 */
	protected static $blocks = array();
	/**
	 * The "Late Static Binding" class name.
	 *
	 * @var string
	 */
	private static $called_by = '';

	/**
	 * Blocks directory names.
	 */
	protected static $block_categories_folder = array();

	/**
	 * Get block cateogories.
	 */
	abstract public static function get_categories();

	/**
	 * Init blocks
	 *
	 * @return void
	 */
	public static function init() {
		$blocks                        = static::get_blocks();
		self::$block_categories_folder = array_keys( $blocks );
		ksort( $blocks );

		self::$called_by = get_called_class();
		self::$dirpath   = trailingslashit( wp_normalize_path( static::get_dirpath() ) );
		self::$blocks    = $blocks;

		add_action( 'init', array( __CLASS__, 'init_blocks' ) );

		/**
		 * Enqueue block assets for both editor and frontend.
		 *
		 * @since 1.2.0
		 */
		add_action( 'enqueue_block_assets', array( __CLASS__, 'register_blocks_assets' ) );

		/**
		 * Enqueue block assets for editor only.
		 *
		 * @since 1.2.0
		 */
		add_action( 'enqueue_block_assets', array( __CLASS__, 'register_block_editor_assets' ) );
		/**
		 * Localize script for nonce.
		 *
		 * @since 1.2.0
		 */
		add_action( 'wp_enqueue_scripts', array( 'Omnipress\Helpers', 'op_wc_nonce_localize' ) );

		if ( method_exists( self::$called_by, 'register_category' ) ) {
			add_filter( 'block_categories_all', array( self::$called_by, 'register_category' ), PHP_INT_MAX );
		}
	}

	/**
	 * Returns blocks arguments as key:value paired array.
	 * key: being the foldername
	 * value: being the arguments for the block or `register_block_type` function args.
	 *
	 * @see {https://developer.wordpress.org/reference/functions/register_block_type} For `register_block_type` parameters.
	 * @return array
	 */
	abstract public static function get_blocks();

	/**
	 * Get Block's Js.
	 *
	 * @return array
	 */
	abstract protected static function get_frontend_assets();

	/**
	 * Get blocks styles.
	 *
	 * @return array
	 */
	abstract protected static function get_blocks_styles();

	/**
	 * Returns full path to blocks directory.
	 *
	 * @return string
	 */
	abstract public static function get_dirpath();

	/**
	 * Initialize everything related to our blocks.
	 *
	 * @return void
	 */
	public static function init_blocks() {
		self::validate_blocks();
		self::register_blocks();
	}

	/**
	 * Validate blocks args and generated blocks folders.
	 *
	 * @return void
	 */
	public static function validate_blocks() {

		foreach ( self::$block_categories_folder as $category ) {
			$blocks_folders = @scandir(self::$dirpath . "/{$category}"); // @phpcs:ignore

			if ( is_array( $blocks_folders ) && ! empty( $blocks_folders ) ) {
				foreach ( $blocks_folders as $blocks_folder ) {

					if ( '.' === $blocks_folder || '..' === $blocks_folder ) {
						continue;
					}

					$folder_path = self::$dirpath . "{$category}/{$blocks_folder}";

					if ( ! is_dir( $folder_path ) ) {
						continue;
					}

					if ( ! file_exists( $folder_path . '/block.json' ) ) {
						/**
						 * Bail if current folder is not a block folder.
						 */
						continue;
					}

					if ( ! isset( self::$blocks[ $category ][ $blocks_folder ] ) ) {
						/* translators: %s is the folder name of the generated block. */
						throw new \Exception( sprintf( __( '"%s" block is missing in blocks args. Please check the block args and generated blocks.', 'omnipress' ), $blocks_folder ) );
					}
				}
			}
		}
	}

	/**
	 * Register blocks.
	 *
	 * @return void
	 */
	public static function register_blocks() {

		/**
		 * Fires before registering blocks.
		 *
		 * @since 1.2.0
		 */
		do_action( 'omnipress_before_blocks_register' );

		if ( is_array( self::$blocks ) && ! empty( self::$blocks ) ) {
			foreach ( self::$blocks as $category_name => $blocks ) {
				if ( 'woocommerce' === $category_name ) {
					foreach ( $blocks as $folder_name => $args ) {
						/**
						 * Check function exists or not.
						 */
						if ( ! function_exists( 'is_plugin_active' ) ) {
							require_once ABSPATH . '/wp-admin/includes/plugin.php';
						}

						/**
						 * Register block type only if woocommerce plugin is active.
						 *
						 * @since 1.2.0
						 */
						if ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
							register_block_type_from_metadata( self::$dirpath . $category_name . "/$folder_name", $args );
						}
					}
				} else {
					foreach ( $blocks as $folder_name => $args ) {
						register_block_type_from_metadata( self::$dirpath . $category_name . "/$folder_name", $args );
					}
				}
			}
		}

		/**
		 * Fires before registering blocks.
		 *
		 * @since 1.2.0
		 */
		do_action( 'omnipress_after_blocks_register' );
	}

	/**
	 * Enqueue all assets related to blocks for editor and frontend
	 *
	 * @return void
	 */
	public static function register_blocks_assets() {
		self::register_blocks_scripts();
		self::register_blocks_styles();
	}

	/**
	 * Enqueue Blocks scripts
	 *
	 * @return void
	 */
	public static function register_blocks_scripts() {
		$js_files = scandir( OMNIPRESS_PATH . 'assets/js', 0 );

		if ( is_array( $js_files ) && ! empty( $js_files ) ) {
			foreach ( $js_files as $js_file ) {
				if ( strlen( $js_file ) > 2 && file_exists( OMNIPRESS_PATH . 'assets/js/' . $js_file ) ) {
					wp_enqueue_script( 'op-blocks-' . pathinfo( $js_file, PATHINFO_FILENAME ), OMNIPRESS_URL . 'assets/js/' . $js_file, array('wp-api-fetch', 'wp-blocks', 'wp-data'), OMNIPRESS_VERSION );
				}
			}
		}
	}

	/**
	 * @return void
	 * Register blocks styles
	 */
	/**
	 * Register blocks styles.
	 *
	 * Loops through the css files in the public assets css directory
	 * and enqueues each one for the editor and frontend.
	 */
	public static function register_blocks_styles() {
		$css_files = scandir( OMNIPRESS_PATH . 'assets/css/public', 0 );

		// Get All blocks css files.
		if ( is_array( $css_files ) && ! empty( $css_files ) ) {

			foreach ( $css_files as $css_file ) {
				$file_name = pathinfo( $css_file, PATHINFO_FILENAME );

				if ( strlen( $css_file ) > 2 && file_exists( OMNIPRESS_PATH . 'assets/css/public/' . $css_file ) ) {
					wp_register_style( 'op-style-' . $file_name, OMNIPRESS_URL . 'assets/css/public/' . $css_file, array(), OMNIPRESS_VERSION );
					wp_enqueue_style( 'op-style-' . $file_name );
				}
			}
		}
	}

	/**
	 * Enqueue all assets related to blocks for editor only
	 *
	 * @return void
	 */
	public static function register_block_editor_assets() {

		self::register_block_editor_only_styles();
	}

	/**
	 * @return void
	 * Register blocks editor assets
	 */
	public static function register_block_editor_only_styles() {

		$editor_css_files = scandir( OMNIPRESS_PATH . 'assets/css/editor', 0 );

		if ( is_array( $editor_css_files ) && ! empty( $editor_css_files ) ) {

			foreach ( $editor_css_files as $editor_css_file ) {
				$file_name = str_replace( '-css', '', pathinfo( $editor_css_file, PATHINFO_FILENAME ) );

				if ( strlen( $editor_css_file ) > 2 && file_exists( OMNIPRESS_PATH . 'assets/css/editor/' . $editor_css_file ) ) {
					wp_register_style( 'op-editor-settings-style-' . $file_name, OMNIPRESS_URL . 'assets/css/editor/' . $editor_css_file, array(), OMNIPRESS_VERSION );
					wp_enqueue_style( 'op-editor-settings-style-' . $file_name );
				}
			}
		}
	}
}
