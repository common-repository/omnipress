<?php

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;
use Omnipress\Models\WoocommerceModel;

( defined( 'ABSPATH' ) ) || exit;

/**
 * Woo-category class.
 */
class Woocategory extends AbstractBlock {

	/**
	 * Block's default attributes.
	 *
	 * @var $attributes
	 */
	protected $attributes = array(
		'blockId'        => '',
		'css'            => '',
		'card'           => array(),
		'perPage'        => 6,
		'columns'        => 6,
		'mdColumns'      => 3,
		'smColumns'      => 2,
		'columnGap'      => 30,
		'mdColumnGap'    => '',
		'smColumnGap'    => '',
		'rowGap'         => 30,
		'mdRowGap'       => '',
		'smRowGap'       => '',
		'rows'           => 1,
		'wrapper'        => array(),
		'categoryTitle'  => array(),
		'arrowNext'      => 'fa fa-angle-right',
		'arrowPrev'      => 'fa fa-angle-left',
		'preset'         => 'one',
		'productsCount'  => array(),
		'subCategory'    => true,
		'categoryButton' => array(),
		'categoryImage'  => array(),
		'cardContent'    => array(),
		'carousel'       => false,
	);


	/**
	 * @inheritDoc
	 */
	public function render( $attributes, $content, $block ) {
		$attributes = array_merge( $this->attributes, $attributes );

		if ( isset( $block->context['classNames'] ) && 'swiper-slide' === $block->context['classNames'] ) {
			return $this->get_all_categories_markup( $attributes, 'swiper-slide' );
		}

		$layout_classes = 'op-grid-col-' . $attributes['columns'] . ' op-grid-col-' . $attributes['mdColumns'] . '-md op-grid-col-' . $attributes['smColumns'] . '-sm';

		$wrapper_attributes = get_block_wrapper_attributes(
			array(
				'class' => "op-block op-{$attributes['blockId']}",
			)
		);

		$html = sprintf(
			'<div %s><div class="%s">%s</div></div>',
			$wrapper_attributes,
			$layout_classes,
			$this->get_all_categories_markup( $attributes ),
		);

		$html .= $content;

		return $html;
	}

	public function get_all_categories_markup( $attributes, $class_names = '' ) {
		$preset_type = $attributes['preset'];
		$parent      = $attributes['subCategory'] ? '' : 0;
		$columns     = intval( $attributes['columns'] );
		$rows        = intval( $attributes['rows'] );
		$per_page    = $attributes['perPage'];
		$html        = '';
		$wc_model    = WoocommerceModel::get_instance();
		$args        = array(
			'taxonomy'     => 'product_cat',
			'orderby'      => 'name',
			'show_count'   => 0,
			'pad_counts'   => 0,
			'hierarchical' => 1,
			'title_li'     => '',
			'hide_empty'   => 0,
			'number'       => $per_page,
			'parent'       => $parent,
		);
		$categories  = $wc_model->get_all_categories( $args );

		foreach ( $categories as $category ) {
			$html .= $this->render_category( $preset_type, $attributes, $category, $class_names );
		}

		return $html;
	}
	private function render_category( $preset_type, array $attributes, $cata, $class_names ) {
		$term          = get_term_by( 'slug', $cata->slug, 'product_cat' );
		$category_link = '';

		if ( $term && ! is_wp_error( $term ) ) {
			$category_link = get_term_link( $term, 'product_cat' );
		}

		$thumbnail_id = get_term_meta( $cata->cat_ID, 'thumbnail_id', true );

		// Get the image URL.
		$shop_catalog_img = wp_get_attachment_image_src( $thumbnail_id, 'full' );

		$term_link = get_term_link( $cata, 'product_cat' );

		switch ( $preset_type ) {
			case 'two':
				return sprintf(
					'<a href="%4$s" class="oop-woo__category-card-content op-woo__category-pre2 op-woo__category-card">
						<figure>
							<img class="op-woo__category-image" src="%3$s" alt="%1$s" />
						</figure>
						<div class="op-woo__category-card-title op-woo__card-content">
							<h3 class="p-woo__category-card-title-name op-woo__category-title">%1$s</h3>
						</div>
						<span class="cat-count product-category-count"> %2$s</span>
					</a>',
					$cata->name,
					$cata->category_count,
					is_array( $shop_catalog_img ) ? $shop_catalog_img[0] : OMNIPRESS_URL . 'assets/images/placeholder_category.webp',
					$category_link,
					$class_names
				);
			case 'three':
				return sprintf(
					'<a href="%4$s" class="op-woo__category-pre3 op-woo__card op-woo__category-card" title=" %3$s">
						<div class="op-woo__category-pre3-heading-img">
							<div class="op-woo__category-pre3-label-wrap">
								<h3 class="op-woo__category-pre3-label op-woo__category-title category-title op-woo__category-title"> %1$s</h3>
								<span class="cat-count product-category-count"> %2$s Products</span>
							</div>
							<figure>
								<img alt="%1$s" class="op-woo__category-image category-image" src="%3$s" class="" decoding="async" />
							</figure>
						</div>
					</a>',
					$cata->name,
					$cata->category_count,
					$shop_catalog_img ? $shop_catalog_img[0] : OMNIPRESS_URL . 'assets/images/placeholder_category.webp',
					$category_link,
					$class_names
				);
			default:
				return sprintf(
					'<a href="%4$s" class="op-woo__category-pre1 op-woo__card op-woo__category-card">
						<figure>
							<img class="op-woo__category-image" src=" %3$s" alt=" %1$s" />
						</figure>
						<div class="op-woo__category-card-title op-woo__category-pre1-title op-woo__card-content">
							<h3 class="op-woo__category-title">
									%1$s
							</h3>
							<p class="op-woo__category-pre1-count product-category-count"> %2$s products</p>
						</div>
					</a>',
					$cata->name,
					$cata->category_count,
					$shop_catalog_img ? $shop_catalog_img[0] : OMNIPRESS_URL . 'assets/images/placeholder_category.webp',
					$category_link,
					$class_names
				);
		}
	}
}
