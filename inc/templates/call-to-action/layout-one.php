<?php
/**
 * Template for call to action layout one.
 *
 * @package Omnipress
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$op_cta_lay_one_attributes = $args['attributes'];

?>
<section class="op-block-section">
	<div class="op-block-row">
		<div class="op-column-wrap op-row-layout-equal">
			<div class="op-column op-column-1">
				<div class="op-col-inner">

					<div class="op-block-cta cta-text-center cta-bg-dark">
						<div class="op-block-cta-description">

							<?php if ( ! empty( $op_cta_lay_one_attributes['title'] ) ) { ?>
								<h2 class="op-block-cta-header">
									<?php echo esc_html( $op_cta_lay_one_attributes['title'] ); ?>
								</h2>
							<?php } ?>

							<?php
							echo ! empty( $op_cta_lay_one_attributes['description'] ) ? wp_kses_post( "<p>{$op_cta_lay_one_attributes['description']}</p>" ) : '';
							?>

						</div>

						<?php
						if ( ! empty( $op_cta_lay_one_attributes['displayButton'] ) && $op_cta_lay_one_attributes['displayButton'] ) {
							?>
							<div class="op-block-btn-wrapper">
								<a
									class="op-block-btn op-block-cta-btn"
									href="<?php echo esc_url( $op_cta_lay_one_attributes['buttonLink'] ); ?>"
									target="<?php echo ! empty( $op_cta_lay_one_attributes['openNewTab'] ) ? '_blank' : ''; ?>"
								><?php echo esc_html( $op_cta_lay_one_attributes['buttonLabel'] ); ?></a>
							</div>
							<?php
						}
						?>
					</div>

				</div> <!-- col inner -->
			</div> <!-- column-->
		</div> <!-- column wrap-->
	</div> <!-- row -->
</section> <!-- section -->
