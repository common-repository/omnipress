<?php

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;


/**
 * Class Container block main class.
 *
 * @author Ishwor Khadka <asishwor@gmail.com>
 * @package app\core
 */

class Container extends AbstractBlock {


	/**
	 * @inheritDoc
	 */
	public function render( $attributes, $content, $block ) {
		$inherit_classes = isset( $block->context['classNames'] ) ? $block->context['classNames'] : '';

		$block_wrapper_attributes = get_block_wrapper_attributes(
			array(
				'class'     => 'op-block op-container op-' . $attributes['blockId'] . ' ' . $inherit_classes,
				'data-type' => 'omnipress/container',
			)
		);

		$tag_name         = $attributes['tagName'];
		$background_type  = $attributes['backgroundType'];
		$video_opacity    = $attributes['videoOpacity'] || '1';
		$column_width     = $attributes['columnWidth'];
		$video_background = $attributes['videoBackground'];

		$video_background = 'video' === $background_type ? '<div class="video-background__wrapper alignleft" style="opacity: ' . $video_opacity . ';marginLeft: 0;"><video src="%s" loop muted autoPlay /></div>' : '';

		$content = sprintf(
			'<%1$s %2$s><div class="op-container-innerblocks-wrapper %3$s"> %4$s  %5$s</div></%1$s>',
			$tag_name,
			$block_wrapper_attributes,
			$column_width,
			$video_background,
			$content
		);

		return $content;
	}
}
