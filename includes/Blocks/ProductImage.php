<?php

namespace Omnipress\Blocks;

class ProductImage {

	/**
	 *
	 */
	public static function render_block_content( $attributes, $content ) {
		global $product;

		if ( ! $product ) {
			return 'That blocks only Work inside single product page\'s template';
		}

		$attachment_ids = $product->get_gallery_image_ids();

		$post_thumbnail_id = $product->get_image_id();

		$post_thumbnail_url = array(
			'thumbnail' => wp_get_attachment_image_url( $post_thumbnail_id, 'full' ),
			'full'      => wp_get_attachment_image_url( $post_thumbnail_id, 'full' ),
			'large'     => wp_get_attachment_image_url( $post_thumbnail_id, 'large' ),
		);

		$product_images = array( $post_thumbnail_url );

		if ( $attachment_ids && $product->get_image_id() ) {
			foreach ( $attachment_ids as $attachment_id ) {
				$product_images[] = array(
					'full'      => wp_get_attachment_image_url( $attachment_id, 'full' ),
					'thumbnail' => wp_get_attachment_image_url( $attachment_id ),
					'large'     => wp_get_attachment_image_url( $attachment_id, 'large' ),
					'srcset'    => wp_get_attachment_image_srcset( $attachment_id, 'full' ),
				);
			}
		}

		ob_start();
		?>
		<div <?php echo get_block_wrapper_attributes( array( 'class' => 'op-block__product-image alignwide op-' . $attributes['blockId'] . ' has-gallery-' . $attributes['galleryPosition'] ?? 'bottom' ) ); ?> >
			<div class="op-block__product-image--wrapper">
				<?php if ( count( $product_images ) >= 1 ) : ?>
					<div class="op-block__product-image--prev">
						<i class="fas fa-angle-left"></i>
					</div>
				<?php endif; ?>

				<?php if ( $attributes['hasMagnifiers'] ) : ?>
					<div id="op-drift__viewer"></div>
				<?php endif; ?>

				<img
					src="<?php echo esc_attr( wp_get_attachment_image_url( $post_thumbnail_id, 'full' ) ); ?>"
					alt="<?php echo esc_attr( get_the_title( $post_thumbnail_id ) ); ?>"
					class="op-block__product-image--img op-magnifier__image "
					data-zoom="<?php echo esc_attr( wp_get_attachment_image_url( $post_thumbnail_id, 'large' ) ); ?>"
					loading="lazy"
				/>

				<?php if ( count( $product_images ) >= 1 ) : ?>
					<div class="op-block__product-image--next">
						<i class="fas fa-angle-right"></i>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $product_images ) && 1 < count( $product_images ) ) : ?>
				<div class="op-block__product-image--gallery">

					<?php if ( count( $product_images ) > $attributes['imagePerView'] ?? 6 ) : ?>
						<div class="op-block__product-image--prev gallery-prev">
							<i class="fas fa-angle-left"></i>
						</div>
					<?php endif; ?>

					<swiper-container
						slides-per-view="<?php echo esc_attr( $attributes['imagePerView'] ?? 4 ); ?>"
						cssMode="true"
						space-between="14"
						speed="500"
						loop="true"
						direction="<?php echo esc_attr( ( 'top' === $attributes['galleryPosition'] || 'bottom' === $attributes['galleryPosition'] ) ? 'horizontal' : 'vertical' ); ?>"
					>
						<?php foreach ( $product_images as $index => $image_url ) : ?>
							<swiper-slide>
								<div class="op-block__product-image--gallery-image gallery-image__wrapper <?php echo esc_attr( 0 === $index ? 'activated' : '' ); ?>">
									<img
										src="<?php echo esc_attr( $image_url['thumbnail'] ); ?>"
										alt="<?php echo esc_attr( get_the_title( $post_thumbnail_id ) ); ?>"
										data-zoom="<?php echo esc_attr( $image_url['full'] ); ?>"
										data-large = "<?php echo esc_attr( $image_url['large'] ); ?>"
										loading="lazy"
										class="op-block__product-image--gallery-item"
									/>
								</div>

								<div class="op-block__product-image--gallery-mask"></div>
							</swiper-slide>
						<?php endforeach; ?>
					</swiper-container>

				<?php if ( count( $product_images ) > $attributes['imagePerView'] ?? 6 ) : ?>
					<div class="op-block__product-image--next gallery-next">
						<i class="fas fa-angle-right"></i>
					</div>
				<?php endif; ?>

				</div>
			<?php endif; ?>
		</div>


		<?php

		$content .= ob_get_clean();

		return $content;
	}
}
