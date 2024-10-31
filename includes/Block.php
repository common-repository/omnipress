<?php
namespace Omnipress\Block;

use OMNIPRESS\FileSystemUtil;
use Omnipress\Helpers;
use Omnipress\Models\BlocksSettingsModel;

defined( 'ABSPATH' ) || exit;
/**
 * All block editor's scripts.
 *
 * @return void
 */
function enqueue_editor_scripts() {
	$block_assets   = include_once OMNIPRESS_PATH . 'assets/build/js/blocks/block.asset.php';
	$environment    = wp_get_environment_type();
	$block_settings = new BlocksSettingsModel();

	$status['is_active'] = false;

	if ( class_exists( 'OmnipressPro\Edd\Edd' ) ) {
		$status = get_option( \OmnipressPro\Edd\Edd::LIC_STATUS_METAKEY, array( 'is_active' => false ) );
	}

	$localize = apply_filters(
		'_omnipress_blocks_localize',
		array(
			'nonce'            => wp_create_nonce( '_omnipress_block_nonce' ),
			'omnipressVersion' => OMNIPRESS_VERSION,
			'isDevmode'        => ( 'development' === $environment || 'local' === $environment ) ? true : false,
			'status'           => $status['is_active'],
			'urls'             => array(
				'home'        => home_url(),
				'wpDashboard' => admin_url(),
				'omnipress'   => OMNIPRESS_URL,
			),
			'settings'         => array(
				'disabledBlocks' => $block_settings->get_disabled_blocks(),
			),
		)
	);

	wp_enqueue_script( 'omnipress-blocks', OMNIPRESS_URL . 'assets/build/js/blocks/block.js', $block_assets['dependencies'], $block_assets['version'], true );
	wp_enqueue_script( 'omnipress-auto-block-recovery', OMNIPRESS_URL . 'assets/block-interactivity/auto-block-recovery.js', $block_assets['dependencies'], $block_assets['version'], true );
	wp_enqueue_script( 'omnipress-fonts-loader', OMNIPRESS_URL . 'assets/library/fonts-loader.js', array(), OMNIPRESS_VERSION, true );

	wp_localize_script( 'omnipress-blocks', '_uagbop_local', apply_filters( 'omnipress_localize_admin_script', $localize ) );

	if ( 'active' === Helpers::get_plugin_status( 'woocommerce/woocommerce.php' ) ) {
		$woo_block_assets = include_once OMNIPRESS_PATH . 'assets/build/js/blocks/woo-block.asset.php';
		wp_enqueue_script( 'omnipress-woo-blocks', OMNIPRESS_URL . 'assets/build/js/blocks/woo-block.js', $woo_block_assets['dependencies'], $woo_block_assets['version'], true );
	}
}

/**
 * Register only editor styles.
 *
 * @return void
 */
function enqueue_editor_styles() {
	wp_enqueue_style( 'op-layout-editor-style', OMNIPRESS_URL . 'assets/build/css/editor/layout.min.css', array(), OMNIPRESS_VERSION );
	wp_enqueue_style( 'op-blocks-editor-style', OMNIPRESS_URL . 'assets/build/css/editor/style.min.css', array(), OMNIPRESS_VERSION );
	wp_enqueue_style( 'op-blocks-editor-style', OMNIPRESS_URL . 'assets/build/css/editor/style.min.css', array(), OMNIPRESS_VERSION );

	wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css', array(), OMNIPRESS_VERSION );
}

/**
 *
 * Enqueue only editor's assets.
 *
 * @return void
 */
function enqueue_block_editor_assets() {
	call_user_func( 'Omnipress\Block\enqueue_editor_scripts' );
	call_user_func( 'Omnipress\Block\enqueue_editor_styles' );
}

/**
 * Enqueue block's assets which required on frontend and backend.
 *
 * @return void
 */
function enqueue_block_assets() {
	wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css', array(), OMNIPRESS_VERSION );
	wp_enqueue_style( 'omipress/blocks/styles', OMNIPRESS_URL . 'assets/build/css/frontend/frontend.min.css', array(), OMNIPRESS_VERSION );
	wp_register_style( 'omnipress/block/layout', OMNIPRESS_URL . 'assets/build/css/layout.min.css', array(), OMNIPRESS_VERSION );
	wp_enqueue_script( 'omnipress-store', OMNIPRESS_URL . 'assets/build/js/admin/store.js', array( 'wp-api-fetch', 'wp-blocks', 'wp-data' ), OMNIPRESS_VERSION, true );
	wp_enqueue_script( 'omnipress-fonts-loader', OMNIPRESS_URL . 'assets/library/fonts-loader.js', array(), OMNIPRESS_VERSION, true );

	// register critical css inline.
	$container_css = FileSystemUtil::read_file( OMNIPRESS_PATH . 'assets/build/css/blocks/container-layout.min.css' );

	if ( is_string( $container_css ) && ! empty( $container_css ) ) {
		wp_register_style( 'omnipress/block/container', false, array(), OMNIPRESS_VERSION );
		wp_add_inline_style( 'omnipress/block/container', $container_css );
	}

	/**
	 * All external library js.
	 */
	// register swiper js and css.
	wp_register_script( 'omnipress-slider-script', OMNIPRESS_URL . 'assets/library/swiper.js', array(), 'v11.1.12', true );
	wp_register_style( 'omnipress-slider-style', OMNIPRESS_URL . 'assets/library/css/swiper.css', array(), 'v11.1.12' );
}


/**
 * Function register_module_scripts for interactivity api
 *
 * @author omnipressteam
 *
 * @return void
 */
function register_module_scripts(): void {
	$dependencies = array(
		'id'     => '@wordpress/interactivity',
		'import' => 'dynamic',
	);

	\wp_register_script_module( 'omnipress/woogrid', OMNIPRESS_URL . 'assets/block-interactivity/wc-block-module.js', $dependencies, OMNIPRESS_VERSION );
}
