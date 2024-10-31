<?php

namespace Omnipress\Blocks;

/**
 * Block product categories.
 */
class ProductCategories extends DynamicAbstract {

	protected string $block_name     = 'product-categories';
	protected string $block_category = 'woocommerce';

	/**
	 * Default attribute values, should match what's set in JS `registerBlockType`.
	 *
	 * @var array
	 */
	protected $defaults = array(
		'hasCount'         => true,
		'hasImage'         => false,
		'hasEmpty'         => false,
		'isDropdown'       => false,
		'isHierarchical'   => true,
		'showChildrenOnly' => false,
	);

	/**
	 * Get block attributes.
	 *
	 * @return array
	 */
	protected function get_block_attributes() {
		return array_merge(
			parent::get_block_attributes(),
			array(
				'hasCount'         => $this->get_schema_boolean( true ),
				'hasImage'         => $this->get_schema_boolean( false ),
				'hasEmpty'         => $this->get_schema_boolean( false ),
				'isDropdown'       => $this->get_schema_boolean( false ),
				'isHierarchical'   => $this->get_schema_boolean( true ),
				'showChildrenOnly' => $this->get_schema_boolean( false ),
			)
		);
	}

	/**
	 * @param array $attributes
	 * @return int[]|string|string[]|\WP_Error|\WP_Term[]
	 */
	private function get_all_woocommerce_categories( array $attributes ) {
		$children_only = $attributes['showChildOnly'] && is_product_category();

		if ( $children_only ) {
			$term_id    = get_queried_object_id();
			$categories = get_terms(
				'product_cat',
				array(
					'hide_empty'   => ! ( $attributes['hasEmpty'] ?? false ),
					'pad_counts'   => true,
					'hierarchical' => true,
					'child_of'     => $term_id,
				)
			) ?? array();

		} else {
			$categories = get_terms(
				'product_cat',
				array(
					'hide_empty'   => ! $attributes['hasEmpty'],
					'pad_counts'   => true,
					'hierarchical' => true,
				)
			);
		}

		return $categories;
	}

	/**
	 * Build hierarchical tree of categories.
	 *
	 * @param array $categories List of terms.
	 * @param bool  $children_only Is the block rendering only the children of the current category.
	 * @return array
	 */
	protected function build_category_tree( $categories, $children_only ) {
		$categories_by_parent = array();
		if ( empty( $categories ) ) {
			return array();
		}

		foreach ( $categories as $category ) {
			if ( ! isset( $categories_by_parent[ 'cat-' . $category->parent ] ) ) {
				$categories_by_parent[ 'cat-' . $category->parent ] = array();
			}
			$categories_by_parent[ 'cat-' . $category->parent ][] = $category;
		}

		$parent_id = $children_only ? get_queried_object_id() : 0;
		$tree      = $categories_by_parent[ 'cat-' . $parent_id ] ?? array(); // these are top level categories. So all parents.
		unset( $categories_by_parent[ 'cat-' . $parent_id ] );

		if ( $tree && ! empty( $tree ) ) {
			foreach ( $tree as $category ) {
				if ( ! empty( $categories_by_parent[ 'cat-' . $category->term_id ] ) ) {
					$category->children = $this->fill_category_children( $categories_by_parent[ 'cat-' . $category->term_id ], $categories_by_parent );
				}
			}
		}

		return $tree;
	}

	/**
	 * Build hierarchical tree of categories by appending children in the tree.
	 *
	 * @param array $categories List of terms.
	 * @param array $categories_by_parent List of terms grouped by parent.
	 * @return array
	 */
	protected function fill_category_children( $categories, $categories_by_parent ) {
		foreach ( $categories as $category ) {
			if ( ! empty( $categories_by_parent[ 'cat-' . $category->term_id ] ) ) {
				$category->children = $this->fill_category_children( $categories_by_parent[ 'cat-' . $category->term_id ], $categories_by_parent );
			}
		}
		return $categories;
	}

	/**
	 * @param array $attributes
	 * @return array|int[]|string|string[]|\WP_Error|\WP_Term[]
	 */
	protected function get_categories( array $attributes ) {
		$hierarchical                  = $attributes['isHierarchical'] ?? true;
		$term_id                       = get_queried_object_id();
		$show_only_selected_categories = $attributes['categorySelected'];
		$categories                    = array();

		switch ( $show_only_selected_categories ) {
			case true:
				$selected_categories_slugs = $attributes['selectedCategoriesList'] ?? '';
				$categories                = $this->get_category_by_id( $selected_categories_slugs );
				break;

			default:
				$categories = $this->get_all_woocommerce_categories( $attributes );
		}

		if ( ! is_array( $categories ) || empty( $categories ) ) {
			return array();
		}

		// This ensures that no categories with a product count of 0 is rendered.
		if ( ! $attributes['hasEmpty'] ) {
			$categories = array_filter(
				$categories,
				function ( $category ) {
					return 0 !== $category->count;
				}
			);
		}

		return $categories;
	}


	/**
	 * Get Woocommerce Category by provided slug.
	 *
	 * @param string|array $slug Slug of query category.
	 *
	 * @return array|false|\WP_Error|\WP_Term|null
	 */
	private function get_category_by_id( $ids ) {
		if ( empty( $ids ) ) {
			return '';
		}

		if ( is_array( $ids ) ) {
			$categories = array();

			foreach ( $ids as $query_id ) {
				$product_id = (int) preg_replace( '/[^0-9]/', '', $query_id );

				$categories[] = get_term( $product_id, 'product_cat' );
			}

			return $categories;
		}

		$product_id = (int) preg_replace( '/[^0-9]/', '', $ids );
		return get_term( $product_id, 'product_cat' );
	}

	/**
	 * Render Frontend content.
	 *
	 * @param array     $attributes block attributes.
	 * @param string    $content block content.
	 * @param \WP_Block $blocks block instance.
	 * @return string
	 */
	public function render( $attributes, $content, $block ) {
		$categories = $this->get_categories( $attributes );
		$content   .= $this->render_list_items( $categories, $attributes );
		return $content;
	}

	/**
	 * @param $category
	 * @return string
	 */
	public function get_category_label( $category ) {
		return sprintf(
			'<h4><a href="%s" target="_self">%s</a></h4>',
			esc_attr( get_term_link( $category->term_id, 'product_cat' ) ),
			esc_html( $category->name )
		);
	}

	private function layout_one( array $attributes, $category ) {
		return sprintf(
			'<div class="op-woo-catlist__item"><div class="op-woo-catlist__item-title">%s  %s</div>%s</div>',
			$this->get_image_html( $category, $attributes ),
			$this->get_category_label( $category ),
			$this->getCount( $category, $attributes ),
		);
	}
	private function layout_two( array $attributes, $category ) {
		return sprintf(
			'<div class="op-woo-catlist__item">
					<div class="op-woo-catlist__item-image">%s</div>
					<div class="op-woo-catlist__item-title">%s  %s</div></div>',
			$this->get_image_html( $category, $attributes ),
			$this->get_category_label( $category ),
			$this->getCount( $category, $attributes ),
		);
	}

	/**
	 * Get layout according to attributes value.
	 *
	 * @param $attributes
	 * @param $category
	 * @return string|void
	 */
	private function get_layout( $attributes, $category ) {
		$layout = $attributes['layout'] ?? 1;

		$layout = match ( $layout ) {
			1 => $this->layout_one( $attributes, $category ),
			2 => $this->layout_two( $attributes, $category )
		};
			return $layout;
	}

	/**
	 * Start Category layout container.
	 *
	 * @param int $layout Category layout type.
	 *
	 * @return string
	 */
	private function start_container( int $layout, $blockId = '' ) {
		return sprintf(
			'<div ' . get_block_wrapper_attributes( array( 'class' => "op-block op-block-{$blockId} op-woo__catlist" ) ) . '><div class="op-block op-woo__catlist"><div class="op-woo__catlist-wrapper catlist-layout-%1$d">',
			$layout,
		);
	}

	/**
	 * End Category layout container.
	 *
	 * @return string
	 */
	private function end_container() {
		return '</div></div></div>';
	}
	/**
	 * Render a list of terms.
	 *
	 * @param array $categories List of terms.
	 * @param array $attributes Block attributes. Default empty array.
	 * @param int   $uid Unique ID for the rendered block, used for HTML IDs.
	 * @param int   $depth Current depth.
	 * @return string Rendered output.
	 */
	protected function render_list_items( array $categories, array $attributes, $uid = '', $depth = 0 ) {
		$layout        = $attributes['layout'] ?? 1;
		$children_only = is_product_category();

		$tree = $this->build_category_tree( $categories, $children_only );

		$output = $this->start_container( $layout, $attributes['blockId'] );
		$output = $this->start_container( $layout, $attributes['blockId'] );

		foreach ( $categories as $category ) {
			$output .= $this->get_layout( $attributes, $category );
		}

		$output .= $this->end_container();

		return preg_replace( '/\r|\n/', '', $output );
	}


	/**
	 * Get the count, if displaying.
	 *
	 * @param object $category Term object.
	 * @param array  $attributes Block attributes. Default empty array.
	 * @return string
	 */
	protected function getCount( $category, $attributes ) {
		if ( empty( $attributes['hasCount'] ) ) {
			return '';
		}

		if ( $attributes['isDropdown'] ) {
			return '(' . absint( $category->count ) . ')';
		}

		$screen_reader_text = sprintf(
			_n( '%d product', '%1$d Products', absint( $category->count ), 'woocommerce' ),
			absint( $category->count ),
		);

		return sprintf(
			' <a href="%s" class="op-woo-catlist__item-product-count"><span aria-hidden="true">%s %s</span><span class="screen-reader-text">%s</span></a>',
			esc_attr( get_term_link( $category->term_id, 'product_cat' ) ),
			absint( $category->count ),
			2 === $attributes['layout'] ? 'products' : '',
			esc_html( $screen_reader_text ),
		);
	}

	/**
	 * Returns the category image html
	 *
	 * @param \WP_Term $category Term object.
	 * @param array    $attributes Block attributes. Default empty array.
	 * @param string   $size Image size, defaults to 'woocommerce_thumbnail'.
	 * @return string
	 */
	public function get_image_html( $category, $attributes, $size = 'woocommerce_thumbnail' ) {
		if ( empty( $attributes['hasImage'] ) ) {
			return '';
		}

		$image_id = get_term_meta( $category->term_id, 'thumbnail_id', true );

		if ( ! $image_id ) {
			return sprintf(
				'<figure> <a href="#" class="op-woo-catlist__item-title-imglink" target="_self">%s</a></figure>',
				wc_placeholder_img( 'thumbnail' )
			);
		}

		return sprintf(
			'<figure> <a href="#" class="op-woo-catlist__item-title-imglink" target="_self">%s</a></figure>',
			wp_get_attachment_image( $image_id, 'thumbnail' )
		);
	}
}
