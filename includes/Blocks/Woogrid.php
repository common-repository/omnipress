<?php
namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;
use Omnipress\Models\WoocommerceModel;

/**
 * Product Grid render class.
 *
 * @package omnipress
 * @since 1.2.0
 */
class Woogrid extends AbstractBlock {
	/**
	 * Default block's attributes.
	 *
	 * @var array
	 */
	protected $attributes = array(
		'blockId'         => '',
		'carousel'        => false,
		'options'         => 'arrow',
		'arrowNext'       => 'fa fa-angle-right',
		'arrowPrev'       => 'fa fa-angle-left',
		'toggle'          => array(
			'title'           => true,
			'image'           => true,
			'addToCart'       => true,
			'price'           => true,
			'regularPrice'    => true,
			'badge'           => true,
			'ratings'         => true,
			'discountPercent' => true,
		),
		'rows'            => 2,
		'offset'          => 0,
		'columns'         => 3,
		'mdColumns'       => 3,
		'smColumns'       => 2,
		'perPage'         => 6,
		'grid'            => array(),
		'orderBy'         => 'popularity',
		'gridWrapper'     => array(),
		'mediaWrapper'    => array(),
		'mediaWrapperImg' => array(),
		'card'            => array(),
		'title'           => array(),
		'price'           => array(),
		'sale'            => array(),
		'discountedPrice' => array(),
		'discount'        => array(),
		'ratings'         => array(),
		'addToCart'       => array(),
		'content'         => array(),
		'outstock'        => array(),
	);


	/**
	 * Render Single product card.
	 *
	 * @param mixed $product WooCommerce Product.
	 * @param mixed $class_name Extra class name which changed according to context values.
	 *
	 * @return string
	 */
	protected function renderProduct( $product, $class_name ) {
		$html      = "<div class='op-product-item op-woo__card $class_name'>";
		$html     .= '<div class="op-product-item__content">';
		$html     .= '<figure class="op-product-item__media op-woo__media-wrapper">';
		$html     .= '<div class="op-product-link">';
		$images    = $product['images'];
		$thumbnail = $product['thumbnail'];
		$html     .= $thumbnail;
		$wc_nonce  = wp_create_nonce( 'wc_store_api' );

		if ( empty( $images ) ) {
			$html .= $thumbnail;
		}

		if ( ! empty( $images ) && isset( $images[1] ) ) {
			$html .= '<img loading="lazy" decoding="async" src="' . $images[0]['src'] . '" class="op-product-thumbnail op-woo__media-wrapper-img" alt="' . $images[0]['alt'] . '">';
		}
		$html .= '</div>';

		if ( $product['is_on_sale'] && $product['is_in_stock'] ) {
			$html .= '<div class="op-product-item__onsale-badge"><span class="onsale-badge-default op-woo__sale"> Sale </span></div>';
		}

		if ( false === $product['is_in_stock'] ) {
			$html .= '<div class="op-product-item__stock-alert-badge op-woo__outstock"><span class="out-of-stock-badge-default op-woo__out-of-stock"> Out of stock </span></div>';
		}

		$add_to_cart = sprintf(
			'<div class="op-product-item__add-to-cart"><a href="%1$s" data-product-id="%2$s" data-nonce="%3$s" data-wp-on--click="actions.addToCart" data-cart-page="%6$s" data-wp-type="%4$s" class="op-woo__add-to-cart"><span><i class="fas fa-cart-shopping"></i></span>%5$s</a></div>',
			esc_url( $product['add_to_cart'] ),
			esc_attr( $product['id'] ),
			$wc_nonce,
			esc_attr( json_encode( $product['type'] ) ),
			esc_html__( $product['add_to_cart_text'], 'omnipress' ),
			esc_url( wc_get_cart_url() )
		);

		$html .= $add_to_cart;
		// <div class="op-product-item__add-to-cart"><button data-product-id="' . esc_attr( $product['id'] ) . '" data-nonce="' . $wc_nonce . '" data-product-id="' . esc_attr( json_encode( $product['variations'] ) ) . '" data-wp-on--click="actions.addToCart" type="button" class="op-woo__add-to-cart"><span><i class="fas fa-cart-shopping"></i></span>Add to cart</button></div>';
		$html .= '</figure>';
		$html .= '<div class="op-product-item__details op-woo__content">';
		$html .= '<h3 class="op-product-loop-title op-woo__title"><a href="' . $product['permalink'] . '" >' . $product['name'] . '</a></h3>';
		$html .= '<div class="op-product__rating-wrapper op-woo__ratings">';

		for ( $i = 0; $i < 5; $i++ ) {
			$html .= '<span style="cursor: pointer;"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 0 0 .6 45.3l183.7 179.1-43.4 252.9a31.95 31.95 0 0 0 46.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2 17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9 183.7-179.1c5-4.9 8.3-11.3 9.3-18.3 2.7-17.5-9.5-33.7-27-36.3zM664.8 561.6l36.1 210.3L512 672.7 323.1 772l36.1-210.3-152.8-149L417.6 382 512 190.7 606.4 382l211.2 30.7-152.8 148.9z"></path></svg></span>';
		}
		$html .= '<span style="margin-left: 10px;"></span></div>';
		$html .= '<div class="op-product-rating"></div>';
		$html .= '<div class="op-product-price "><span class="price op-woo__price">' . $product['price_html'] . '</span>';
		if ( $product['discount_percentage'] ) {
			$html .= '<span class="discount op-woo__discount">-' . $product['discount_percentage'] . '</span>';
		}
		$html     .= '</div></div>';
			$html .= '</div>';
		$html     .= '</div>';
		return $html;
	}

	public function render( $attributes, $content, $block ) {
		$attributes = array_merge( $this->attributes, $attributes );

		$block->parsed_block['attrs'] = $attributes;

		// Carousel settings.
		$block_id   = $attributes['blockId'];
		$html       = '';
		$sort_attrs = isset( $attributes['sortType'] ) ? explode( ',', $attributes['sortType'] ) : array( 'date', 'DESC' );

		$args = array(
			'posts_per_page'      => $attributes['perPage'],
			'offset'              => $attributes['offset'],
			'order'               => $sort_attrs[1],
			'orderby'             => $sort_attrs[0],
			'product_category_id' => isset( $attributes['category'] ) ? array( $attributes['category'] ) : array(),
		);

		$wc = WoocommerceModel::get_instance();

		$products = $wc->get_all_products( $args );

		$wrapper_attributes = get_block_wrapper_attributes(
			array(

				'class'               => "op-woo-grid op-block__woogrid op-$block_id",
				'data-type'           => 'omnipress/woogrid',
				'data-wp-interactive' => 'omnipress/wc',
			)
		);

		$class_name = 'swiper-slide'; // Make compatible for carousel.

		if ( ! isset( $block->context['classNames'] ) || 'swiper-slide' !== $block->context['classNames'] ) {
			$html = sprintf(
				'<div %1$s>',
				$wrapper_attributes
			);

			$html .= '<div id="' . $block_id . '" class="op-block-product-grid">';
			$html .= "<div class='op-woo__grid-wrapper op-grid-col-{$attributes['columns']}  op-grid-col-{$attributes['mdColumns']}-md  op-grid-col-{$attributes['smColumns']}-sm'>";

			$class_name = '';
		}

		foreach ( $products as $product ) {
			$html .= $this->renderProduct( $product, $class_name );
		}

		if ( ! isset( $block->context['classNames'] ) || 'swiper-slide' !== $block->context['classNames'] ) {
			$html .= '</div></div></div>';
		}
		return $html;
	}
}
