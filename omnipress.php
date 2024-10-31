<?php
/**
 * Plugin Name: Omnipress
 * Description: Omnipress is a ready-made WordPress Design Blocks, similar to the Gutenberg WordPress block editor, that takes a holistic approach to changing your complete site.
 * Author: omnipressteam
 * Author URI: https://omnipressteam.com/
 * Version: 1.4.3
 * Text Domain: omnipress
 * License: GPLv3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package Omnipress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Omnipress {

	/**
	 * Plugin version.
	 */
	const VERSION = '1.4.3';

	/**
	 * Singleton instance.
	 */
	private static $instance = null;

	/**
	 * Get singleton instance.
	 *
	 * @return Omnipress
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->setup_constants();
			self::$instance->includes();
			self::$instance->init_hooks();
		}

		return self::$instance;
	}

	/**
	 * Setup plugin constants.
	 */
	private function setup_constants() {
		define( 'OMNIPRESS_VERSION', self::VERSION );
		define( 'OMNIPRESS_FILE', __FILE__ );
		define( 'OMNIPRESS_PATH', trailingslashit( plugin_dir_path( OMNIPRESS_FILE ) ) );
		define( 'OMNIPRESS_TEMPLATES_PATH', trailingslashit( OMNIPRESS_PATH . 'templates' ) );
		define( 'OMNIPRESS_URL', trailingslashit( plugin_dir_url( OMNIPRESS_FILE ) ) );
	}

	/**
	 * Include required files.
	 */
	private function includes() {
		require_once OMNIPRESS_PATH . 'vendor/autoload.php';
	}

	/**
	 * Initialize hooks.
	 */
	private function init_hooks() {
		add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ) );
		add_action( 'admin_init', array( $this, 'redirect_to_settings_page' ) );
		register_activation_hook( __FILE__, array( $this, 'on_activation' ) );
	}

	/**
	 * Plugins loaded hook.
	 */
	public function on_plugins_loaded() {
		$this->load_textdomain();
		do_action( 'omnipress_init' );
		Omnipress\Init::instance();
		do_action( 'omnipress_loaded', self::$instance );
	}

	/**
	 * Load plugin textdomain.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'omnipress', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Activation hook.
	 */
	public function on_activation() {
		set_transient( 'omnipress_activation_redirect', true, 30 );
		set_transient( 'omnipress_recommended_plugins_notice', true, 30 );
	}

	/**
	 * Redirect to settings page on activation.
	 */
	public function redirect_to_settings_page() {
		if ( get_transient( 'omnipress_activation_redirect' ) ) {
			delete_transient( 'omnipress_activation_redirect' );

			if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
				return;
			}

			$settings_page_url = admin_url( 'admin.php?page=omnipress' );
			wp_safe_redirect( $settings_page_url );
			exit;
		}
	}
}

// Initialize the plugin.
Omnipress::instance();
