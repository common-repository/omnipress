<?php
/**
 * Product lists block.
 *
 * @package WooCommerce\Blocks
 */

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;

/**
 * Product Lists Block.
 */
class ProductList extends WoocommerceProducts {
	/**
	 * Product name
	 *
	 * @var string
	 */
	private string $product_name;

	/**
	 * Product prices
	 *
	 * @var string
	 */
	private string $prices;

	/**
	 * Regular price
	 *
	 * @var string
	 */
	private string $regular_price;

	/**
	 * Sale price
	 *
	 * @var string
	 */
	private string $sale_price;

	/**
	 * Rating count
	 *
	 * @var string
	 */
	private string $rating_count;

	/**
	 * This method calculates the price for the given product.
	 *
	 * @param  \WC_Product $product Product object.
	 * @return float|int Calculated price for the product.
	 */
	public function get_discount( $product ) {
		$regular_price = $product->get_regular_price();
		$sale_price    = $product->get_sale_price();

		if ( (float) $regular_price === (float) $sale_price ) {
			return 0;
		}

		return ceil( 100 - ( ( $sale_price * 100 ) / $regular_price ) );
	}

	/**
	 * Get Categories lists for a product.
	 *
	 * @param  \WC_Product $product The product object.
	 * @return array|string[] Array of product list names.
	 */
	protected function get_single_product_categories( $product ) {
		$categories = $product->get_category_ids();
		return array_map(
			function ( $category_id ) {
				$category = get_term_by( 'id', $category_id, 'product_cat' );
				return sprintf(
					'<a href="%s" class="product-item-category">%s</a>',
					get_term_link( $category ),
					$category->name
				);
			},
			$categories
		);
	}

	/**
	 * Get single product template HTML.
	 *
	 * @param  \WC_Product $product The product object.
	 * @return string HTML for the single product template.
	 */
	public function get_single_product_template( $product, $attributes ) {
		$categories = $this->get_single_product_categories( $product );
		$toggle     = $attributes['toggle'] ?? array();
		$wc_nonce   = wp_create_nonce( 'wc_store_api' );

		$html = sprintf(
			'<li class="product-item">
            <div class="product-item-inner">
                <div class="product-item-image">
                    <a href="%s">
                        <div class="op-product-labels">
                            %s
                        </div>
                        %s
                    </a>
                </div>
                <div class="product-item-details">
                    <div class="product-item-category-list">%s</div>
                    <a href="%s" class="product-item-title"><h4>%s</h4></a>
                    %s
                    <div class="product-item-description">%s</div>
                    <div class="product-item-price">%s</div>
                    <div class="product-item-buttons-wrap">
                        <div class="product-item-buttons">
                            <a href="%s" class="op-add_to_cart" data-product-id="%s" data-nonce="%s" data-wp-on--click="actions.addToCart" data-wp-type="%s" data-cart-page="%s" ><i class="fas fa-cart-shopping"></i>%s</a>
                        </div>
                    </div>
                </div>
            </div>
        </li>',
			$product->get_permalink(),
			$toggle['badge'] && $product->is_on_sale() ? sprintf(
				'<span class="op-onsale">%s</span><span class="op-discount">%s</span>',
				__( 'Sale!', 'omnipress' ),
				sprintf(
					'%s',
					$toggle['discount'] ? $this->get_discount( $product ) . '%' : ''
				)
			)
			: '',
			$toggle['image'] ? $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'op-woo-catlist__item-image' ) ) ?? '' : '',
			$toggle['categories'] ? implode( ',', $categories ) : '',
			$toggle['title'] ? $product->get_permalink() : '',
			$toggle['title'] ? $product->get_title() : '',
			$toggle['ratings'] ? $this->get_ratings( $product, $attributes ) : '',
			$toggle['title'] ? $product->get_description() : '',
			$toggle['price'] ? $product->get_price_html() : '',
			$toggle['cart'] ? $product->add_to_cart_url() : '',
			$product->get_id(),
			$wc_nonce,
			esc_attr( wp_json_encode( $product->get_type() ) ),
			wc_get_cart_url() ?? '/cart',
			$toggle['cart'] ? $product->add_to_cart_text() : '',
		);

		return $html;
	}


	/**
	 * Get the ratings HTML for a product.
	 *
	 * @param  \WC_Product $product The product object.
	 * @return string HTML for the ratings.
	 */
	public function get_ratings( $product ) {
		$average_ratings = $product->get_average_rating();

		$ratings = '<div class="product-item-rating">';
		foreach ( range( 0, 4 ) as $index ) {
			$ratings .= '<span>';
			if ( $average_ratings >= $index + 1 ) {
					$ratings .= '<i class="fas fa-star"></i>';
			} elseif ( $average_ratings >= $index + 0.5 ) {
				$ratings .= '<i class="fas fa-star-half-stroke"></i>';
			} else {
				$ratings .= '<i class="far fa-star"></i>';
			}
			$ratings .= '</span>';
		}
		$ratings .= '<span class="product-item-reviews-count">(' . $product->get_review_count() . ' reviews)</span>';
		$ratings .= '</div>';

		return $ratings;
	}

	public function get_all_posts() {
		$args  = array(
			'post_type'      => 'post',
			'posts_per_page' => -1,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'post_status'    => 'publish',
			'post_parent'    => 0,
			'category_name'  => '',
			'author'         => '',
			'author_name'    => '',
		);
		$posts = get_posts( $args );
		return $posts;
	}

	/**
	 * Render product list block.
	 *
	 * @param  array       $attributes Block attributes.
	 * @param  string      $content    Block content.
	 * @param  \WC_Product $block      Block instance.
	 * @return string Rendered block markup.
	 * @throws \Exception // Throws exception if there is an error rendering the block markup.
	 */
	public function render( $attributes, $content, $block ) {
		$category       = (int) ( $attributes['category'] ?? '' );
		$category       = get_term_by( 'id', $category, 'product_cat' );
		$is_hand_picked = (bool) ( $attributes['isHandPicked'] ?? false );

		if ( ! $is_hand_picked ) {
			$args = array(
				'limit'     => $attributes['rows'] ?? 3,
				'orderby'   => $attributes['sortType'] ?? '',
				'order'     => $attributes['sortOrder'] ?? '',
				'category'  => $category->slug ?? '',
				'showempty' => true,
				'offset'    => (int) ( $attributes['offset'] ?? 0 ),
			);
			$this->set_query_args( $args );
			$this->set_products();
			$products = $this->get_products();
		} else {
			$products = $this->get_handpicked_products( $attributes['selectedProducts'] ?? array() );
		}

		/**
		 * WooCommerce default sorting with price is not working properly as it sorts prices as strings.
		 * To address this issue, we're implementing custom sorting logic.
		 */
		if ( isset( $attributes['sortType'] ) && 'price' === $attributes['sortType'] ) {
			$this->sort_by_price( $products, $attributes );
		}

		foreach ( $products as $product ) {
			$content .= $this->get_single_product_template( $product, $attributes );
		}

		return sprintf(
			'<div data-wp-interactive="omnipress/wc" %s><div class="op-block__product-list-wrapper"> <ul class="op-block__product-list-products"> %s </ul></div></div>',
			get_block_wrapper_attributes( array( 'class' => "op-block op-{$attributes['blockId']} op-block__product-list" ) ),
			$content
		);
	}

	/**
	 * Sort products by price.
	 *
	 * @param array $products Array of products.
	 * @param array $attributes Block attributes.
	 * @return void Sorted products.
	 */
	private function sort_by_price( &$products, $attributes ) {
			usort(
				$products,
				function ( $a, $b ) use ( $attributes ) {
					return 'asc' === $attributes['sortOrder'] ?
						(int) $a->get_price() - (int) $b->get_price() :
						(int) $b->get_price() - (int) $a->get_price();
				}
			);
	}
}
