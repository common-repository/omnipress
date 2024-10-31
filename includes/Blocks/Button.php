<?php

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;

class Button extends AbstractBlock {

	/**
	 * Block's default attributes.
	 *
	 * @var array
	 */
	protected array $attributes = array(
		'wrapper'   => array(

			'backgroundColor' => '#175fff',
			'padding'         => '10px 20px',
			'border'          => 'unset',
			'cursor'          => 'pointer',
		),
		'button'    => array(
			'fontWeight' => '500',
			'fontSize'   => '16px',
			'color'      => '#ffffff',
			'gap'        => '8px',
		),
		'link'      => '',
		'newTab'    => false,
		'rel'       => '',
		'dataType'  => '',
		'dataId'    => '',
		'dataTitle' => '',
	);



	public function render( $attributes, $content, $block ) {

		$attributes = array_merge( $this->attributes, $attributes );

		$block->parsed_block['attrs'] = $attributes;

		$link       = $attributes['link'];
		$target     = $attributes['newTab'];
		$rel        = $attributes['rel'];
		$data_type  = $attributes['dataType'];
		$data_id    = $attributes['dataId'];
		$data_title = $attributes['dataTitle'];
		$text       = $attributes['content'];
		$unique_id  = $attributes['blockId'];

		$markup = "<div data-id='$data_id' data-title='$data_title' data-type='$data_type' class='op-block-button__link op-block__button-content op-$unique_id'>";

		if ( $link ) {
			$markup .= Utils::generate_output_link( $link, $target, $rel, $text );
		}

		$markup .= "<button class='op-block-button__link op-block__button-content'> $text</button>";
		$markup .= '</div>';

		return $content;
	}
}
