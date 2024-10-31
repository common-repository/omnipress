<?php

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;

( defined( 'ABSPATH' ) ) || exit;

/**
 * Megamenu class.
 */
class Megamenu extends AbstractBlock {

	private $default_attrs = array(
		// main menu advanced setting.
		'menu'              => array(),

		// list.
		'menuList'          => array(),
		'menuGap'           => array(),

		'menus'             => array(
			array(
				'id'    => '1',
				'title' => 'Example Menu 1',
				'url'   => '#',
				'image' => '',
			),
		),

		// menu button.
		'menuButtonContent' => 'All',
		'menuDirection'     => 'vertical',
		'menuButton'        => array(),
		'menuButtonGap'     => array(),


		// submenu dropdown.
		'dropdown'          => array(),
		'menuListImage'     => array(),
		'menuWrapper'       => array(),

		// other attributes.
		'css'               => '',
		'ischildOutside'    => false,
		'icon'              => false,
		'menuToggleType'    => 'click',
		'blockId'           => '',
		'activeIcon'        => '',
		'closeIcon'         => '',
		'iconPosition'      => 'left',
		'menuOpenState'     => false,
		'buttonContent'     => 'All',
		'lists'             => array(),
	);
		// ============
		// Structure of menu attribute
		/* phpcs:ignore
			Example: array(
				'id'       => '4',
				'title'    => 'Example Menu With Dropdown',
				'url'      => '#',
				'image'    => '',
				'children' => array(
					array(
						'id'    => '5',
						'title' => 'Example Submenu 1',
						'url'   => '#',
					),
					array(
						'id'       => '6',
						'title'    => 'Example Submenu 2',
						'url'      => '#',
						'children' => array(
						array(
						'id'       => '7',
						'title'    => 'Example Nested Submenu',
						'url'      => '/',
						'template' => 123,
					),
				),
			),
		 */
		// ============

	private function render_menu_item( $menu ) {
		$title            = $menu['title'] ?? '';
		$url              = $menu['url'] ?? null;
		$children         = isset( $menu['children'] ) ? $menu['children'] : null;
		$template         = isset( $menu['template'] ) ? $menu['template'] : null;
		$image            = $menu['image'] ?? null;
		$template_content = '';

		if ( $template ) {
			$post = get_post( $template );

			if ( $post ) {
				$template_content = apply_filters( 'the_content', $post->post_content );
				$title            = $title ?? $post->post_title;
			}
		}

		echo '<li data-wp-on--mouseenter="actions.setWidth" class="op-block__megamenu-dropdown-list-item">';

		echo '<a href="' . esc_url( $url ) . '" id="op-block__megamenu-list--link" class="op-block__megamenu-dropdown-list-item--link ' . ( $template ? 'has-template has-dropdown' : '' ) . '">';

		if ( $image ) {
			echo '<img class="op-block__megamenu-dropdown-list-item--image" src="' . esc_url( $image ) . '" alt="' . esc_attr( $title ) . '" />';
		}

		echo esc_html( $title );

		if ( $children || $template ) {
			echo '<i class="fas fa-chevron-down"></i>';
		}

		echo '</a>';

		if ( ! empty( $children ) && ! $template ) {
			echo '<ul class="op-block__megamenu-submenu" aria-labelledby="op-block__dropdown-lists">';

			foreach ( $children as $child ) {
				$this->render_menu_item( $child );
			}

			echo '</ul>';
		}
		if ( $template ) {
			echo '<ul class="op-block__megamenu-submenu" aria-labelledby="op-block__dropdown-lists">' . $template_content . '</ul>';
		}

		echo '</li>';
	}

	public function get_attributes() {
		return array(
			'menus' => array(
				array(
					'id'    => '1',
					'title' => 'Example menu 1',
					'url'   => '/',
					'image' => '',
				),
				array(
					'id'       => '4',
					'title'    => 'Menu with dropdown',
					'url'      => '/about',
					'image'    => '',
					'children' => array(
						array(
							'id'    => '5',
							'title' => 'Example submenu',
							'url'   => '/submenus1',
						),
						array(
							'id'       => '6',
							'title'    => 'Example submenu 2',
							'url'      => '/submenus1',
							'children' => array(
								array(
									'id'       => '7',
									'title'    => 'Example nested submenu 2',
									'url'      => '/',
									'template' => 123,
								),
							),
						),
					),
				),
			),
		);
	}

	public function get_default_attributes() {
		return $this->default_attrs;
	}

	/**
	 * @inheritDoc
	 */
	public function render( $attributes, $content, $block ) {
		wp_register_script_module(
			'omnipress/block-library/query',
			OMNIPRESS_URL . 'assets/block-interactivity/menu-module.js',
			array(
				array(
					'id'     => '@wordpress/interactivity',
					'import' => 'static',
				),
				array(
					'id'     => '@wordpress/interactivity-router',
					'import' => 'dynamic',
				),
			),
			OMNIPRESS_VERSION
		);
		wp_enqueue_script_module( 'omnipress/block-library/query' );

		$classnames = 'op-block op-megamenu hide-on-mobile op-' . esc_attr( $attributes['blockId'] );

		$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => trim( $classnames ) ) );

		ob_start();
		$attributes                   = array_merge( $this->get_default_attributes(), $attributes );
		$block->parsed_block['attrs'] = $attributes;

		$menus = $attributes['menus'];

		echo '<div data-wp-interactive="omnipress/menu"' . $wrapper_attributes . '><nav class="op-block__megamenu ' . esc_attr( $attributes['menuDirection'] ) . '">';
		echo '    <div data-wp-on--click="actions.toggleMenu" class="op-block__megamenu--hamburger">';
		echo '        <i class="fas fa-bars"></i>';

		if ( 'vertical' === $attributes['menuDirection'] ) {
			echo '<span className="op-block__megamenu-label">' . esc_html( $attributes['menuButtonContent'] ) . '</span>';
		}

		echo '    </div>';
		echo '    <div id="op-block__megamenu-lists--wrapper" class="op-block__megamenu-lists--wrapper">';
		echo '        <ul class="op-block__megamenu-lists">';

		if ( is_array( $menus ) && ! empty( $menus ) ) {
			foreach ( $menus as $menu ) {
				$this->render_menu_item( $menu, $attributes );
			}
		}

		echo '        </ul>';
		echo '    </div>';
		echo '</nav></div>';

		return ob_get_clean();
	}
}
