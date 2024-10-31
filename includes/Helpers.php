<?php
/**
 * Class for providing helper methods for omnipress.
 *
 * @package Omnipress
 */

namespace Omnipress;

use Automattic\WooCommerce\Caching\ObjectCache;
use OmnipressPro\Woocommerce_Utils;
use WP_Block;

/**
 * Class for providing helper methods for omnipress.
 *
 * @since 1.1.0
 */
class Helpers {

	/**
	 * Returns true if current site is a test site.
	 *
	 * @return boolean
	 * @since 1.1.5
	 */
	public static function is_test_site() {

		$homeurl = home_url();

		foreach ( array( 'instawp', 'tastewp' ) as $needle ) {
			if ( false !== strpos( $homeurl, $needle ) ) {
				return true;
			}
		}

		return false;
	}


	/**
	 * Returns true if current server is localhost.
	 *
	 * @return boolean
	 * @since 1.1.5
	 */
	public static function is_localhost() {
		$whitelist   = array( '127.0.0.1', '::1' );
		$remote_addr = ! empty( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
		if ( in_array( $remote_addr, $whitelist, true ) ) {
			return true;
		}
	}

	/**
	 * Checks if provided function is enabled.
	 *
	 * @param string $function_name
	 * @return boolean
	 * @since 1.1.5
	 */
	public static function is_php_func_enabled( $function_name ) {
		$disabled = explode( ',', ini_get( 'disable_functions' ) );
		return ! in_array( $function_name, array_map( 'trim', $disabled ), true );
	}

	/**
	 * Returns plugins status.
	 *
	 * @param string $plugin_slug
	 * @return string active | paused | not-found
	 */
	public static function get_plugin_status( $plugin_slug ) {

		if ( ! function_exists( 'is_plugin_active' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		if ( is_plugin_active( $plugin_slug ) ) {
			return 'active';
		}

		static $plugins = array();

		if ( ! $plugins ) {
			$plugins = get_plugins();
		}

		if ( isset( $plugins[ $plugin_slug ] ) ) {
			return 'paused';
		}

		return 'not-found';
	}

	/**
	 * Extract image urls from the content strings.
	 *
	 * @param string $content
	 * @return array
	 */
	public static function extract_img_urls( $content ) {
		preg_match_all( '~<img.*?src=["\']+(.*?)["\']+~', $content, $urls );

		if ( empty( $urls[1] ) ) {
			return array();
		}

		return $urls[1];
	}

	/**
	 * Downloads images and returns their respective local urls
	 * with key being source urls and value being local urls.
	 *
	 * @return array
	 */
	public static function download_images( $img_urls ) {

		if ( ! $img_urls ) {
			return array();
		}

		$downloaded_images_urls = get_option( 'omnipress_downloaded_images_urls', array() );

		if ( is_array( $img_urls ) && ! empty( $img_urls ) ) {

			if ( ! function_exists( 'download_url' ) ) {
				require_once ABSPATH . 'wp-admin/includes/file.php';
			}

			if ( ! function_exists( 'media_sideload_image' ) ) {
				require_once ABSPATH . 'wp-admin/includes/media.php';
			}

			if ( ! function_exists( 'wp_read_image_metadata' ) ) {
				require_once ABSPATH . 'wp-admin/includes/image.php';
			}

			$site_url = site_url();

			foreach ( $img_urls as $img_url ) {

				$source_url = wp_normalize_path( trim( $img_url ) );

				if ( isset( $downloaded_images_urls[ $source_url ] ) ) {

					$url_to_path = wp_normalize_path( str_replace( $site_url, ABSPATH, $downloaded_images_urls[ $source_url ] ) );

					if ( file_exists( $url_to_path ) ) {

						/**
						 * Ignore if downloaded already.
						 */
						continue;
					}
				}

				$src = media_sideload_image( $source_url, 0, null, 'src' );

				if ( ! is_wp_error( $src ) ) {
					$downloaded_images_urls[ $source_url ] = $src;
				}
			}
		}

		update_option( 'omnipress_downloaded_images_urls', $downloaded_images_urls );

		return $downloaded_images_urls;
	}

	/**
	 * Returns blocks attributes from parsed blocks.
	 *
	 * @param array $parsed_blocks
	 * @param array $attrs Pass it as reference.
	 * @return void
	 */
	public static function get_blocks_attributes( $parsed_blocks, &$attrs = array() ) {
		if ( ( ! is_array( $parsed_blocks ) ) && ( ! isset( $parsed_blocks[0]['blockName'] ) ) ) {
			return;
		}

		if ( ! empty( $parsed_blocks ) && is_array( $parsed_blocks ) ) {
			foreach ( $parsed_blocks as $parsed_block ) {
				if ( ! empty( $parsed_block['attrs'] ) ) {
					$attrs[ $parsed_block['blockName'] ][] = $parsed_block['attrs'];
				}

				if ( ! empty( $parsed_block['innerBlocks'] ) ) {
					self::get_blocks_attributes( $parsed_block['innerBlocks'], $attrs );
				}
			}
		}
	}

	/**
	 * Generates slug type id from font attributes.
	 *
	 * @param string     $font_family
	 * @param string|int $font_weight
	 * @param string     $font_style
	 * @return string
	 */
	public static function generate_font_id( $font_family, $font_weight, $font_style ) {
		return sanitize_title( "{$font_family}-{$font_weight}-{$font_style}" );
	}

	/**
	 * Extract font family names from the omnipress blocks.
	 *
	 * @param array $attrs
	 * @return array
	 */
	public static function extract_fonts_from_attrs( $attrs ) {

		$fonts = array();

		if ( ! empty( $attrs ) && is_array( $attrs ) ) {
			foreach ( $attrs as $block_name => $attr ) {
				if ( false === strpos( $block_name, 'omnipress' ) ) {
					continue;
				}

				if ( ! empty( $attr ) && is_array( $attr ) ) {
					foreach ( $attr as $att ) {

						if ( ! empty( $att ) && is_array( $att ) ) {
							foreach ( $att as $value ) {
								if ( empty( $value['fontFamily'] ) ) {
									continue;
								}

								$font_weight = ! empty( $value['fontWeight'] ) ? absint( $value['fontWeight'] ) : '400';
								$font_style  = ! empty( $value['fontStyle'] ) ? strtolower( $value['fontStyle'] ) : 'normal';

								$fonts[ self::generate_font_id( $value['fontFamily'], $font_weight, $font_style ) ] = array(
									'fontFamily' => $value['fontFamily'],
									'fontWeight' => ! empty( $value['fontWeight'] ) ? $value['fontWeight'] : '400',
									'fontStyle'  => ! empty( $value['fontStyle'] ) ? strtolower( $value['fontStyle'] ) : 'normal',
								);
							}
						}
					}
				}
			}
		}

		return $fonts;
	}

	/**
	 * Localize store wc_nonce to use clientside
	 *
	 * @since 1.2.0
	 * @return void
	 */
	public static function op_wc_nonce_localize() {
		wp_enqueue_script( 'op-nonce-script', OMNIPRESS_URL . 'assets/scripts/product-grid-view.js', array( 'wp-api-fetch' ), OMNIPRESS_VERSION );

		$nonce = wp_create_nonce( 'wc_store_api' );

		wp_localize_script(
			'op-nonce-script',
			'omnipress_vars',
			array(
				'nonce' => $nonce,
			)
		);
	}

	/**
	 * Get the request method.
	 *
	 * @since 1.2.2
	 *
	 * @return string
	 */
	public static function get_request_method(): string {
		return isset( $_SERVER['REQUEST_METHOD'] ) ? strtolower( $_SERVER['REQUEST_METHOD'] ) : 'get';
	}

	/***
	 * Woocommerce product category by product id.
	 *
	 * @param number $product_id Product Id.
	 * @return false|string
	 */
	public static function get_woocommerce_category_by_product_id( $product_id ) {
		$terms = wp_get_post_terms( $product_id, 'product_cat' );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			return $terms[0]->name;
		}

		return false;
	}

	public static function kebab_case_to_camel_case( $string ) {
		return preg_replace_callback(
			'/-([a-z])/',
			function ( $matches ) {
				return strtoupper( $matches[1] );
			},
			$string
		);
	}

	public static function is_plugin_active( $slug ) {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			require_once ABSPATH . '/wp-admin/includes/plugin.php';
		}

		return is_plugin_active( $slug );
	}


	/**
	 * Returns the query args to query WordPress post type's posts.
	 *
	 * @return array
	 */
	public static function build_query_vars_from_omnipresss_query_block( WP_Block $block, $page = null ) {
		$custom_args   = $block->context['query'];
		$wp_query_args = array();

		// Query for WooCommerce products if query have extra query related wooCommerce.
		if ( 'product' === $custom_args['postType'] ) {
			$wc_utils      = WooCommerce_Utils::init();
			$wp_query_args = $wc_utils->generate_query_args( $block, $page );
		}

		if ( isset( $custom_args['perPage'] ) ) {
			$wp_query_args['posts_per_page'] = $custom_args['perPage'];
		}

		if ( isset( $custom_args['offset'] ) ) {
			$wp_query_args['offset'] = ( $custom_args['perPage'] * ( $page - 1 ) + $custom_args['offset'] );
		}

		if ( isset( $custom_args['postType'] ) ) {
			$wp_query_args['post_type'] = $custom_args['postType'];
		}

		if ( isset( $custom_args['order'] ) ) {
			$wp_query_args['order'] = $custom_args['order'];
		}

		if ( isset( $custom_args['orderBy'] ) ) {
			$wp_query_args['orderby'] = $custom_args['orderBy'];
		}

		if ( isset( $custom_args['author'] ) ) {
			$wp_query_args['author'] = $custom_args['author'];
		}

		if ( isset( $custom_args['search'] ) ) {
			$wp_query_args['s'] = $custom_args['search'];
		}

		if ( isset( $custom_args['sticky'] ) ) {
			$wp_query_args['ignore_sticky_posts'] = ! $custom_args['sticky'];
		}

		if ( isset( $custom_args['include'] ) && is_array( $custom_args['include'] ) ) {
			$wp_query_args['post__in'] = $custom_args['include'];
		}

		if ( isset( $custom_args['parents'] ) && is_array( $custom_args['parents'] ) ) {
			$wp_query_args['post_parent__in'] = $custom_args['parents'];
		}

		if ( isset( $custom_args['before'] ) ) {
			$wp_query_args['date_query'][] = array(
				'before' => $custom_args['before'],
			);
		}

		if ( isset( $custom_args['after'] ) ) {
			$wp_query_args['date_query'][] = array(
				'after' => $custom_args['after'],
			);
		}

		if ( isset( $custom_args['exclude'] ) ) {
			$wp_query_args['post__not_in'] = array( $custom_args['exclude'] );
		}

		if ( isset( $custom_args['status'] ) ) {
			$wp_query_args['post_status'] = $custom_args['status'];
		}

		// Handling Taxonomies with relation.
		if ( isset( $custom_args['taxonomies'] ) && is_array( $custom_args['taxonomies'] ) ) {
			$tax_query = array();
			$relation  = isset( $custom_args['tax_relation'] ) ? $custom_args['tax_relation'] : 'AND';

			foreach ( $custom_args['taxonomies'] as $taxonomy => $terms ) {
				switch ( $taxonomy ) {
					case 'categories':
						$taxonomy = 'category';
						break;

					case 'tags':
						$taxonomy = 'post_tag';
						break;
				}

				if ( is_array( $terms ) && ! empty( $terms ) ) {
					$tax_query[] = array(
						'taxonomy' => $taxonomy,
						'field'    => 'term_id',
						'terms'    => $terms,
					);
				}
			}

			if ( ! empty( $tax_query ) ) {
				$wp_query_args['tax_query'] = array_merge( array( 'relation' => $relation ), $tax_query );
			}
		}

		return $wp_query_args;
	}

	/**
	 * Convert kebab case to pascal case.
	 *
	 * @param string $string Kebab case string.
	 *
	 * @since 1.4.2
	 * @return string
	 */
	public static function convert_kebab_to_pascal_case( string $string ) {
		$words = explode( '-', $string );

		$capitalized_words = array_map( 'ucfirst', $words );

		$pascal_case_string = implode( '', $capitalized_words );

		return $pascal_case_string;
	}
}
