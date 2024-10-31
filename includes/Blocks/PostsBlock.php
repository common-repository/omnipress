<?php
/**
 * Product lists block.
 *
 * @package WooCommerce\Blocks
 */

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;
/**
 * Class PostsBlock
 *
 * This abstract class is used as a base for displaying posts in a block. It contains methods for fetching and rendering posts,
 * as well as generating HTML markup for individual posts.
 *
 * @since 1.2.3
 */
abstract class PostsBlock extends AbstractBlock {

	/**
	 * Array to store fetched posts.
	 *
	 * @var array
	 */
	protected array $posts = array();

	/**
	 * Array to store block attributes.
	 *
	 * @var array
	 */
	protected array $attributes = array();

	/**
	 * Layout type for displaying posts.
	 *
	 * @var string
	 */
	protected string $layout_type = 'grid';

	/**
	 * Current post object.
	 *
	 * @var \WP_Post
	 */
	protected \WP_Post $post;

	/**
	 * Number of columns to display posts in.
	 */
	protected string $columns;

	/**
	 * Sets block attributes.
	 *
	 * This method should be implemented by child classes to set the attributes specific to the block.
	 *
	 * @param array $attributes Block attributes.
	 * @return void
	 */
	abstract public function set_attributes( array $attributes );

	/**
	 * Sets the current post object.
	 *
	 * @param \WP_Post $post The post object.
	 * @return void
	 */
	public function set_post( \WP_Post $post ) {
		$this->post = $post;
	}

	/**
	 * Retrieves query arguments for fetching posts.
	 *
	 * @return array Query arguments.
	 */
	public function get_query_args() {
		if ( ! empty( $this->attributes ) ) {
			return array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => $this->attributes['postPerPage'] ?? 6,
				'category'       => (int) ( $this->attributes['selectedCategoryId'] ?? '' ),
				'orderby'        => $this->attributes['orderby'] ?? 'desc',
				'order'          => $this->attributes['order'] ?? 'date',
				'search'         => $this->attributes['search'] ?? '',
			);
		}
	}

	/**
	 * Fetches posts based on the query arguments.
	 *
	 * @return array|\WP_Post[] Array of post objects.
	 */
	public function fetch_posts() {
		if ( ! function_exists( 'get_posts' ) ) {
			include_once ABSPATH . 'wp-admin/includes/post.php';
		}
		$args = self::get_query_args();
		return get_posts( $args );
	}

	/**
	 * Get Current Post Image.
	 *
	 * @param int $post_id post id.
	 * @return string
	 */
	public function get_post_image( int $post_id ) {
		if ( ! $post_id && ! $this->post ) {
			return '';
		}

		if ( ! $post_id ) {
			$post_id = $this->post->ID;
		}
		$post_image = get_the_post_thumbnail_url( $post_id, 'thumbnail' ) ? get_the_post_thumbnail_url( $post_id, 'thumbnail' ) : OMNIPRESS_URL . 'assets/images/placeholder.webp';
		$alt        = get_the_title( $post_id );
		return "<figure><img src='{$post_image}' alt='{ $alt }'/></figure>";
	}
	/**
	 * Single post template.
	 *
	 * @param int $post_id post id.
	 * @return string
	 */
	public function post_card_template( int $post_id ) {
		$layout                 = esc_attr( $this->layout_type );
		$post_categories_markup = $this->attributes['disableCategory'] ? '' : $this->get_post_categories_markup( $post_id );
		$author_id              = (int) $this->post->post_author;
		$title                  = esc_html( get_the_title( $post_id ) );
		$excerpt                = $this->attributes['disableDescription'] ? '' : get_the_excerpt( $post_id );
		$date                   = $this->attributes['disableDate'] ? '' : get_the_date( 'd M Y', $post_id );
		$post_image_html        = $this->attributes['disableFeaturedImage'] ? '' : $this->get_post_image( $post_id );
		$permalink              = esc_url( get_permalink( $post_id ) );
		$author                 = $this->attributes['disableAuthor'] ? '' : get_the_author_meta( 'display_name', $author_id );
		$author_link            = $this->attributes['disableAuthor'] ? '' : get_the_author_meta( 'link', $author_id );

		return sprintf(
			'<div class="op-layout-col-%11$s op-layout-col-%12$s-md op-layout-col-%13$s-sm">
				<div class="op-block__post-%1$s-card">
					<div class="op-block__post-%1$s-card-image">%2$s%3$s</div>
					<div class="op-block__post-%1$s-card-content">
						<div class="op-block__post-%1$s-card-meta">
							<div class="op-block__post-%1$s-card-date">%4$s</div>
							<div class="op-block__post-%1$s-card-author"><a href="%5$s">%10$s %6$s</a></div>
						</div>
						<h4 class="op-block__post-%1$s-card-title"><a href="%7$s" aria-label="%8$s">%8$s</a></h4>
						<div class="op-block__post-%1$s-card-description"><p>%9$s</p></div>
					</div>
				</div>
			</div>',
			$layout,
			$post_image_html,
			$post_categories_markup,
			$date,
			$author_link,
			$author,
			$permalink,
			$title,
			$excerpt,
			$this->attributes['disableAuthor'] ? '' : 'By',
			isset( $this->attributes['columns'] ) ? $this->attributes['columns'] : '3',
			isset( $this->attributes['mdColumns'] ) ? $this->attributes['mdColumns'] : '2',
			isset( $this->attributes['smColumns'] ) ? $this->attributes['smColumns'] : '1'
		);
	}


	/**
	 * Get single post categories markup.
	 *
	 * @param int $post_id post id.
	 * @return string
	 */
	public function get_post_categories_markup( $post_id ) {
		$categories    = get_the_category( $post_id );
		$category_html = sprintf(
			'<div class="op-block__post-%s-card-categories">',
			$this->layout_type
		);

		if ( $categories ) {
			foreach ( $categories as $category ) {
				$category_link  = get_category_link( $category->term_id );
				$category_html .= sprintf(
					'<a class="wp-element-button" href="%s">%s</a>',
					$category_link,
					$category->name
				);
			}
		}
		$category_html .= '</div>';
		return $category_html;
	}

	/**
	 * Posts Wrapper.
	 *
	 * This method outputs the opening divs for the post content.
	 *
	 * @return string HTML markup for the post content wrappers.
	 */
	public function posts_wrapper_start() {
		$wrapper_attributes = get_block_wrapper_attributes(
			array(
				'class' => 'op-' . $this->attributes['blockId'] . ' op-block__post-' . $this->layout_type,
			)
		);

		return sprintf(
			'<div %s><div class="op-grid-container">',
			$wrapper_attributes,
		);
	}

	/**
	 * Posts Wrapper end.
	 *
	 * This method outputs the closing divs for the post content wrapper.
	 *
	 * @return string HTML markup to close the post content wrappers.
	 */
	public function posts_wrapper_end() {
		return '</div></div>';
	}



	/**
	 * Render All posts of block frontend.
	 *
	 * @param array $posts all fetched posts.
	 * @return string
	 */
	public function render_posts( array $posts ) {
		$content = $this->posts_wrapper_start();

		foreach ( $posts as $post ) {
			$this->set_post( $post );
			$content .= $this->post_card_template( $post->ID );
		}

		$content .= $this->posts_wrapper_end();

		return $content;
	}
}
