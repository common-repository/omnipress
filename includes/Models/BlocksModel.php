<?php

namespace Omnipress\Models;

use Omnipress\BlockRegistrar;

/**
 * Main entry point for blocks.
 *
 * @author omnipressteam
 *
 * @copyright (c) 2024
 */
class BlocksModel {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->define_block_constants();
		require_once OMNIPRESS_PATH . 'classes/class-blocks-styles.php';

		// Requires all files which required for omnipress blocks.
		do_action( 'omnipress_before_blocks_register' );
		require_once OMNIPRESS_PATH . 'classes/class-block-assets-manager.php';
		require_once OMNIPRESS_PATH . 'classes/class-block-registrar.php';
		$blocks_registrar = BlockRegistrar::init();
	}



	/**
	 * Define all blocks related constants.
	 *
	 * @return void
	 */
	public function define_block_constants() {
		if ( ! defined( 'OMNIPRESS_BLOCKS_PATH' ) ) {
			define( 'OMNIPRESS_BLOCKS_PATH', trailingslashit( OMNIPRESS_PATH . 'assets/build/js/blocks/blocks' ) );
		}
		if ( ! defined( 'OMNIPRESS_BLOCKS_URL' ) ) {
			define( 'OMNIPRESS_BLOCKS_URL', trailingslashit( OMNIPRESS_URL . 'assets/build/js/blocks/blocks' ) );
		}

		if ( ! defined( 'OMNIPRESS_BLOCKS_STYLES_PATH' ) ) {
			define( 'OMNIPRESS_BLOCKS_STYLES_PATH', trailingslashit( OMNIPRESS_PATH . 'assets/build/css/blocks' ) );
		}
		if ( ! defined( 'OMNIPRESS_BLOCKS_STYLES_URL' ) ) {
			define( 'OMNIPRESS_BLOCKS_STYLES_URL', trailingslashit( OMNIPRESS_URL . 'assets/build/css/blocks' ) );
		}

		if ( ! defined( 'OMNIPRESS_BLOCKS_VIEW_JS_PATH' ) ) {
			define( 'OMNIPRESS_BLOCKS_VIEW_JS_PATH', trailingslashit( OMNIPRESS_PATH . 'assets/build/js/view-scripts' ) );
		}
		if ( ! defined( 'OMNIPRESS_BLOCKS_VIEW_JS_URL' ) ) {
			define( 'OMNIPRESS_BLOCKS_VIEW_JS_URL', trailingslashit( OMNIPRESS_URL . 'assets/build/js/view-scripts' ) );
		}
	}
}

new BlocksModel();
