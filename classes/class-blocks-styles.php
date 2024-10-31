<?php

namespace OMNIPRESS;

/**
 * Blocks styles handler
 *
 * @since 1.4.1
 *
 * @author Omnipresssteam
 * @copyright (c) 2024
 */
class Class_blocks_styles {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wp_footer', array( $this, 'maybe_update_rendered_blocks_styles' ) );
	}

	/**
	 * Retrieve all used blocks.
	 *
	 * @return array
	 */
	public function get_used_blocks() {
		$all_used_blocks = apply_filters( 'op_rendered_blocks', array() );

		return $all_used_blocks;
	}


	/**
	 * Retrieve current page or post Id.
	 *
	 * @return string|int
	 */
	public function get_current_page_or_archive_id() {
		if ( is_singular() ) {
			return get_queried_object_id();
		} elseif ( is_category() || is_tag() || is_tax() ) {
			return get_queried_object_id();
		} elseif ( is_home() ) {
			return get_option( 'page_for_posts' );
		} elseif ( is_front_page() ) {
			return get_option( 'page_on_front' );
		} elseif ( is_author() ) {
			$author = get_queried_object();
			return $author->ID;
		} elseif ( is_post_type_archive() ) {

			return get_queried_object_id();
		} elseif ( is_date() ) {
			return 'date';
		} elseif ( is_404() ) {
			return 'error';
		}
		return 'none';
	}

	/**
	 * Update current page blocks lists if any blocks added or removed.
	 *
	 * @since 1.4.2
	 *
	 * @access public
	 * @return void
	 */
	public function has_rendered_blocks_changed() {
		$current_blocks  = $this->get_used_blocks();
		$post_id         = $this->get_current_page_or_archive_id();
		$previous_blocks = get_option( $post_id . '-used_blocks', array() );

		return $current_blocks !== $previous_blocks;
	}


	public function get_block_style( string $style_name ) {
		$css_path = OMNIPRESS_BLOCKS_STYLES_PATH . "$style_name.css";

		if ( file_exists( $css_path ) ) {
			return FileSystemUtil::read_file( $css_path );
		}

		return '';
	}

	/**
	 * Changed blocks styles if any changes on frontend rendered blocks.
	 *
	 * @return void
	 */
	public function maybe_update_rendered_blocks_styles() {

		$transient_key = 'used_blocks_' . $this->get_current_page_or_archive_id();
		$cache_styles  = get_transient( $transient_key );
		$used_blocks   = $this->get_used_blocks();

		// in development phase it will check and updated on every render.
		if ( $this->has_rendered_blocks_changed() || ( empty( $css ) && ! empty( $used_blocks ) ) || 'local' === wp_get_environment_type() || 'development' === wp_get_environment_type() ) {
			$page_id = \get_queried_object_id();

			$updated_styles = array();

			$block_chunks = array_chunk( $used_blocks, 9, true );

			if ( ! empty( $block_chunks ) && is_array( $block_chunks ) ) {
				$chunk_pointer = 1;

				foreach ( $block_chunks as $block_chunk ) {
					$chunk_css = '';
					foreach ( $block_chunk as $block_name => $value ) {
						if ( isset( $block_name ) ) {
							$css_file_name = explode( '/', $block_name )[1] . '.min';
							$chunk_css    .= $this->get_block_style( $css_file_name );
						}
					}

					if ( ! empty( $chunk_css ) ) {
						$updated_styles[ $chunk_pointer ] = $chunk_css;
					}

					++$chunk_pointer;
				}
			}

			$cache_styles = $updated_styles;

			set_transient( $transient_key, $cache_styles );
			update_option( $this->get_current_page_or_archive_id() . '-used_blocks', $used_blocks );
		}

		if ( ! empty( $cache_styles ) && is_array( $cache_styles ) ) {
			foreach ( $cache_styles as $key => $css ) {
				if ( ! empty( $css ) ) {
					echo "<style class='omnipress-blocks-styles-{$key}'>{$css}</style>";
				}
			}
		}
	}
}

new Class_blocks_styles();
