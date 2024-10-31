<?php
namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;


class Counter extends AbstractBlock {
	protected array $default_attributes = array(
		'icon'   => array(
			'fontSize' => '32px',
		),
		'number' => array(
			'fontWeight' => 700,
			'fontSize'   => '42px',
			'lineHeight' => '1.3em',
		),

	);
	/**
	 * @inheritDoc
	 */
	public function render( $attributes, $content, $block ) {
		$block->parsed_block['attrs'] = $attributes;
		return $content;
	}
}
