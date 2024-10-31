<?php

namespace Omnipress;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'OMNIPRESS\BlockSettings' ) ) {
	// TODO: block's links settings attributes are : blockLink, link_target, link_rel, blockHasLightbox
	// TODO: style generator function.

	/**
	 * Class BlockSettings to handle all common blocks settings related blocks.
	 *
	 * @package    WordPress
	 * @subpackage Blocks
	 */
	class BlockSettings {
		public function __construct() {
			add_filter( 'render_block', array( $this, 'generate_styles' ), 10, 2 );
			add_action( 'wp_footer', array( $this, 'get_all_blocks_generated_css' ) );
		}

		public function get_all_blocks_generated_css() {
			$generated_css = apply_filters( 'omnipress_generate_css', '' );
			echo "<style class='omnipress-blocks-generated'>$generated_css</style>";
		}
		/**
		 * Retrieve block's default attributes.
		 *
		 * @since 1.0.0
		 *
		 * @param string $block_name Block name.
		 * @return array|null
		 */
		public function get_block_type_attributes( $block_name ) {
			$block_class_instance = BlocksAssetsHelper::get_block_class_instance_by_name( $block_name );

			if ( $block_class_instance && method_exists( $block_class_instance, 'get_attributes' ) ) {
				return $block_class_instance->get_attributes();
			}

			return array();
		}

		public function generate_styles( $content, $block ) {
			$block = apply_filters( 'omnipress_render_block_' . $block['blockName'], $block );
			// Early exit if no block or no opSettings.
			if ( ! $block ) {
				return $content;
			}

			$op_settings = $block['opSettings'] ?? false;
			$attributes  = $block['attrs'] ?? false;
			$block_id    = $attributes['blockId'] ?? '';

			// Default attributes.
			$default_attributes = $this->get_block_type_attributes( $block['blockName'] );
			$attributes         = array_merge(
				$default_attributes,
				$attributes
			);

			if ( ! $op_settings ) {
				return $content;
			}

			$unique_block_selector = 'omnipress/button' === $block['blockName'] ? '[class*=wp-block-omnipress].op-' . $block_id . '.op-block__button ' : '[class*=wp-block-omnipress].op-' . $block_id . ' ';

			$op_settings['wrapper'] = array( 'selector' => '' );

			$css = '';

			if ( $op_settings && $attributes ) {
				foreach ( $op_settings as $key => $value ) {
					if ( isset( $value['selector'] ) ) {
						$selector     = $unique_block_selector . $value['selector'];
						$current_attr = $attributes[ $key ] ?? false;

						if ( ! $current_attr ) {
							continue;
						}
						$css .= $this->convertStyleAttributesToCss( $attributes[ $key ], $selector );
					}
				}
			}

			// combined all generated css.
			add_filter(
				'omnipress_generate_css',
				function ( $prev_css ) use ( $css ) {
					return $prev_css . $css;
				},
				12
			);

			return $content;
		}


		public function changeAttributesKeyIntoValidCssKey( $str ) {
			$str = lcfirst( $str );
			return strtolower( preg_replace( '/([A-Z])/', '-$1', $str ) );
		}

		public function uglifyCSS( $css_code ) {
			if ( ! $css_code ) {
				return '';
			}
			$css_code = preg_replace( '/\s+/', ' ', $css_code );
			$css_code = preg_replace( '/\/\*[\s\S]*?\*\//', '', $css_code );
			$css_code = preg_replace( '/ ?([:;,{}]) ?/', '$1', $css_code );

			return $css_code ? $css_code : '';
		}

		public function convertCss( $value, $css_prop, $device, &$normal_css, &$md_css, &$sm_css, &$hover, &$active ) {
			if ( $css_prop === 'transform' ) {
				$rotate    = $value['rotate'] ?? null;
				$scale     = $value['scale'] ?? null;
				$skew      = $value['skew'] ?? null;
				$translate = $value['translate'] ?? array(
					'x' => null,
					'y' => null,
				);
				$transform = array();

				if ( $scale ) {
					$transform[] = 'scale(' . intval( $scale ) . ')';
				}

				if ( $skew ) {
					$transform[] = 'skew(' . intval( $skew ) . 'deg)';
				}

				if ( $rotate ) {
					$transform[] = 'rotate(' . intval( $rotate ) . 'deg)';
				}

				if ( $translate['x'] ?? $translate['y'] ?? false ) {
					$transform[] = 'translate(' . ( isset( $translate['x'] ) ? "{$translate['x']}px," : '0,' ) . ( isset( $translate['y'] ) ? "{$translate['y']}px" : '0' ) . ')';
				}

				$transform_string = 'transform:' . implode( ' ', $transform ) . ';';
				$this->addResponsiveStyles( $device, $transform_string, $normal_css, $md_css, $sm_css );
			} elseif ( 'text-shadow' === $css_prop ) {
				if ( ! $value['color'] ) {
					return;
				}

				$shadow = "{$css_prop}:" . ( $value['x'] ?? 0 ) . 'px ' . ( $value['y'] ?? 0 ) . 'px ' . ( $value['blur'] ?? 0 ) . "px {$value['color']};";
				if ( $device === 'lg' ) {
					$normal_css .= $shadow;
				} elseif ( $device === 'md' ) {
					$md_css .= $shadow;
				} else {
					$sm_css .= $shadow;
				}
			} elseif ( strpos( $css_prop, 'hover' ) !== false ) {
				if ( ! $value ) {
					return;
				}
				$hover .= str_replace( 'hover', '', $css_prop ) . ":{$value};";
			} elseif ( strpos( $css_prop, 'active' ) !== false ) {
				if ( ! $value ) {
					return;
				}
				$active .= str_replace( 'active', '', $css_prop ) . ":{$value};";
			} elseif ( ! is_array( $value ) ) {
				if ( $value ) {
					$this->addResponsiveStyles( $device, "{$css_prop}:{$value};", $normal_css, $md_css, $sm_css );
				}
			} else {
				foreach ( $value as $el => $val ) {
					if ( ! $el || ! $val ) {
						continue;
					}
					$css_property = $this->changeAttributesKeyIntoValidCssKey( $el );
					$this->convertCss( $val, "{$css_prop}-{$css_property}", $device, $normal_css, $md_css, $sm_css, $hover, $active );
				}
			}
		}

		function addResponsiveStyles( $device, $generated_styles, &$normal_css, &$md_css, &$sm_css ) {
			switch ( $device ) {
				case 'md':
					$md_css .= "{$generated_styles}";
					break;
				case 'sm':
					$sm_css .= "{$generated_styles}";
					break;
				default:
					$normal_css .= "{$generated_styles}";
			}
		}

		public function convertStyleAttributesToCss( $style_attributes, $cssSelector ) {
			if ( ! $style_attributes ) {
				return '';
			}

			$array_of_styles_key = array_keys( $style_attributes );
			$normal_css          = '';
			$md_css              = '';
			$sm_css              = '';
			$css                 = '';
			$hover               = '';
			$active              = '';

			foreach ( $array_of_styles_key as $key ) {
				if ( ! $key || ! $style_attributes[ $key ] ) {
					continue;
				}

				if ( $key === 'fontFamily' ) {
					// Assuming customFonts is a function that loads Google Fonts.
					continue;
				}

				if ( strpos( $key, 'md' ) !== false ) {
					if ( ! $style_attributes[ $key ] ) {
						continue;
					}
					$css_property = str_replace( 'md', '', $key );
					$css_property = $this->changeAttributesKeyIntoValidCssKey( $css_property );
					$this->convertCss( $style_attributes[ $key ], $css_property, 'md', $normal_css, $md_css, $sm_css, $hover, $active );
				} elseif ( strpos( $key, 'sm' ) !== false ) {
					if ( ! $style_attributes[ $key ] ) {
						continue;
					}
					$css_property = str_replace( 'sm', '', $key );
					$css_property = $this->changeAttributesKeyIntoValidCssKey( $css_property );
					$this->convertCss( $style_attributes[ $key ], $css_property, 'sm', $normal_css, $md_css, $sm_css, $hover, $active );
				} else {
					if ( ! $style_attributes[ $key ] ) {
						continue;
					}
					$css_property = $this->changeAttributesKeyIntoValidCssKey( $key );
					$this->convertCss( $style_attributes[ $key ], $css_property, 'lg', $normal_css, $md_css, $sm_css, $hover, $active );
				}
			}

			if ( $normal_css ) {
				$css .= "{$cssSelector} { {$normal_css} }";
			}
			if ( $hover ) {
				$css .= "{$cssSelector}:hover { {$hover} }";
			}
			if ( $active ) {
				$css .= "{$cssSelector}:active { {$active} }";
			}
			if ( $md_css ) {
				$css .= " @media screen and (max-width: 1024px) { {$cssSelector} { {$md_css} } }";
			}
			if ( $sm_css ) {
				$css .= " @media screen and (max-width: 767px) { {$cssSelector} { {$sm_css} } }";
			}

			return $this->uglifyCSS( $css ) ?: '';
		}
	}
}
