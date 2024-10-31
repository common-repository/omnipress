<?php

/**
 * Frontend content.
 *
 * @package Description.
 * */

?>

<div id="aos op-grid-<?php echo esc_attr( $attributes['blockId'] ); ?>" class="<?php echo esc_attr( $attributes['carousel'] ? 'swiper op-block-product-grid' : 'op-block-product-grid' ); ?>">
	<?php
		$navigation = '<div class = "swiper-button-next next-' . $attributes['blockId'] . '">
			<i class="' . $attributes['arrowNext'] . '"> </i>
		</div>
		<div class="swiper-button-prev prev-' . $attributes['blockId'] . '">
			<i class = "' . $attributes['arrowPrev'] . '"> </i>
		</div>';

		$pagination = '<div class="swiper-pagination pagination-' . $attributes['blockId'] . '"> </div>';

	if ( $attributes['carousel'] ) {
		if ( str_contains( $attributes['options'], 'arrow' ) ) {
			echo $navigation; //@phpcs:ignore
		}

		if ( str_contains( $attributes['options'], 'pagination' ) ) {
			echo $pagination; //@phpcs:ignore
		}
	}
	?>

	<div class="<?php echo esc_attr( $attributes['carousel'] ? $attributes['blockId'] . ' swiper-wrapper' : $attributes['blockId'] . ' product-grid-wrap' ); ?> op-woo__grid-wrapper  op-product-column-<?php echo esc_attr( $attributes['columns'] ); ?>">
		<!-- Skeleton product cards (placeholders) -->
		<?php for ( $i = 0; $i < $attributes['columns'] * $attributes['rows']; $i++ ) { ?>
			<div class="card is-loading">
				<div class="image"></div>
				<div class="content">
					<h2></h2>
					<p></p>
				</div>
			</div>
		<?php } ?>
		<pre style="opacity:0 !important;" id="op-woo-data-<?php echo esc_attr( $attributes['blockId'] ); ?>">
			<?php echo wp_json_encode( $attributes ); ?>
		</pre>
	</div>
</div>
