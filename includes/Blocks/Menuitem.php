<?php

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;

( defined( 'ABSPATH' ) ) || exit;

/**
 * Menuitem class.
 */
class Menuitem extends AbstractBlock {
	/**
	 * @inheritDoc
	 */
	public function render( $attributes, $content, $block ) {
		if ( ! isset( $attributes['submenuId'] ) ) {
			return $content;
		}

		$submenu_post_content = get_post( $attributes['submenuId'] )->post_content;
		$submenu_post_content = apply_filters(
			'the_content',
			$submenu_post_content
		);

		$content = str_replace( '{content}', $submenu_post_content, $content );

		return $content;
	}
}
