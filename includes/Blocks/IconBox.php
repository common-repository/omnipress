<?php

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;

class IconBox extends AbstractBlock {
	private array $block_attributes = array(
		'iconPosition' => 'top',
		'title'        => 'User-Friendly Interface',
		'desc'         => 'Navigate with ease using our intuitive and user-friendly interface. Designed for simplicity and efficiency.',
		'icon'         => 'fas fa-laptop',
		'showIcon'     => true,
		'showTitle'    => true,
		'showDesc'     => true,
		'wrapper'      => array(
			'background'   => '#f3f3f3',
			'borderRadius' => '12px 12px 12px 12px',
			'padding'      => '20px',
		),
		'descStyle'    => array(),
		'titleStyle'   => array(
			'margin'   => '23px 0px 8px 0px',
			'fontSize' => '25px',
		),
		'iconStyle'    => array(
			'justifyContent' => 'center',
			'fontSize'       => '32px',
		),
	);


	public function get_block_attributes() {
		return $this->block_attributes;
	}

	public function render( $attributes, $content, $block ) {
		$block->parsed_block['attrs'] = array_merge( $this->get_block_attributes(), $attributes );

		return $content;
	}
}
