<?php

declare( strict_types=1 );

namespace Omnipress\Blocks;

/**
 * Woocommerce Product Title Block.
 */
abstract class ProductBlockAbstract {

	/**
	 * Render block's frontend content.
	 *
	 * @param array  $attributes Block Attributes.
	 * @param string $content    Block Content.
	 * @return string
	 */
	abstract public static function render_view( $attributes, $content );
}
