<?php

namespace Omnipress\Abstracts;

use Omnipress\BlockTemplates;

defined( 'ABSPATH' ) || exit;

/**
 * Register Menu and Templates Page.
 *
 * @since 1.2.0
 */
abstract class BlockTemplateBase {
	/**
	 * Init All Templates and blocks menu.
	 *
	 * @return void
	 */
	public static function init() {
		$menu_tempalates = new BlockTemplates( 'Menu', 'Menu Templates', 'menu-templates' );
	}
}
