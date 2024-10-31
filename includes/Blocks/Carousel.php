<?php

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;

/**
 * Class Carousel block main class.
 *
 * @package Omnipress\Blocks
 */
class Carousel extends AbstractBlock {

	/**
	 * Render the Carousel block.
	 *
	 * @param array  $attributes Block attributes.
	 * @param string $content    Block content.
	 * @param object $block      Block instance.
	 *
	 * @return string Rendered block content.
	 */
	public function render( $attributes, $content, $block ) {
		$block_id                     = $attributes['blockId'];
		$default_attributes           = $this->get_default_attributes();
		$attributes                   = array_merge( $default_attributes, $attributes );
		$block->parsed_block['attrs'] = $attributes;

		$swiper_settings    = $this->get_swiper_settings( $attributes, $block_id );
		$wrapper_attributes = $this->get_wrapper_attributes(
			$block_id
		);

		$this->enqueue_carousel_script();

		$content = sprintf(
			'<div %6$s %1$s><div class="swiper-wrapper">%2$s </div> %3$s %4$s %5$s</div>',
			$wrapper_attributes,
			$content,
			$attributes['showNavigation'] ? $this->get_navigation_markup( $block_id, $attributes ) : '',
			$attributes['showPagination'] ? $this->get_pagination_markup( $block_id ) : '',
			$attributes['showScrollbar'] ? $this->get_scrollbar_markup( $block_id ) : '',
			wp_interactivity_data_wp_context( $swiper_settings ),
		);

		return $content;
	}

	/**
	 * Get default attributes for the block.
	 *
	 * @return array
	 */
	private function get_default_attributes() {
		return array(
			'navigation' => array(
				'fontSize'     => '26px',
				'color'        => '#ffffff',
				'background'   => '#9b51e0',
				'padding'      => '0 8px',
				'borderRadius' => '5px',
			),
			'pagination' => array(
				'height'       => '5px',
				'width'        => '20px',
				'borderRadius' => '13px',
				'background'   => '#000000',
			),
		);
	}

	/**
	 * Get Swiper settings based on block attributes.
	 *
	 * @param array  $attributes Block attributes.
	 * @param string $block_id   Block ID.
	 *
	 * @return array
	 */
	private function get_swiper_settings( $attributes, $block_id ) {
		return array(
			'loop'         => filter_var( $attributes['loop'], FILTER_VALIDATE_BOOLEAN ),
			'autoplay'     => filter_var( $attributes['autoPlay'], FILTER_VALIDATE_BOOLEAN ),
			'slidePerView' => $attributes['smColumns'] ? $attributes['columns'] : 3,
			'spaceBetween' => $attributes['smGap'] ? $attributes['gap'] : 3,
			'breakpoints'  => array(
				'680'  => array(
					'slidesPerView' => $attributes['mdColumns'],
					'spaceBetween'  => $attributes['mdGap'],
				),
				'1024' => array(
					'slidesPerView' => $attributes['columns'],
					'spaceBetween'  => $attributes['gap'],
				),
			),
			'pagination'   => $attributes['showPagination'] ? $this->get_pagination_settings( $block_id ) : '',
			'scrollbar'    => $attributes['showScrollbar'] ? $this->get_scrollbar_settings( $block_id ) : '',
			'navigation'   => $attributes['showNavigation'] ? $this->get_navigation_settings( $block_id ) : '',
		);
	}

	/**
	 * Get wrapper attributes for the block.
	 *
	 * @param string $block_id Block ID.
	 *
	 * @return string Wrapper attributes.
	 */
	private function get_wrapper_attributes( $block_id ) {
		return get_block_wrapper_attributes(
			array(
				'data-type'           => 'omnipress/carousel',
				'class'               => "op-block__carousel op-{$block_id} swiper",
				'data-wp-interactive' => 'omnipress/slider',
				'data-wp-init'        => 'callbacks.init',
			)
		);
	}

	/**
	 * Enqueue the carousel script.
	 */
	private function enqueue_carousel_script() {
		wp_register_script_module(
			'omnipress/block-library/carousel',
			OMNIPRESS_URL . 'assets/block-interactivity/slider-module.js',
			array(
				array(
					'id'     => '@wordpress/interactivity',
					'import' => 'static',
				),
			),
			OMNIPRESS_VERSION
		);

		wp_enqueue_script_module( 'omnipress/block-library/carousel' );
	}

	/**
	 * Get navigation markup.
	 *
	 * @param string $block_id   Block ID.
	 * @param array  $attributes Block attributes.
	 *
	 * @return string Navigation markup.
	 */
	private function get_navigation_markup( $block_id, $attributes ) {
		return sprintf(
			'<button class="swiper-button-prev swiper-button-prev-%1$s"><i class="%2$s"></i></button>
            <button class="swiper-button-next swiper-button-next-%1$s"><i class="%3$s"></i></button>',
			esc_attr( $block_id ),
			esc_attr( $attributes['arrowPrev'] ),
			esc_attr( $attributes['arrowNext'] )
		);
	}

	/**
	 * Get pagination markup.
	 *
	 * @param string $block_id Block ID.
	 *
	 * @return string Pagination markup.
	 */
	private function get_pagination_markup( $block_id ) {
		return sprintf(
			'<div class="swiper-pagination swiper-pagination-%s"></div>',
			esc_attr( $block_id )
		);
	}

	/**
	 * Get scrollbar markup.
	 *
	 * @param string $block_id Block ID.
	 *
	 * @return string Scrollbar markup.
	 */
	private function get_scrollbar_markup( $block_id ) {
		return sprintf(
			'<div class="swiper-scrollbar swiper-scrollbar-%s"></div>',
			esc_attr( $block_id )
		);
	}

	/**
	 * Get pagination settings for Swiper.
	 *
	 * @param string $block_id Block ID.
	 *
	 * @return array Pagination settings.
	 */
	private function get_pagination_settings( $block_id ) {
		return array(
			'el'        => ".swiper-pagination-{$block_id}",
			'clickable' => true,
			'type'      => 'bullets',
		);
	}

	/**
	 * Get scrollbar settings for Swiper.
	 *
	 * @param string $block_id Block ID.
	 *
	 * @return array Scrollbar settings.
	 */
	private function get_scrollbar_settings( $block_id ) {
		return array(
			'el' => ".swiper-scrollbar-{$block_id}",
		);
	}

	/**
	 * Get navigation settings for Swiper.
	 *
	 * @param string $block_id Block ID.
	 *
	 * @return array Navigation settings.
	 */
	private function get_navigation_settings( $block_id ) {
		return array(
			'nextEl' => ".swiper-button-next-{$block_id}",
			'prevEl' => ".swiper-button-prev-{$block_id}",
		);
	}
}
