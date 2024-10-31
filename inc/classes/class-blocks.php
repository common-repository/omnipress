<?php
/**
 * Class for handling blocks register and templates.
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
 * Class for handling blocks register and templates.
 *
 * @since 1.0.0
 */
class Blocks {

	/**
	 * Register our blocks.
	 *
	 * @return void
	 */
	public static function register() {
		$blocks = self::get_blocks();

		if ( is_array( $blocks ) && ! empty( $blocks ) ) {
			foreach ( $blocks as $block => $args ) {
				$block_type = OMNIPRESS_BUILD_DIR_PATH . $block;
				register_block_type( $block_type, $args );
			}
		}

		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'load_fonts' ) );

	}

	/**
	 * Load block fonts in frontend.
	 *
	 * @return void
	 */
	public static function load_fonts() {
		$parsed_blocks = parse_blocks( get_the_content() );

		if ( is_array( $parsed_blocks ) && ! empty( $parsed_blocks ) ) {
			foreach ( $parsed_blocks as $parsed_block ) {

				if ( false === strpos( $parsed_block['blockName'], 'omnipress' ) ) {
					continue;
				}

				if ( empty( $parsed_block['attrs'] ) ) {
					continue;
				}

				if ( ! empty( $parsed_block['attrs']['headFontFamily'] ) ) {
					$head_font_family = $parsed_block['attrs']['headFontFamily'];
					$head_font_handle = 'omnipress-font-family-' . sanitize_title( $head_font_family );

					$font_url = "https://fonts.googleapis.com/css?family={$head_font_family}";

					wp_enqueue_style( $head_font_handle, $font_url, array(), OMNIPRESS_VERSION );
				}

				if ( ! empty( $parsed_block['attrs']['descFontFamily'] ) ) {
					$content_font_family = $parsed_block['attrs']['descFontFamily'];
					$content_font_handle = 'omnipress-font-family-' . sanitize_title( $content_font_family );

					$font_url = "https://fonts.googleapis.com/css?family={$content_font_family}";

					wp_enqueue_style( $content_font_handle, $font_url, array(), OMNIPRESS_VERSION );
				}

				if ( ! empty( $parsed_block['attrs']['thirdFontFamily'] ) ) {
					$third_font_family = $parsed_block['attrs']['thirdFontFamily'];
					$third_font_handle = 'omnipress-font-family-' . sanitize_title( $third_font_family );

					$font_url = "https://fonts.googleapis.com/css?family={$third_font_family}";

					wp_enqueue_style( $third_font_handle, $font_url, array(), OMNIPRESS_VERSION );
				}
			}
		}

	}

	/**
	 * Returns array of blocks args.
	 *
	 * @return array
	 */
	public static function get_blocks() {
		return apply_filters(
			'omnipress_filter_blocks',
			array(
				'post-lists'     => array(
					'render_callback' => array( __CLASS__, 'post_lists_render_callback' ),
				),
				'call-to-action' => array(),
				'testimonial'    => array(),
			),
		);
	}

	/**
	 * Render callback for Post Lists block.
	 *
	 * @param array $attributes Blocks saved attributes.
	 * @return string
	 */
	public static function post_lists_render_callback( $attributes ) {

		$post_args = array(
			'post_status'    => 'publish',
			'posts_per_page' => $attributes['numberOfPosts'],
			'order'          => $attributes['order'],
			'orderby'        => $attributes['orderBy'],
		);

		if ( isset( $attributes['categories'] ) ) {
			$post_args['category__in'] = array_column( $attributes['categories'], 'id' );
		}

		$posts  = get_posts( $post_args );
		$layout = ! empty( $attributes['layout'] ) ? $attributes['layout'] : 'layout-one';

		$img_class = 'op-img-anim-rotateLeft op-block-post-img-overlay';

		if ( 'layout-two' === $layout ) {
			$img_class = 'op-img-anim-' . $attributes['animation'] . '';
		}

		if ( ! $attributes['displayFeaturedImage'] ) {
			$img_class = 'op-empty-featured-img';
		}

		ob_start();

			Utils::load_template(
				"post-lists/{$layout}",
				array(
					'attributes' => $attributes,
					'post_args'  => $post_args,
					'posts'      => $posts,
					'img_class'  => $img_class,
				)
			);

		return ob_get_clean();
	}

	/**
	 * Render callback for call to action block
	 *
	 * @param array $attributes Blocks saved attributes.
	 * @return string
	 */
	public static function call_to_action_render_callback( $attributes ) {

		$layout = ! empty( $attributes['layout'] ) ? $attributes['layout'] : 'layout-one';

		ob_start();

			Utils::load_template(
				"call-to-action/{$layout}",
				array(
					'attributes' => $attributes,
				)
			);

		return ob_get_clean();
	}

}
