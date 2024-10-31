<?php
namespace Omnipress\Blocks;

/**
 * Posts Grid Block.
 *
 * This class represents a block for displaying posts in a grid layout.
 *
 * @package Omnipress\Blocks
 * @since 1.2.3
 */
class Post_grid extends PostsBlock {
	/**
	 * Sets the attributes for the block.
	 *
	 * This method sets the attributes for the block.
	 *
	 * @param array $attributes The attributes to set for the block.
	 * @return void
	 */
	public function set_attributes( $attributes ) {
		$this->attributes = $attributes;
	}

	/**
	 * Sets the block name.
	 *
	 * This method sets the block name.
	 *
	 * @param string $block_name The name of the block.
	 * @return void
	 */
	public function set_block_name( $block_name ) {
		$this->block_name = $block_name;
	}

	/**
	 * Render All posts.
	 *
	 * This function renders the posts grid block by fetching posts based on attributes,
	 * and rendering the posts if there are any.
	 *
	 * @param array     $attributes Block's attributes.
	 * @param string    $content Block content.
	 * @param \WP_Block $block Block instance.
	 * @return string HTML content of the rendered block.
	 */
	public function render( $attributes, $content, $block ) {
		$this->set_attributes( $attributes );
		$this->set_block_name( 'post-grid' );

		$this->columns = (string) ( $attributes['columns'] ?? '3' );
		$posts         = $this->fetch_posts();

		if ( is_array( $posts ) && ! empty( $posts ) ) {
			return $content .= $this->render_posts( $posts );
		}

		return $content;
	}
}
