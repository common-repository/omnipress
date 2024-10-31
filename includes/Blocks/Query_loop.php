<?php
namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;

/**
 * Query Template block.
 *
 * @since 1.4.1
 * @package Omnipress
 */
class Query_loop extends AbstractBlock {

	private $attributes = array(
		'blockId'      => '',
		'queryId'      => false,
		'otherFilters' => array(),
		'layout'       => array(
			'columnCount' => 3,
		),
		'query'        => array(
			'perPage'  => 6,
			'pages'    => 0,
			'offset'   => 0,
			'postType' => 'post',
			'order'    => 'desc',
			'orderBy'  => 'date',
			'author'   => null,
			'search'   => '',
			'sticky'   => '',
			'inherit'  => false,
			'include'  => null,
		),
	);

	/**
	 * Block name.
	 *
	 * @var string $name Block name.
	 */
	public $name = 'query-template';

	/**
	 * {@inheritDoc}
	 */
	public function render( $attributes, $content, $block ) {

		// Enqueue modules js to use interactivity apis.

		if ( isset( $attributes['enhancedPagination'] ) && $attributes['enhancedPagination'] ) {
			$suffix = wp_scripts_get_suffix();
			if ( defined( 'IS_GUTENBERG_PLUGIN' ) && IS_GUTENBERG_PLUGIN ) {
				$module_url = gutenberg_url( '/build/interactivity/query.min.js' );
			}

			wp_register_script_module(
				'@wordpress/block-library/query',
				isset( $module_url ) ? $module_url : includes_url( "blocks/query/view{$suffix}.js" ),
				array(
					array(
						'id'     => '@wordpress/interactivity',
						'import' => 'static',
					),
					array(
						'id'     => '@wordpress/interactivity-router',
						'import' => 'dynamic',
					),
				),
				defined( 'GUTENBERG_VERSION' ) ? GUTENBERG_VERSION : get_bloginfo( 'version' )
			);
			wp_enqueue_script_module( '@wordpress/block-library/query' );
		}

		wp_register_script_module(
			'omnipress/assets/client/view/query',
			OMNIPRESS_PRO_URL . 'interactivity-modules/query-view-module.js',
			array(
				array(
					'id'     => '@wordpress/interactivity',
					'import' => 'static',
				),
				array(
					'id'     => '@wordpress/interactivity-router',
					'import' => 'dynamic',
				),
			),
			OMNIPRESS_PRO_VERSION
		);

		wp_enqueue_script_module( 'omnipress/assets/client/view/query' );

		$p = new \WP_HTML_Tag_Processor( $content );

		if ( $p->next_tag() ) {
			// Add the necessary directives.
			$p->set_attribute( 'data-wp-interactive', 'core/query' );
			$p->set_attribute( 'data-wp-router-region', 'query-' . $attributes['queryId'] );
			$p->set_attribute( 'data-wp-context', '{}' );
			$p->set_attribute( 'data-wp-key', $attributes['queryId'] );
			$content = $p->get_updated_html();
		}

		return $content;
	}
}
