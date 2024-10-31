<?php
/**
 * Class for handling blocks api.
 *
 * @package Omnipress
 */

namespace Omnipress;

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class for handling blocks api.
 *
 * @since 1.0.0
 */
class Blocks_API {
	/**
	 * Function to initialize the hook.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'rest_api_init', array( __CLASS__, 'register_rest_fields' ) );
	}

	/**
	 * Create API fields for additional info
	 */
	public static function register_rest_fields() {
		/* Add author info for post */
		register_rest_field(
			array( 'page', 'post', 'course', 'lesson' ),
			'author_info',
			array(
				'get_callback'    => array( __CLASS__, 'author_info' ),
				'update_callback' => null,
				'schema'          => null,
			)
		);
	}

	/**
	 * Get author info for the rest field
	 *
	 * @param String $object  The object type.
	 * @param String $field_name  Name of the field to retrieve.
	 * @param String $request  The current request object.
	 */
	public static function author_info( $object, $field_name, $request ) {
		/* Get the author name */

		$author = ( isset( $object['author'] ) ) ? $object['author'] : '';

		// Get the author name.
		$author_data['display_name'] = get_the_author_meta( 'display_name', $author );

		// Get the author link.
		$author_data['author_link'] = get_author_posts_url( $author );

		// Return the author data.
		return $author_data;
	}
}

Blocks_API::init();
