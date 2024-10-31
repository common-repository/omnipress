<?php

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;
use OmnipressPro\PostsFields;

defined( 'ABSPATH' ) || exit;



/**
 * Class DynamicQueryField
 *
 * @author omnipressteam
 *
 * @since 1.4.2
 *
 * @package Omnipress\Blocks
 */
class DynamicFieldQuery extends AbstractBlock {

	/**
	 * @inheritDoc
	 */
	public function render( $attributes, $content, $block ) {
		$post_id          = isset( $block->context['postId'] ) ? $block->context['postId'] : '';
		$field_tye        = isset( $attributes['fieldType'] ) ? $attributes['fieldType'] : '';
		$query_field_name = isset( $attributes['queryFieldName'] ) ? $attributes['queryFieldName'] : '';

		if ( is_single() && ! $post_id ) {
			$post_id = get_queried_object_id();
		}

		if ( ! $post_id || ! $field_tye || ! $query_field_name ) {
			return '';
		}

		$post_field         = new PostsFields();
		$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => "op-{$attributes['blockId']}" ) );
		$is_link_enabled    = isset( $attributes['isLink'] ) && $attributes['isLink'];
		$tag_name           = isset( $attributes['tag'] ) ? $attributes['tag'] : 'div';

		$tag_name = 'p' === $tag_name ? 'div' : $tag_name;

		$args = array(
			'post_id'    => $post_id,
			'field_type' => $field_tye,
			'field_name' => $query_field_name,
		);

		$content = $post_field->retrieve_query_content( $args );

		$wrapper_tag = "<{$tag_name} {$wrapper_attributes}>";
		$link        = "<a style='all: inherit; cursor: pointer;' href='" . get_permalink( $post_id ) . "'>$content</a>";
		$close_tag   = "</{$tag_name}>";

		$html_output = $is_link_enabled ? "{$wrapper_tag}{$link}{$close_tag}" : "{$wrapper_tag}{$content}{$close_tag}";

		return $html_output;
	}
}
