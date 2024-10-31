<?php

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;

class Image extends AbstractBlock {
	public function render( $attributes, $content, $block ) {

		if ( isset( $attributes['href'] ) ) {
			$content = sprintf(
				'<a href="%s" target="%s" class="%s" rel="%s">%s</a>',
				$attributes['href'],
				$attributes['target'],
				$attributes['linkClass'] ?? '',
				$attributes['target'] ? 'noopener noreferrer' : '',
				$content
			);
		}

		$p = new \WP_HTML_Tag_Processor( $content );

		if ( $p->next_tag( 'img' ) ) {
			$alt = $p->get_attribute( 'alt' );
			$src = $p->get_attribute( 'src' );
			$p->set_attribute( 'decoding', 'async' );
			$p->set_attribute( 'srcset', wp_get_attachment_image_srcset( $attributes['id'] ) );
			$size = $p->get_attribute( 'data-size' );
			$p->set_attribute( 'sizes', wp_get_attachment_image_sizes( $attributes['id'], $size ) );

			if ( isset( $attributes['id'] ) ) {
				$src          = wp_get_attachment_url( $attributes['id'] );
				$metadata     = wp_get_attachment_metadata( $attributes['id'] );
				$image_width  = $metadata['width'] ?? 'none';
				$image_height = $metadata['height'] ?? 'none';
			}

			if ( $attributes['enabledLightbox'] ) {
				$p->set_attribute(
					'data-wp-context',
					wp_json_encode(
						array(
							'alt'         => $alt,
							'src'         => $src,
							'imageHeight' => $image_height,
							'imageWidth'  => $image_width,
						)
					)
				);

				$p->set_attribute( 'data-wp-on-async--click', 'actions.showLightbox' );
				$p->set_attribute( 'data-wp-init', 'callbacks.setImageStyles' );
			}
		}

		if ( ! $attributes['enabledLightbox'] ) {
			return $p->get_updated_html();
		}

		if ( false === stripos( $content, '<img' ) ) {
			return '';
		}

		if ( $p->next_tag( 'figure' ) ) {
			$p->set_bookmark( 'figure' );
		}

		// seek figure.
		$p->seek( 'figure' );
		$p->set_attribute( 'data-wp-interactive', 'omnipress/image' );

		$updated_content = $p->get_updated_html();

		$content = $updated_content;

		wp_register_script_module(
			'~omnipress/block-interactivity/image',
			OMNIPRESS_URL . 'assets/block-interactivity/image-view.js',
			array( '@wordpress/interactivity' ),
			OMNIPRESS_VERSION
		);

		wp_enqueue_script_module( '~omnipress/block-interactivity/image' );

		add_action( 'wp_footer', array( $this, 'render_lightbox_container' ) );

		return $content;
	}

	public function render_lightbox_container() {
		?>
			<div data-wp-interactive="omnipress/image" data-wp-on--click="actions.hideLightbox" data-wp-bind--style="state.currentImage.style" data-wp-context="{}" id="op-lightbox"><button data-wp-on--click="actions.hideLightbox"  type="button" aria-label="Close" style="fill: var(--wp--preset--color--contrast)" class="close-button">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false"><path d="M13 11.8l6.1-6.3-1-1-6.1 6.2-6.1-6.2-1 1 6.1 6.3-6.5 6.7 1 1 6.5-6.6 6.5 6.6 1-1z"></path></svg>
				</button><img data-wp-bind--src="state.currentImage.src"  data-wp-bind--alt=state.currentImage.alt"/></div>
		<?php
	}
}
