<?php
namespace Omnipress\Controllers;



class ThemeFontsHandler {

	final public function init( ) {
		add_filter( 'template_include', array( $this, 'handle_template_include' ) );
		add_filter( 'wp_theme_json_data_theme', array( $this, 'experimental_filter_theme_json_theme' ) );
	}


	/**
	 * Filters the theme.json data to add the Inter and Cardo fonts when they don't exist.
	 *
	 * @param WP_Theme_JSON $theme_json The theme json object.
	 */
	public function experimental_filter_theme_json_theme( $theme_json ) {
		if ( ! Features::is_enabled( 'launch-your-store' ) ) {
			return $theme_json;
		}

		$theme_data = $theme_json->get_data();
		$font_data  = $theme_data['settings']['typography']['fontFamilies']['theme'] ?? array();

		$fonts_to_add = array(
			array(
				'fontFamily' => '"Inter", sans-serif',
				'name'       => 'Inter',
				'slug'       => 'inter',
				'fontFace'   => array(
					array(
						'fontFamily'  => 'Inter',
						'fontStretch' => 'normal',
						'fontStyle'   => 'normal',
						'fontWeight'  => '300 900',
						'src'         => array( WC()->plugin_url() . '/assets/fonts/Inter-VariableFont_slnt,wght.woff2' ),
					),
				),
			),
			array(
				'fontFamily' => 'Cardo',
				'name'       => 'Cardo',
				'slug'       => 'cardo',
				'fontFace'   => array(
					array(
						'fontFamily' => 'Cardo',
						'fontStyle'  => 'normal',
						'fontWeight' => '400',
						'src'        => array( WC()->plugin_url() . '/assets/fonts/cardo_normal_400.woff2' ),
					),
				),
			),
		);

		// Loops through all existing fonts and append when the font's name is not found.
		foreach ( $fonts_to_add as $font_to_add ) {
			$found = false;
			foreach ( $font_data as $font ) {
				if ( $font['name'] === $font_to_add['name'] ) {
					$found = true;
					break;
				}
			}

			if ( ! $found ) {
				$font_data[] = $font_to_add;
			}
		}

		$new_data = array(
			'version'  => 1,
			'settings' => array(
				'typography' => array(
					'fontFamilies' => array(
						'theme' => $font_data,
					),
				),
			),
		);
		$theme_json->update_with( $new_data );
		return $theme_json;
	}
}
