<?php

namespace Omnipress\Controllers;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

use Omnipress\Models\BlocksModel;

class BlocksController {
	private BlocksModel $blocks_assets_model;
	private $blocks_style_loader_model;

	public function __construct( BlocksModel $blocks_model ) {
		$this->blocks_assets_model       = $blocks_model;
	}

	/**
	 * Init all blocks related actions, filters and methods.
	 *
	 * @return void
	 */
	public function init_blocks() {
		add_action( 'init', array( $this, 'register_blocks' ) );
		add_filter( 'block_categories_all', array( $this, 'register_block_categories' ), PHP_INT_MAX, 3 );
		add_action( 'admin_enqueue_scripts', array( $this->blocks_assets_model, 'enqueue_editor_styles' ) );
	}

	/**
	 * @throws \Exception
	 */
	public function register_blocks() {
		do_action( 'omnipress_before_blocks_register' );
		$this->blocks_assets_model->set_blocks()->validate_blocks()->register_blocks();
		$this->blocks_assets_model->register_interactive_module_scripts(); // Registered all existing block interactivity api's modules scripts.

		/**
		 * Fires before registering blocks.
		 *
		 * @since 1.2.0
		 */
		do_action( 'omnipress_after_blocks_register', $this->blocks_assets_model->get_registered_blocks() );
	}

	public function register_block_categories( $categories ) {
		return $this->blocks_assets_model->register_block_categories( $categories );
	}
}
