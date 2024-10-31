<?php

namespace Omnipress\classes;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.


if ( ! class_exists( 'BlockAssets' ) ) {
	/**
	 * BlockAssets class.
	 */
	final class BlocksAssets {
		public static $instance            = null;
		private $used_blocks               = array();
		private ?OPFileSystem $file_system = null;

		public bool $has_already_created = false;

		private function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'handle_blocks_styles' ), 12, 2 );
		}
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function handle_blocks_styles(): void {
			// Early exit if not a block theme.
			if ( ! current_theme_supports( 'block-templates' ) ) {
				return;
			}

			// exit if already created styles files.
			if ( $this->has_already_created ) {
				return;
			}

			global $wp_query;
			$post = $wp_query->get_queried_object();

			if ( ! $post ) {
				switch ( true ) {
					case is_search():
							$page_id = 'search';
						break;

					case is_front_page():
							$page_id = 'front';
						break;

					default:
						$page_id = 'error';
						break;

				}
			} else {
				// check WordPress default pages which are not created by woocommerce.
				$page_id = $this->get_page_id( $post );
			}

			global $_wp_current_template_content;
			$page_content = '';
			$version      = time();

			if ( isset( $_wp_current_template_content ) ) {
				$page_content = $_wp_current_template_content;
			}

			if ( isset( $page_id ) && -1 !== $page_id && ! is_404() ) {
				$post = get_post( $page_id );

				if ( $post ) {
					$page_content .= $post->post_content;
				}
			}

			if ( ! isset( $page_id ) || is_404() ) {
				$page_id = 0;
			}

			// Find blocks list of omnipress blocks which are used in post content.
			$this->used_blocks = BlocksAssetsHelper::parse_omnipress_unique_blocks( $page_content );

			// initialize file system to perform files related works.
			$file_system       = OPFileSystem::get_instance();
			$this->file_system = $file_system->initialize_filesystem();

			$block_frontend_styles_dir = $this->get_block_frontend_styles_path();

			// All blocks styles.
			$frontend_style_path = $this->get_blocks_styles_path( $page_id, 'basedir' );
			$frontend_style_url  = $this->get_blocks_styles_path( $page_id, 'baseurl' );

			// Check whether blocks have been changed (removed or added new ones).
			// If no changes are detected, stop further processing.
			$this->has_already_created = $this->has_change_detected( $page_id, $this->used_blocks );

			if ( ! $this->has_already_created && $this->used_blocks ) {
				if ( ! is_numeric( $page_id ) ) {
					// If current page is not a post, then save in option table.
					update_option( $page_id . '_omnipress_used_blocks', $this->used_blocks );
				} else {
					// If current page is not a post, then save post meta.
					update_post_meta( $page_id, $page_id . '_omnipress_used_blocks', $this->used_blocks, array() );
				}
			}

			/**
			 * If not added or removed blocks, then stop further processing.
			 */
			if ( ! $this->has_already_created ) {
				$styles = '';

				// remove file if any blocks are not used .
				if ( empty( $this->used_blocks ) && is_file( $frontend_style_path ) ) {
					// remove post meta also.
					BlocksAssetsHelper::reset_post_meta( $page_id, '_omnipress_used_blocks' );
					$is_removed = $file_system->remove_file( $frontend_style_path );
					if ( is_wp_error( $is_removed ) ) {
						echo 'Something went wrong when enqueue blocks styles';
					}
					return;
				}

				// Retrieve all used blocks styles and create a single file.
				if ( $this->used_blocks && is_array( $this->used_blocks ) ) {

					foreach ( $this->used_blocks as $block_name ) {
						$block_name = str_replace( 'omnipress/', '/', $block_name ?? '' );

						// Enqueue block's view scripts.
						// BlocksAssetsHelper::enqeue_view_scripts( $block_name );

						$current_page_style_path = $block_frontend_styles_dir . $block_name . '.css';

						if ( file_exists( $current_page_style_path ) ) {
							$styles .= $file_system->get_contents( $current_page_style_path );
						}
					}
				}

				if ( $styles ) {
					$created = $file_system->create_and_write_file( $frontend_style_path, $styles );

					if ( is_wp_error( $created ) ) {
						echo 'Something went wrong when enqueue blocks styles';
					}

					$this->has_already_created = true;
				}
			}

			wp_enqueue_style( 'omnipress-blocks-styles', $frontend_style_url, array(), $version );
		}

		private function has_change_detected( $page_id, array $used_blocks ): bool {
			$already_created = false;

			// Since all products share the same template, we can use it universally.
			// Therefore, it's more efficient to check the blocks of this template
			// instead of checking each product individually.
			if ( ! is_numeric( $page_id ) ) {
				// if current page is not a post then we can use the option to check if the blocks have already been added.
				$existing_blocks = get_option( $page_id . '_omnipress_used_blocks', array() );
			} else {
				// if current page is a post then we can use the post meta to check if the blocks have already been added.
				$existing_blocks = get_post_meta( $page_id, $page_id . '_omnipress_used_blocks', true );
			}

			if ( ! is_array( $existing_blocks ) || ! is_array( $used_blocks ) ) {
				return false;
			}

			if ( count( $existing_blocks ) !== count( $used_blocks ) ) {
				return false;
			}

			if ( ! empty( $used_blocks ) && ! empty( $existing_blocks ) ) {
				$already_created = true;

				foreach ( $used_blocks as $block ) {
					if ( ! in_array( $block, $existing_blocks ) ) {
						$already_created = false;
						break;
					}
				}
			}

			return $already_created;
		}

		private function get_block_frontend_styles_path() {
			return OMNIPRESS_PATH . 'assets/css/blocks';
		}

		private function get_blocks_styles_path( $page_id, string $type ) {
			$upload_dir             = wp_upload_dir();
			$block_style_upload_dir = $upload_dir[ $type ] . '/omnipress-blocks';
			$this->file_system->create_dir( $block_style_upload_dir );

			return $block_style_upload_dir . "/$page_id.css";
		}

		private function get_page_id( $post ) {
			$page_id = 0;
			if ( ( is_single() || is_archive() || is_front_page() || is_search() || is_attachment() || is_page() ) && isset( $post ) ) {
				$page_id = $post->ID;
			}

			if ( is_front_page() && ! isset( $post ) ) {
				$page_id = 'front_page';
			}

			// Make compatible with woocommerce pages or posts.
			if ( class_exists( 'WooCommerce' ) ) {
				if ( is_woocommerce() || is_shop() || is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() ) {
					$page_id = BlocksAssetsHelper::get_woocommerce_page_id();
				}
			}

			return $page_id;
		}
	}

}
