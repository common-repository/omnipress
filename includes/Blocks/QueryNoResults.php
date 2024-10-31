<?php

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;
use Omnipress\Helpers;

/**
 * Query Template block.
 *
 * @since 1.4.1
 * @package Omnipress
 */
class QueryNoResults extends AbstractBlock {
	/**
	 * {@inheritDoc}
	 */
	public function render( $attributes, $content, $block ) {
		if ( empty( trim( $content ) ) ) {
			return '';
		}

		$page_key = isset( $block->context['queryId'] ) ? 'query-' . $block->context['queryId'] . '-page' : 'query-page';
		$page     = empty( $_GET[ $page_key ] ) ? 1 : (int) $_GET[ $page_key ];

		// Override the custom query with the global query if needed.
		$use_global_query = ( isset( $block->context['query']['inherit'] ) && $block->context['query']['inherit'] );
		if ( $use_global_query ) {
			global $wp_query;
			$query = $wp_query;
		} else {
			$query_args =  Helpers::build_query_vars_from_omnipresss_query_block( $block, $page );
			$query      = new \WP_Query( $query_args );
		}

		if ( $query->post_count > 0 ) {
			return '';
		}

		$classes            = ( isset( $attributes['style']['elements']['link']['color']['text'] ) ) ? 'has-link-color' : '';
		$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => $classes ) );
		return sprintf(
			'<div %1$s>%2$s</div>',
			$wrapper_attributes,
			$content
		);
	}
}
