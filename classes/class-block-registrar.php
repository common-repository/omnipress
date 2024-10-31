<?php

namespace Omnipress;

use Exception;
use Omnipress\Traits\Singleton;

/**
 * Main class to block registration.
 *
 * @since 1.4.2
 *
 * @author omnipressteam
 *
 * @copyright (c) 2024
 */
class BlockRegistrar {

	use Singleton;

	/**
	 * Lists of all unique blocks which used on current page.
	 *
	 * @var array
	 */
	private array $used_blocks;

	/**
	 * Register blocks and block's categories.
	 */
	private function __construct() {
		add_action( 'init', array( $this, 'register_blocks' ) );
		add_filter( 'block_categories_all', array( $this, 'register_block_categories' ), PHP_INT_MAX, 3 );
		do_action( 'omnipress_after_blocks_register', $this->get_blocks_folders() );
	}


	/**
	 * Register omnipress block categories.
	 *
	 * @param array $previous_categories already registered categories.
	 * @return string[][]
	 */
	public function register_block_categories( $previous_categories ) {
		$initial_categories = array(
			array(
				'slug'  => 'omnipress',
				'title' => __( 'Omnipress', 'omnipress' ),
			),
			array(
				'slug'  => 'omnipress-woo',
				'title' => __( 'Omnipress-Woo', 'omnipress' ),
			),
		);

		$additional_categories = apply_filters(
			'omnipress_block_categories',
			$previous_categories
		);

		return array_merge( $initial_categories, $additional_categories );
	}
	/**
	 * Lists of all available blocks.
	 *
	 * @return string[][]
	 */
	public function get_blocks_folders() {
		$core_blocks = array(
			'core'        => array(
				'column',
				'container',
				'google-maps',
				'image',
				'video',
				'paragraph',
			),
			'creative'    => array(
				'accordion',
				'countdown',
				'mega-menu',
				'slide',
				'slider',
				'tab-labels',
				'tabs',
				'tabs-content',
				'icon-box',
				'post-grid',
				'counter',
				'popup',
			),
			'simple'      => array(
				'button',
				'custom-css',
				'dual-button',
				'heading',
				'icons',
				'team',
				'contact-form',
			),

			'woocommerce' => array(
				'product-carousel',
				'product-category',
				'product-category-list',
				'product-grid',
				'product-list',
			),
			'premium'     => array(
				'advanced-query-loop',
				'query-template',
				'query-pagination',
				'query-pagination-previous',
				'query-pagination-next',
				'query-pagination-numbers',
				'query-no-results',
				'dynamic-field-query',
			),
		);

		$additional_blocks_folders = apply_filters( 'omnipress/additional/blocks/folders', array() );

		return array_merge( $core_blocks, $additional_blocks_folders );
	}
	/**
	 * Validate provided blocks folder exists or not.
	 *
	 * @throws \Exception throw.
	 */
	public function validate_blocks() {
		$blocks_folder_names = $this->get_blocks_folders();

		foreach ( $blocks_folder_names as $category => $blocks ) {

			if ( 'premium' === $category ) {

				if ( defined( 'OMNIPRESS_PRO_BLOCKS_PATH' ) && is_dir( OMNIPRESS_PRO_BLOCKS_PATH ) && is_readable( OMNIPRESS_PRO_BLOCKS_PATH ) ) {
					$blocks_folders = scandir( OMNIPRESS_PRO_BLOCKS_PATH );
				}
			} else {

				$blocks_folders = scandir( OMNIPRESS_BLOCKS_PATH . "/{$category}" );
			}

			if ( is_array( $blocks_folders ) && ! empty( $blocks_folders ) ) {
				foreach ( $blocks_folders as $blocks_folder ) {

					if ( '.' === $blocks_folder || '..' === $blocks_folder ) {
						continue;
					}

					$folder_path = OMNIPRESS_BLOCKS_PATH . "/{$category}/{$blocks_folder}";

					if ( 'premium' === $category ) {
						if ( defined( 'OMNIPRESS_PRO_BLOCKS_PATH' ) ) {
							$blocks_folders = scandir( OMNIPRESS_PRO_BLOCKS_PATH . "/{$blocks_folder}" );
						}
					}

					if ( ! is_dir( $folder_path ) ) {
						continue;
					}

					if ( ! file_exists( $folder_path . '/block.json' ) ) {
						/**
						 * Bail if current folder is not a block folder.
						 */
						continue;
					}

					if ( ! in_array( $blocks_folder, $blocks_folder_names[ $category ], true ) ) {
						/* translators: %s is the folder name of the generated block. */
						throw new Exception( sprintf( __( '"%s" block is missing in blocks args. Please check the block args and generated blocks.', 'omnipress' ), $blocks_folder ) );
					}
				}
			}
		}
	}

	/**
	 * Register all omnipress blocks.
	 *
	 * @return void
	 */
	public function register_blocks() {

		/**
		 * Fires before registering blocks.
		 *
		 * @since 1.2.0
		 */
		do_action( 'omnipress_before_blocks_register' );
		$blocks = $this->get_blocks_folders();

		if ( ! empty( $blocks ) ) {
			foreach ( $blocks as $category_name => $block ) {

				if ( 'premium' === $category_name ) {
					do_action( 'op_premium_blocks_assets', $block, $category_name );
					continue;
				}

				/**
				 * Check if block is disabled or not.
				 */
				if ( ! function_exists( 'is_plugin_active' ) ) {
					require_once ABSPATH . '/wp-admin/includes/plugin.php';
				}

				if ( is_array( $block ) && ! empty( $block ) ) {
					if ( 'woocommerce' === $category_name && ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
						continue;
					}

					foreach ( $block as $folder_name ) {
						$args = array();

						if ( $this->is_block_disabled( $folder_name ) ) {
							continue;
						}

						$this->register_omnipress_block( OMNIPRESS_BLOCKS_PATH . $category_name . "/$folder_name", $args );
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


	public function is_block_disabled( $block_name ) {
		$disabled_blocks = get_option( 'op_disabled_blocks', array() );

		return in_array( Helpers::kebab_case_to_camel_case( $block_name ), $disabled_blocks, true );
	}

	/**
	 * Register blocks with custom attributes.
	 *
	 * @param $block_path
	 * @param $args
	 * @return void
	 */
	public function register_omnipress_block( $block_path, $args = array() ) {
		$metadata = json_decode( FileSystemUtil::read_file( $block_path . '/block.json' ), true );

		if ( isset( $metadata['opSettings'] ) ) {
			$args['opSettings'] = $metadata['opSettings'];
		}

		// Added custom settings inside block's args.
		add_filter(
			'omnipress_render_block_' . $metadata['name'],
			function ( $block_settings ) use ( $metadata ) {
				if ( isset( $metadata['opSettings'] ) ) {
					$block_settings['opSettings'] = $metadata['opSettings'];
				}

				return $block_settings;
			},
			12,
			1
		);

		$view_script = $this->get_frontend_script( $metadata['name'] );

		if ( $view_script ) {
			wp_register_script( $view_script['handle'], $view_script['src'], $view_script['deps'], $view_script['version'], true );
			$args['viewScript'] = $view_script['handle'];
		}

		$args['render_callback'] = array( $this, 'render_block' );

		register_block_type( $block_path, $args );
	}

	/**
	 *
	 * @param string $block_name Name of current block.
	 * @return bool|array
	 */
	private function get_frontend_script( string $block_name ) {
		$file_name      = explode( '/', $block_name )[1] . '-view';
		$view_file_path = OMNIPRESS_PATH . 'assets/build/js/view-scripts/' . $file_name . '.js';

		if ( file_exists( $view_file_path ) ) {
			$assets = include_once OMNIPRESS_PATH . 'assets/build/js/view-scripts/' . $file_name . '.asset.php';
			return array(
				'handle'  => $file_name,
				'src'     => OMNIPRESS_URL . 'assets/build/js/view-scripts/' . $file_name . '.js',
				'deps'    => $assets['dependencies'],
				'version' => $assets['version'],
			);
		}

		return false;
	}

	/**
	 * Render callback for registered block.
	 *
	 * @param array     $attributes current block attributes.
	 * @param string    $content saved content.
	 * @param \WP_Block $block Block Instance.
	 * @return mixed
	 */
	public function render_block( $attributes, $content, \WP_Block $block ) {
		// Update unique block count.
		if ( ! isset( $this->used_blocks[ $block->name ] ) ) {
			add_filter(
				'op_rendered_blocks',
				function ( $previous_block ) use ( $block ) {
					if ( ! isset( $previous_block[ $block->name ] ) ) {
						$previous_block[ $block->name ] = 1;
					}
					return $previous_block;
				},
				1
			);
		}

		$current_block_class_instance = BlocksAssetsHelper::get_block_class_instance_by_name( $block->name );

		if ( ! $current_block_class_instance ) {
			return $content;
		}

		// If the block class has a render callback, use that.
		if ( method_exists( $current_block_class_instance, 'render' ) ) {
			$content = $current_block_class_instance->render( $attributes, $content, $block );
		}

		$content = apply_filters( 'omnipress_render_dynamic_content', $content, $attributes, $block );

		return $content;
	}
}
