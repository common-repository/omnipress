<?php

namespace Omnipress\Controllers;

use Omnipress\Models\BlocksSettingsModel;

class SettingsController {
	public $instance = null;
	private $block_setting_model;

	public function __construct( BlocksSettingsModel $block_setting_model ) {
		$this->block_setting_model = $block_setting_model;
	}

	public function render_view() {
		include_once OP_ADMIN_PATH . 'views/admin-base.php';
	}

	/**
	 * @return $this|void
	 */
	public function register_menu_page() {
		$existing_menus = $this->block_setting_model->get_all_menu_pages();

		if ( empty( $existing_menus ) ) {
			return;
		}

		foreach ( $existing_menus as $menu_page ) {
			add_menu_page(
				$menu_page['page_title'],
				$menu_page['page_title'],
				$menu_page['capability'],
				$menu_page['page_slug'],
				$menu_page['callback'],
				$menu_page['icon'],
				$menu_page['position'] ?? 10
			);
		}

		return $this;
	}
	public function register_submenu_page() {
		$existing_sub_menus = $this->block_setting_model->get_all_sub_menus();

		if ( empty( $existing_sub_menus ) ) {
			return;
		}

		foreach ( $existing_sub_menus as $sub_menu ) {
				add_submenu_page(
					$sub_menu['parent_slug'],
					$sub_menu['page_title'],
					$sub_menu['menu_title'],
					$sub_menu['capability'],
					$sub_menu['menu_slug'],
					$sub_menu['callback'] ?? array( $this, 'render_view' )
				);
		}
	}
}
