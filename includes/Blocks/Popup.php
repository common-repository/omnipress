<?php
namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;
use OMNIPRESS\FileSystemUtil;

defined( 'ABSPATH' ) || exit;

/**
 * Popup blocks main class.
 *
 * @author omnipressteam
 *
 * @since 1.4.3
 *
 * @copyright (c) 2024
 */
class Popup extends AbstractBlock {
	const POPUP_REPETITION_META_NAME  = 'op_popup_repetition';
	const POPUP_RENDER_STATE          = 'is_matched';
	private static $already_increment = false;

	/**
	 * Default attributes.
	 *
	 * @since 1.4.3
	 *
	 * @var array
	 */
	protected array $default_attributes = array(
		'instanceId'          => '',
		'blockId'             => '',
		'isDismissible'       => 'false',
		'popupType'           => 'floating_bar',
		'popupTrigger'        => 'pageLoad',
		'popupPosition'       => 'top-left',
		'modalPosition'       => 'center_center',
		'slidePosition'       => 'left',
		'displayAfterVisits'  => '1',
		'maxPopupRepetitions' => '1',
		'delayBeforePopup'    => array(
			'enable' => false,
			'delay'  => '3s',
		),
	);


	/**
	 * {@inheritDoc}
	 */
	public function render( $attributes, $content, $block ) {
		$attributes             = array_merge( $this->default_attributes, $attributes );
		$post_id                = (int) $attributes['instanceId'];
		$popup_max_repeat_count = (int) $attributes['maxPopupRepetitions'];
		$current_value          = (int) get_post_meta( $post_id, self::POPUP_REPETITION_META_NAME, true );
		$should_update_popup    = ! empty( $post_id ) && $current_value !== $popup_max_repeat_count;
		$block_id               = $attributes['blockId'];
		$popup_type             = $attributes['popupType'];
		$slide_position         = $attributes['slidePosition'];
		$modal_position         = $attributes['modalPosition'];
		$delay_before_popup     = $attributes['delayBeforePopup'];
		$is_dismissible         = $attributes['isDismissible'];
		$popup_trigger          = $attributes['popupTrigger'];
		$display_after_visits   = $attributes['displayAfterVisits'];
		$popup_position         = $attributes['popupPosition'];
		$close_button_delay     = $attributes['closeButtonDelay'];

		$meta_key = 'op_popup_show_after';

		if ( 0 !== $display_after_visits ) {
			$remaining_count = get_post_meta( $post_id, $meta_key, true );

			if ( empty( $remaining_count ) || ! is_array( $remaining_count ) ) {
				$remaining_count = array(
					'count' => 0,
					'total' => $display_after_visits,
				);

			}

			if ( $remaining_count['total'] !== $display_after_visits ) {
				$remaining_count['total'] = $display_after_visits;
			}

			update_post_meta( $post_id, $meta_key, $remaining_count );
		}

		if ( $should_update_popup ) {
			$updated = update_post_meta( $post_id, self::POPUP_REPETITION_META_NAME, $popup_max_repeat_count );

			if ( $updated ) {
				error_log( 'Post meta updated successfully for post ID ' . $post_id );
			} else {
				error_log( 'Failed to update post meta for post ID ' . $post_id );
			}
		}

		wp_register_script_module(
			'omnipress/block-library/popup',
			OMNIPRESS_URL . 'assets/block-interactivity/popup-module.js',
			array(
				array(
					'id'     => '@wordpress/interactivity',
					'import' => 'static',
				),
			),
			OMNIPRESS_VERSION
		);

		wp_enqueue_script_module( 'omnipress/block-library/popup' );

		$classes = array_merge(
			array( 'op-block__popup' ),
			! empty( $block_id ) ? array( "op-{$block_id}" ) : array(),
			! empty( $popup_type ) ? array( "op-popup-{$popup_type}" ) : array(),
			'slide_in' === $popup_type ? array( "slide-{$slide_position}" ) : array(),
			'modal' === $popup_type ? array( "modal-{$modal_position}" ) : array()
		);

		$class_string     = implode( ' ', $classes );
		$transform_styles = '';

		switch ( $slide_position ) {
			case 'top':
				$transform_styles = 'transform:translateY(-100%);';
				break;

			case 'right':
				$transform_styles = 'transform:translateX(100%);';
				break;

			case 'bottom':
				$transform_styles = 'transform:translateY(100%);';
				break;

			default:
				$transform_styles = 'transform:translateX(-100%);';
				break;

		}

		$styles_string = 'max-height:0; opacity:0;z-index:-1;' . $transform_styles;

		$settings = array(
			'popup_triggered'      => $popup_trigger,
			'time_delay'           => $delay_before_popup,
			'popup_position'       => $popup_position,
			'popup_repetition'     => $popup_max_repeat_count,
			'instanceId'           => $attributes['instanceId'],
			'is_dismissible'       => $is_dismissible,
			'popup_type'           => $popup_type,
			'display_after_visits' => $display_after_visits,
			'slide_position'       => $slide_position,
			'modal_position'       => $modal_position,
			'style'                => $styles_string,
		);

		$close_button = '<button style="padding:8px;background:#fff" data-wp-html="context.button_text" data-wp-on--click="actions.closePopup" class="op-popup__close-btn">X</button>';

		if ( 0 !== $close_button_delay ) {
			$settings['close_button_delay'] = $close_button_delay;
			$settings['button_style']       = 'pointer-events:none; padding:8px;background:#fff';
			$close_button                   = '<button data-wp-text="context.close_button_delay" data-wp-bind--style="context.button_style"  data-wp-on--click="actions.closePopup" class="op-popup__close-btn"></button>';
		}

		if ( $attributes['autoCloseEnabled'] ) {
			$settings['auto_close_delay'] = $attributes['autoCloseDelay'];
		}

		$wrapper_custom_attrs = array(
			'class'               => $class_string,
			'data-wp-bind--style' => 'context.style',
		);

		if ( 'modal' === $attributes['popupType'] ) {
			$wrapper_custom_attrs['data-wp-on--click'] = 'actions.closeModal';
		}

		$wrapper_attributes = get_block_wrapper_attributes( $wrapper_custom_attrs );

		$block_styles = '';

		if ( file_exists( OMNIPRESS_PATH . 'assets/build/css/blocks/popup-' . $attributes['popupType'] . '.min.css' ) ) {
			$block_styles = FileSystemUtil::read_file( OMNIPRESS_PATH . 'assets/build/css/blocks/popup-' . $attributes['popupType'] . '.min.css' );
		}

		$block_styles = ! empty( $block_styles ) ? '<style>' . $block_styles . '</style>' : '';

		return sprintf(
			'<div data-wp-interactive="omnipress/popup" %s><div  data-wp-on-window--load="callbacks.openPopup" data-wp-init="callbacks.onTriggeredPopup" %s ><div class="op-popup-builder__wrapper"> %s %s %s </div></div></div>',
			wp_interactivity_data_wp_context( $settings, 'omnipress/popup' ),
			$wrapper_attributes,
			$content,
			$attributes['isDismissible'] ? $close_button : '',
			$block_styles
		);
	}
}
