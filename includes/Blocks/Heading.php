<?php

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;

( defined( 'ABSPATH' ) ) || exit;

/**
 * Heading class.
 */
class Heading extends AbstractBlock {
	public function render( $attributes, $content, $block ) {
		// that code was compatible for query block
		// if ( isset( $block->context['postId'] ) && $block->context['postId'] ) {
		// $block_id = $attributes['blockId'];
		// $classes  = array(
		// " op-block__heading-wrapper--{$block_id}",
		// "op-{$block_id}",
		// );

		// $tag_name           = $attributes['headingType'] ?? 'h2';
		// $title              = get_the_title( $block->context['postId'] );
		// $link               = get_the_permalink( $block->context['postId'] );
		// $wrapper_attributes = get_block_wrapper_attributes(
		// array(
		// 'class'     => implode( ' ', $classes ),
		// 'data-type' => 'omnipress/heading',
		// )
		// );
		// return sprintf(
		// '<div %3$s> <a href="%1$s"> <%2$s class="op-block__heading-content heading-%5$s"> %4$s </%2$s> </a></div>',
		// $link,
		// $tag_name,
		// $wrapper_attributes,
		// $title,
		// $block_id,
		// );
		// }

		return $content;
	}
}
