<?php
namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;

/**
 * Query Template block.
 *
 * @since 1.4.1
 * @package Omnipress
 */
class QueryLoop extends AbstractBlock {
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
			wp_register_script_module(
				'omnipress/assets/client/view/query',
				OMNIPRESS_PRO_URL . 'interactivity-modules/query-view-module.js',
				array(
					array(
						'id'     => '@wordpress/interactivity',
						'import' => 'dynamic',
					),
					array(
						'id'     => '@wordpress/interactivity-router',
						'import' => 'dynamic',
					),
				),
				OMNIPRESS_PRO_VERSION
			);

			wp_enqueue_script_module( 'omnipress/assets/client/view/query' );
		}


		$p = new \WP_HTML_Tag_Processor( $content );

		if ( $p->next_tag() ) {
			// Add the necessary directives.
			$p->set_attribute( 'data-wp-interactive', 'omnipress/query' );
			$p->set_attribute( 'data-wp-router-region', 'query-' . $attributes['queryId'] );
			$p->set_attribute( 'data-wp-context', '{}' );
			$p->set_attribute( 'data-wp-key', $attributes['queryId'] );
			$content = $p->get_updated_html();
		}

		return $content;
	}
}
