<?php

/**
 * Main class for handling blocks registration.
 *
 * @package Omnipress
 */

namespace Omnipress;

use Omnipress\Abstracts\BlocksBase;
use Omnipress\Blocks\AddToCart;
use Omnipress\Blocks\Product;
use Omnipress\Blocks\ProductCategories;
use Omnipress\Blocks\ProductContent;
use Omnipress\Blocks\ProductImage;
use Omnipress\Blocks\ProductSearch;
use Omnipress\Blocks\ProductLists;
use Omnipress\Blocks\PostsGrid;

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
class Blocks extends BlocksBase {

	/**
	 * {@inheritDoc}
	 */
	public static function get_dirpath() {
		return OMNIPRESS_PATH . 'assets/scripts/blocks';
	}

	/**
	 * {@inheritDoc}
	 */
	public static function get_blocks() {
		return array(
			'core'        => array(
				'column'    => array(),
				'container' => array(),
				'paragraph' => array(),
				'image' => array(),
				'video' => array(),
				'google-maps' => array(),
				'contact-form' => array(),
			),
			'creative'    => array(
				'accordion'    => array(),
				'countdown'    => array(),
				'mega-menu'    => array(),
				'menu-item'    => array(),
				'slide'        => array(),
				'slider'       => array(),
				'tab-labels'   => array(),
				'tabs'         => array(),
				'tabs-content' => array(),
				'icon-box'     => array(),
				'post-grid'    => array(
					'render_callback' => ( ( new PostsGrid() )->get_block_type_render() ),
				),
				'counter'     => array(),
			),
			'simple'      => array(
				'button'      => array(),
				'custom-css'  => array(),
				'dual-button' => array(),
				'heading'     => array(),
				'icons'       => array(),
				'team'        => array(),
			),

			'woocommerce' => array(
				'product-carousel'      => array(),
				'product-category'      => array(),
				'product-category-list' => array(
					'render_callback' => ( ( new ProductCategories() )->get_block_type_render() ),
				),
				'product-grid'          => array(),
				'product-list'          => array(
					'render_callback' => ( ( new ProductLists() )->get_block_type_render() ),
				),
			),
		);
	}

	/**
	 * Register Custom Block Categories.
	 *
	 * @param array $block_categories block categories.
	 * @return array|\string[][]|\void[][]
	 */
	public static function register_category( $block_categories ) {
		return array_merge(
			array(
				array(
					'slug'  => 'omnipress',
					'title' => __( 'Omnipress', 'omnipress' ),
				),
				array(
					'slug'  => 'omnipress-woo',
					'title' => __( 'Omnipress-Woo', 'omnipress' ),
				),
			),
			$block_categories,
		);
	}

	/**
	 * {@ineritdoc}
	 */
	public static function get_categories() {
		return array_keys( self::$blocks );
	}

	/**
	 * {@inheritdoc}
	 */
	public static function get_assets() {
		return array(
			'fonts-loader'      => array(),
			'frontend-block-js' => array(),
			'light-box'         => array( 'omnipress/innercolumn' ),
			'swiper'            => array( 'omnipress/product-carousel' ),
			'swiper-element'    => array( 'omnipress/product-image', 'omnipress/slider' ),
		);
	}


	protected static function get_frontend_assets() {
		return array();
	}

	protected static function get_blocks_styles() {
		return array();
	}
}
