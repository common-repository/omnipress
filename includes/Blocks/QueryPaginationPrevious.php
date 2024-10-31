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
class QueryPaginationPrevious extends AbstractBlock {


	private $attributes = array(
		'blockId'      => '',
		'queryId'      => false,
		'otherFilters' => array(),
		'layout'       => array(
			'columnCount'   => 3,
			'mdColumnCount' => 2,
			'smColumnCount' => 1,
		),
	);

	/**
	 * Block name.
	 *
	 * @var string $name Block name.
	 */
	private $name = 'query-template';

	/**
	 * {@inheritDoc}
	 */
	public function render( $attributes, $content, $block ) {
		$arrow_map = array(
			'none'    => '',
			'arrow'   => 'fa-arrow-left',
			'chevron' => 'fa-angle-left',
			'angle'   => 'fa-angle-left',
			'caret'   => 'fa-caret-left',
		);

		$wrapper_attributes = get_block_wrapper_attributes(
			array(
				'class' => 'op-block__query-pagination-previous op-' . $attributes['blockId'],
			)
		);

		$show_label             = isset( $block->context['showLabel'] ) ? (bool) $block->context['showLabel'] : false;
		$page_key               = isset( $block->context['queryId'] ) ? 'query-' . $block->context['queryId'] . '-page' : 'query-page';
		$page                   = empty( $_GET[ $page_key ] ) ? 1 : (int) $_GET[ $page_key ];
		$default_label          = __( 'Previous', 'omnipress' );
		$label_text             = isset( $attributes['label'] ) && ! empty( $attributes['label'] ) ? esc_html( $attributes['label'] ) : $default_label;
		$label                  = $show_label ? $label_text : '';
		$custom_query           = new \WP_Query( Helpers::build_query_vars_from_omnipresss_query_block( $block, $page ) );
		$custom_query_max_pages = (int) $custom_query->max_num_pages;
		$arrow                  = isset( $block->context['paginationArrow'] ) ? $arrow_map[ $block->context['paginationArrow'] ] : '';

		$content = '';
		if ( ! $block->context['showLabel'] && 'none' === $block->context['paginationArrow'] || 0 >= $custom_query->post_count ) {
			return '';
		}

		if ( $page > 1 ) {
			$content = sprintf(
				'<a href="%1$s" %2$s>%3$s %4$s</a>',
				esc_url( add_query_arg( $page_key, $page - 1 ) ),
				$wrapper_attributes,
				$show_label ? __( $label, 'omnipress' ) : '',
				$arrow ? '<i class="fas ' . esc_attr( $arrow ) . '"></i>' : '' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}
		wp_reset_postdata();

		$p = new \WP_HTML_Tag_Processor( $content );

		// Navigate to page without page reload.
		if ( isset( $block->context['enhancedPagination'] ) && $block->context['enhancedPagination'] ) {
			if ( $p->next_tag( array( 'tag_name' => 'a' ) ) ) {
				$p->set_attribute( 'data-wp-key', 'omnipress-query-previous' );
				$p->set_attribute( 'data-wp-on--click', 'omnipress/query::actions.navigate' );
				$p->set_attribute( 'data-wp-on-async--mouseenter', 'omnipress/query::actions.prefetch' );
				$p->set_attribute( 'data-wp-watch', 'omnipress/query::callbacks.prefetch' );
				$content = $p->get_updated_html();
			}
		}
		return $content;
	}

	public function getAttributes(): array {
		return $this->attributes;
	}
}
