<?php
/**
 * Single Product content block template.
 */
?>

<<?php echo esc_attr( $headingType ); ?> class='op-block__<?php echo esc_attr( $slug ); ?>--<?php echo esc_attr( $blockId ); ?> op-block__has-link op-<?php echo esc_attr( $blockId ); ?>'>
	<?php echo $content; ?>
	<span class='op-block__product-content'><?php echo esc_html( $innerText ) ?? ''; ?></span>
	<a class="op-link" aria-label="<?php echo esc_attr( $ariaLabel ); ?>" rel="<?php echo esc_attr( $rel ?? 'no-referer' ); ?>"  target="<?php echo esc_attr( $target ); ?>"  href="<?php echo esc_attr( $link ?? '#' ); ?>" ></a>
</<?php echo esc_attr( $headingType ); ?>>
