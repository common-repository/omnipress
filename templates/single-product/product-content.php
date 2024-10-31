<?php
/**
 * Single Product content block template.
 */
?>
<<?php echo esc_attr( $headingType ); ?> class='op-block__<?php echo esc_attr( $slug ); ?>--<?php echo esc_attr( $blockId ); ?> op-<?php echo esc_attr( $blockId ); ?>'>
	<?php echo $content; ?>
	<span class='op-block__text'><?php echo $innerText; ?></span>
</<?php echo esc_attr( $headingType ); ?>>
