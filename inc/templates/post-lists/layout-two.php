<?php

/**
 * Layout two template file for the post-lists block.
 *
 * @package Omnipress
 * @subpackage post-lists
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$op_pl_lay_two_posts      = $args['posts'];
$op_pl_lay_two_attributes = $args['attributes'];
$op_pl_lay_two_img_class  = $args['img_class'];

?>


<!-- <h1>Post Box Layout #2</h1> -->
<div class="op-block-postbox-2">
	<div class="op-block-post-wrapper">
		<div class="op-block-post-items-wrap op-block-post-row op-block-column-2">
			<?php
			if ( is_array( $op_pl_lay_two_posts ) && ! empty( $op_pl_lay_two_posts ) ) {
				foreach ( $op_pl_lay_two_posts as $op_pl_lay_two_post ) {
					$categories = get_the_category( $op_pl_lay_two_post->ID );
					if ( get_the_ID() === $op_pl_lay_two_post->ID ) {
						continue;
					}
					?>
					<div class="op-block-post-item">
						<div class="op-block-post-content-wrap op-post-content-overlay" style="<?php echo esc_attr( safecss_filter_attr( "background-color:{$op_pl_lay_two_attributes['descriptionBgColor']};" ) ); ?>">
							<div class="op-block-post-img-wrap <?php echo esc_attr( has_post_thumbnail( $op_pl_lay_two_post->ID ) ? $op_pl_lay_two_img_class : 'op-empty-featured-img' ); ?>">
								<?php
								if ( $op_pl_lay_two_attributes['displayFeaturedImage'] && has_post_thumbnail( $op_pl_lay_two_post ) ) {
									?>
									<a href="<?php the_permalink( $op_pl_lay_two_post ); ?>">
										<img src="<?php echo esc_url( get_the_post_thumbnail_url( $op_pl_lay_two_post->ID ) ); ?>">
									</a>
									<?php
								}
								?>
							</div>
							<div class="op-img-cat-wrap">
								<div class="op-cat-grid op-cat-classic op-cat-topLeft">
									<div class="op-cat-inner">
										<?php
										if ( is_array( $categories ) && ! empty( $categories ) ) {
											foreach ( $categories as $category ) {
												if ( $op_pl_lay_two_attributes['displayCategory'] ) {
													?>
													<a href="!#" class="op-cat-league ultp-cat-only-color-1" style="<?php echo esc_attr( safecss_filter_attr( "color:{$op_pl_lay_two_attributes['catColor']}; background-color:{$op_pl_lay_two_attributes['catBgColor']}; font-family:{$op_pl_lay_two_attributes['thirdFontFamily']}; font-weight:{$op_pl_lay_two_attributes['thirdFontWeight']}; line-height:{$op_pl_lay_two_attributes['thirdLineHeight']}{$op_pl_lay_two_attributes['thirdLineHeightType']} !important; font-size:{$op_pl_lay_two_attributes['thirdFontSize']}{$op_pl_lay_two_attributes['thirdFontSizeType']};" ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
													<?php
												}
											}
										}
										?>
									</div>
								</div>
							</div>
							<div class="op-post-content op-post-content-bottomPosition">
								<div class="op-post-content-inner">
									<?php
									if ( $op_pl_lay_two_attributes['displayPostTitle'] ) {
										$op_pl_lay_two_post_title       = $op_pl_lay_two_post->post_title;
										$op_pl_lay_two_post_title_value = mb_substr( $op_pl_lay_two_post_title, 0, $op_pl_lay_two_attributes['titleLength'] ) . '…';
										printf(
											'<%1$s class="op-post-title" ><a href="%2$s" style="%4$s">%3$s</a></%1$s>',
											esc_attr( $op_pl_lay_two_attributes['postTitle'] ),
											esc_url( get_the_permalink( $op_pl_lay_two_post ) ),
											! empty( $op_pl_lay_two_post_title_value ) ? esc_html( $op_pl_lay_two_post_title_value ) : esc_html__( 'No title', 'omnipress' ),
											esc_attr( safecss_filter_attr( "font-family:{$op_pl_lay_two_attributes['headFontFamily']}; font-weight:{$op_pl_lay_two_attributes['headFontWeight']}; line-height:{$op_pl_lay_two_attributes['headLineHeight']}{$op_pl_lay_two_attributes['headLineHeightType']}; font-size:{$op_pl_lay_two_attributes['headFontSize']}{$op_pl_lay_two_attributes['headFontSizeType']}; color:{$op_pl_lay_two_attributes['titleColor']};" ) )
										);
									}
									?>
									<div class="op-post-meta op-post-meta-dot op-post-meta-style3">
										<?php
										if ( $op_pl_lay_two_attributes['displayPostAuthor'] ) {
											$author_id                 = get_post_field( 'post_author', $op_pl_lay_two_post->ID );
											$op_pl_lay_two_post_author = get_the_author_meta( 'display_name', $author_id );
											?>
											<span class="op-post-meta-author">
												<a target="_blank" href="!#" style="<?php echo esc_attr( safecss_filter_attr( "color:{$op_pl_lay_two_attributes['metaColor']};" ) ); ?>"><?php echo esc_html( $op_pl_lay_two_post_author ); ?></a>
											</span>
											<?php
										}
										if ( $op_pl_lay_two_attributes['displayPostDate'] ) {
											?>
											<span class="op-post-meta-date" style="<?php echo esc_attr( safecss_filter_attr( "color:{$op_pl_lay_two_attributes['metaColor']};" ) ); ?>">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 19" style="<?php echo sprintf( 'fill: %s', esc_attr( sanitize_hex_color( $op_pl_lay_two_attributes['metaColor'] ) ) ); ?>">
													<path d="M4.60069444,4.09375 L3.25,4.09375 C2.47334957,4.09375 1.84375,4.72334957 1.84375,5.5 L1.84375,7.26736111 L16.15625,7.26736111 L16.15625,5.5 C16.15625,4.72334957 15.5266504,4.09375 14.75,4.09375 L13.3993056,4.09375 L13.3993056,4.55555556 C13.3993056,5.02154581 13.0215458,5.39930556 12.5555556,5.39930556 C12.0895653,5.39930556 11.7118056,5.02154581 11.7118056,4.55555556 L11.7118056,4.09375 L6.28819444,4.09375 L6.28819444,4.55555556 C6.28819444,5.02154581 5.9104347,5.39930556 5.44444444,5.39930556 C4.97845419,5.39930556 4.60069444,5.02154581 4.60069444,4.55555556 L4.60069444,4.09375 Z M6.28819444,2.40625 L11.7118056,2.40625 L11.7118056,1 C11.7118056,0.534009742 12.0895653,0.15625 12.5555556,0.15625 C13.0215458,0.15625 13.3993056,0.534009742 13.3993056,1 L13.3993056,2.40625 L14.75,2.40625 C16.4586309,2.40625 17.84375,3.79136906 17.84375,5.5 L17.84375,15.875 C17.84375,17.5836309 16.4586309,18.96875 14.75,18.96875 L3.25,18.96875 C1.54136906,18.96875 0.15625,17.5836309 0.15625,15.875 L0.15625,5.5 C0.15625,3.79136906 1.54136906,2.40625 3.25,2.40625 L4.60069444,2.40625 L4.60069444,1 C4.60069444,0.534009742 4.97845419,0.15625 5.44444444,0.15625 C5.9104347,0.15625 6.28819444,0.534009742 6.28819444,1 L6.28819444,2.40625 Z M1.84375,8.95486111 L1.84375,15.875 C1.84375,16.6516504 2.47334957,17.28125 3.25,17.28125 L14.75,17.28125 C15.5266504,17.28125 16.15625,16.6516504 16.15625,15.875 L16.15625,8.95486111 L1.84375,8.95486111 Z"></path>
												</svg>
												<?php echo esc_html( get_the_date( '', $post ) ); ?>
											</span>
											<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
