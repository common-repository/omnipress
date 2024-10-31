<?php
/**
 * Main class for Omnipress.
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
 * Main class for omnipress.
 *
 * @singleton
 * @since 1.0.0
 */
class Init {

	/**
	 * Instance of this class.
	 *
	 * @var Init|null
	 */
	private static $instance;

	/**
	 * Returns instance of this class.
	 *
	 * @return Init
	 */
	public static function instance() {

		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Construct our class.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'on_init' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_filter( 'block_categories_all', array( $this, 'omnipress_block_category' ), 10, 2 );
	}

	/**
	 * On init hook
	 *
	 * @return void
	 */
	public function on_init() {
		Blocks::register();
	}

	/**
	 * Creating Omnipress Category in block section.
	 *
	 * @return array
	 */
	public function omnipress_block_category( $categories, $post ) {
		return array_merge(
			$categories,
			array(
				array(
					'slug'  => 'omnipress',
					'title' => __( 'Omnipress Blocks', 'omnipress' ),
				),
			)
		);
	}

	/**
	 * Localized data.
	 *
	 * @return array
	 */
	protected function localized_data() {
		return apply_filters(
			'omnipress_filter_localized_data',
			array(
				'omnipressURL' => OMNIPRESS_URL,
				'assetsURL'    => OMNIPRESS_URL . 'assets',
			)
		);
	}

	/**
	 * Admin scripts.
	 */
	public function admin_scripts() {
		wp_enqueue_script( 'omnipress-admin', OMNIPRESS_URL . 'assets/js/admin.js', array(), OMNIPRESS_VERSION, true );

		wp_localize_script( 'omnipress-admin', 'omnipress', $this->localized_data() );
	}

}

