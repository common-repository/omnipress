<?php

namespace Omnipress\Abstracts;

abstract class AbstractBlock {
	const BLOCK_DIR = OMNIPRESS_PATH . 'assets/scripts/';
	/**
	 * Block namespace.
	 *
	 * @var string
	 */
	protected string $namespace = 'omnipress';
	/**
	 * Block Type.
	 *
	 * @var string
	 */
	protected string $block_name = '';

	/**
	 * Block's cateogyr type.
	 *
	 * @var string Block Category.
	 */
	protected string $block_category = '';

	/**
	 * Track current block enqueued scripts or not.
	 *
	 * @var bool
	 */
	protected bool $enqueued_scripts = false;


	/**
	 * That will be called when block is render.
	 *
	 * @param array     $attributes block attributes.
	 * @param string    $content block content.
	 * @param \WP_Block $block Block instance.
	 * @return string
	 */
	abstract public function render( $attributes, $content, $block );

	/**
	 * Block Attributes,
	 *
	 * @return array
	 */
	protected function get_block_attributes() {
		return array();
	}

	/**
	 * Get Block type context.
	 *
	 * @return array
	 */
	public function get_block_type_context() {
		return array();
	}

	/**
	 * Get current Block type name.
	 *
	 * @return string
	 */
	public function get_block_name() {
		return $this->namespace . '/' . $this->block_name;
	}

	/**
	 * Get the frontend script handle for this block type.
	 *
	 * @see $this->register_block_type()
	 * @param string $key Data to get, or default to everything.
	 * @return array|string|null
	 */
	protected function get_block_type_script( $key = null ) {
		$script = array(
			'handle'       => 'op-' . $this->block_name . '-frontend',
			'path'         => $this->get_frontend_scripts_path() . '/frontend.js',
			'dependencies' => array(),
		);
		return $key ? $script[ $key ] : $script;
	}

	/**
	 * Block Frontend script path.
	 *
	 * @return string
	 */
	protected function get_frontend_scripts( $block_name ) {
		if ( file_exists( self::BLOCK_DIR . '/' . $block_name . '-view.js' ) ) {
			$script = file_get_contents( self::BLOCK_DIR . '/' . $block_name . '-view.js' ); //phpcs:ignore

			wp_add_inline_script( $block_name . '-script', $script );
		}
	}

	/**
	 * Parse Block attributes.
	 *
	 * @param array|\WP_Block $attributes is an array or instance of WP_BLOCK.
	 * @return array
	 */
	public function parses_block_attributes( array $attributes ) {
		return is_a( $attributes, 'WP_BLOCK' ) ? $attributes->attributes : $attributes;
	}

	/**
	 * Block type render callback.
	 *
	 * @param array     $attributes Block attributes .
	 * @param  string    $content block content.
	 * @param \WP_Block $block Block instance.
	 * @return string
	 */
	public function render_callback( $attributes = array(), $content = '', $block = null ) {
		return $this->render( $attributes, $content, $block );
	}

	/**
	 * @return array
	 */
	public function get_block_type_render() {
		return array( $this, 'render_callback' );
	}
}
