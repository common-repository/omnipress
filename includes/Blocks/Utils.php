<?php

namespace Omnipress\Blocks;

class Utils {

	/**
	 * Generates an HTML anchor link with the provided output, href, and new tab settings.
	 *
	 * @param mixed  $output The content to be displayed inside the anchor tag.
	 * @param string $href The URL the anchor tag should point to.
	 * @param bool   $new_tab If true, opens the link in a new tab with appropriate attributes.
	 * @return string The generated anchor link HTML.
	 */
	public static function generate_output_link( $output, $href, $new_tab, $rel = 'noreferrer noopener' ) {
		return sprintf( '<a href="%s"%s>%s</a>', $href, $new_tab ? ' target="_blank" rel="' . $rel . '"' : '', $output );
	}

	/**
	 * Find Blocks which used inside current post.
	 *
	 * @param int $post_id post id.
	 * @return array
	 */
	public static function find_blocks_in_related_posts( int $post_id ) {
		// Retrieve the post content.
		$post = get_post( $post_id );
		if ( ! $post ) {
			return array();
		}

		$content = $post->post_content;

		// Parse the blocks within the post content/.
		$blocks = parse_blocks( $content );
		self::get_blocks( $blocks, $all_blocks );

		foreach ( $blocks as $block ) {
			// If a 'menuitem' block is found, parse the related post.
			if ( 'omnipress/menuitem' === $block['blockName'] ) {
				if ( isset( $block['attrs']['submenuId'] ) ) {
					$related_post_id = $block['attrs']['submenuId'];
					$related_blocks  = self::find_blocks_in_related_posts( $related_post_id );
					$all_blocks      = array_merge( $all_blocks, $related_blocks );
				}
			}
		}

		return array_unique( $all_blocks );
	}

	public static function get_blocks( $blocks, &$all_blocks ) {

		foreach ( $blocks as $block ) {
			$all_blocks[] = $block['blockName'];
			// get nested blocks also.
			if ( $block['innerBlocks'] ) {
				self::get_blocks( $block['innerBlocks'], $all_blocks );
			}
		}

		return $all_blocks;
	}
}
