<?php
if ( ! empty( $quantities ) ) {
	?>

	<div id="op-cartModal" class="modal op-cart-modal--show">
		<span class="op-cartmodal--dismiss-btn" onclick="dissmissModal(event)">&times;</span>
		<div class="cart-content">
			<!-- Display the list of currently added products in the cart -->
			<h4 class="modal-message__title success"><?php echo esc_html__( 'Successfully added to the cart', 'omnipress' ); ?></h4>
			<ul id="cartItems">
				<?php
				if ( ! empty( $quantities ) ) {

					foreach ( $quantities as $id => $qty ) {
						if ( $qty == 0 ) {
							continue;
						}
						?>
						<li>
							<a href="<?php echo esc_url( get_permalink( $id ) ); ?>">
							<?php echo esc_html( get_the_title( $id ) ); ?>
							</a>
							<span> x <?php echo esc_html( $qty ); ?></span>
						</li>
						<?php
					}
				}
				?>
			</ul>
			<!-- Display the total price of the cart -->
			<div class="is-layout-flex">
				<p>
					<?php
					$total_price = 0;
					if ( is_array( $quantities ) && ! empty( $quantities ) ) :

						foreach ( $quantities as $id => $qty ) {
							$total_price += intval( $qty ) * intval( get_post_meta( $id, '_price', true ) );
							$total_price  = number_format( $total_price, 2 );

						}
						?>
						<span class="total-price">
							<span><?php echo esc_html__( 'Total Price: ', 'omnipress' ); ?></span>
							<?php echo esc_html( get_woocommerce_currency_symbol() ); ?>
							<?php echo esc_html( $total_price ); ?>
						</span>
						<?php endif; ?>
				</p>

				<a class="op-link" style="margin-left:auto;" href="/cart"><?php echo esc_html__( 'Go to cart', 'omnipress' ); ?></a>
			</div>

		</div>
	</div>
<?php } ?>
