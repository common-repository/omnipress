<?php
/**
 * @package omnipress
 */

$output  = '<div ' . esc_attr( get_block_wrapper_attributes() ) . '><div class="op-block-slider-' . esc_attr( $attributes['blockId'] ) . ' op-block-slider" data-attributes="' . esc_attr( wp_json_encode( $attributes ) ) . '">';
$output .= '<div class="swiper op-slide-sliderWrapper swiper-' . esc_attr( $attributes['blockId'] ) . ' op-slide-sliderWrapper">';
$output .= '<div class="swiper-wrapper op-block-slider-wrapper op-sliderWrapper">';

	$contents = $attributes['sliderContent'];

foreach ( $contents as $content ) {
	$output .= '<div class="swiper-slide op-slide-item op-slide-slides">';
	$output .= '<div class="op-slide-background" style="background:' . esc_attr( $content['background'] ) . '; background-image:url(' . esc_url( $content['backgroundImage'] ) . '); background-position:' . esc_attr( $content['backgroundImagePosition'] ) . ' "></div>';
	$output .= '<div class="op-slide-background-overlay" style="background:' . esc_attr( $content['overlay'] ) . ';  "></div>';
	$output .= '<div class="op-slide-inner">';
	$output .= '<div class="op-slide-inner-content op-slide-innerContent">';

	$output                            .= '<div class="op-slide-image">';
	'' !== $content['image'] ? $output .= '<img class="op-swiper-slideImage op-block-slider-slide-image op-slide-slideImage" src="' . esc_url( $content['image'] ) . '" />' : '';
	$output                            .= '</div>';

	$output .= '<div style="text-align:var(--op-slider-title-align);" > <h3 class="op-slide-title op-slide-slideTitle">' . esc_html( $content['title'] ) . '</h3> </div>';

	$output .= '<p class="op-slide-descri op-slide-slideExcerpt">' . esc_html( $content['excerpt'] ) . '</p>';

	if ( $content['newTab'] ) {
		$output .= '<div class="button-container op-slide-slideButtonContainer">
                <a href="' . esc_url( $content['link'] ) . '" target="_blank" class="op-slide-button op-slide-button  op-slide-slideButton">' . esc_html( $content['buttonContent'] ) . '</a>
            </div>';
	} else {
		$output .= '<div class="button-container op-slide-slideButtonContainer">
                <a href="' . esc_url( $content['link'] ) . '" class="op-slide-button op-slide-slideButton op-block-slideButton">' . esc_html( $content['buttonContent'] ) . '</a>
            </div>';
	}

	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
}

$output .= '</div>';

$output .= '<div style="width:' . $attributes['slideArrow']['width'] . ';" class="swiper-button-next op-slide-slideArrow op-swiper-slide-btn-next-' . esc_attr( $attributes['blockId'] ) . '">' . $attributes['arrowIconNext'] . '</div>';
$output .= '<div style="width:' . $attributes['slideArrow']['width'] . ';" class="swiper-button-prev op-slide-slideArrow op-swiper-slide-btn-prev-' . esc_attr( $attributes['blockId'] ) . '">' . $attributes['arrowIconPrev'] . '</div>';

$output .= '<div style="display:var(--op-slider-scrollbar-display !important);" class="swiper-scrollbar swiper-scrollbar-' . esc_attr( $attributes['blockId'] ) . '"></div>';

$output .= '<div class="swiper-pagination  op-slide-slidePagination op-slide-slidePaginationContainer op-block-slidePagination swiper-pagination-' . esc_attr( $attributes['blockId'] ) . ' swiper-pagination-clickable op-swiper-pagination"></div>';

$output .= '</div>';
$output .= '</div></div>';

echo $output;
