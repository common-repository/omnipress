<?php

namespace Omnipress\Models;

use Omnipress\Abstracts\ModelsBase;

/**
 * WPForms Modal model class.
 */
class WpFormsModal extends ModelsBase {
	const WP_FORM_CACHE          = 'OP_WP_FORMS';
	const WP_FORM_CACHE_DURATION = MINUTE_IN_SECONDS * 3;

	/**
	 * Retrieve all available WPForms.
	 *
	 * @return int[]|WP_Post[]
	 */
	public static function get_all_wpforms_fields(): array {
		$posts = get_transient( self::WP_FORM_CACHE );

		if ( false === $posts ) {
			$posts = get_posts(
				array(
					'numberposts' => -1,
					'post_type'   => 'wpcf7_contact_form',
				)
			);

			set_transient( self::WP_FORM_CACHE, $posts, self::WP_FORM_CACHE_DURATION );
		}
		return $posts;
	}

	/**
	 * Retrieves the HTML markup of a Contact Form 7 form based on the provided form ID.
	 *
	 * @param array $request The request data containing the form ID.
	 *                      The 'form_id' key should be present in the array.
	 * @return array|WP_Error The array containing the form ID and the form HTML markup,
	 *                        or a WP_Error object if the form ID is invalid or the form is not found.
	 */
	function get_contact_form_7_html( $request ) {
		$form_id = intval( $request['form_id'] );

		if ( ! class_exists( 'WPCF7_ContactForm' ) ) {
			require WP_PLUGIN_DIR . '/contact-form-7/includes/WPCF7_ContactForm.php';
		}

		$contact_form = \WPCF7_ContactForm::get_instance( $form_id );

		if ( ! $contact_form ) {
			return new \WP_Error( 'invalid_form_id', 'Form not found', array( 'status' => 404 ) );
		}

		ob_start();
		echo do_shortcode( $contact_form->shortcode() );
		$form_html = ob_get_clean();

		// Return the form HTML markup as a response.
		return array(
			'form_id'   => $form_id,
			'form_html' => $form_html,
		);
	}

	/**
	 * Retrieves all WPForms posts by the given form ID.
	 *
	 * @param int $form_id The ID of the form to retrieve posts for.
	 * @return WP_Post[] An array of WP_Post objects representing the WPForms posts.
	 */
	public function get_by_form_id( $form_id ) {
		$forms = get_transient( self::WP_FORM_CACHE );

		if ( false === $forms ) {
			$forms = get_posts(
				array(
					'numberposts' => -1,
					'post_type'   => 'wpforms',
					'include'     => $form_id,
				)
			);
		}

		return $forms;
	}
}
