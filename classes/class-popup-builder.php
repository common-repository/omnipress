<?php

namespace Omnipress;

use Omnipress\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class PopupBuilder
 *
 * Manages the popup builder functionality within the Omnipress plugin.
 *
 * @package Omnipress
 * @since 1.4.3
 */
class PopupBuilder {
	use Singleton;

	const POPUP_REPETITION_META_NAME = 'op_popup_repetition';

	const POPUP_COOKIE_PREFIX = 'omnipress_popup_display_count_';

	/**
	 * Default Popup block's attributes.
	 *
	 * @var array
	 */
	protected array $default_attributes = array(
		'delayBeforePopup'    => array(
			'enable' => false,
			'delay'  => '3s',
		),
		'popupType'           => 'floating_bar',
		'popupTrigger'        => 'pageLoad',
		'popupPosition'       => 'top-left',
		'maxPopupRepetitions' => '1',
	);

	/**
	 * Types of popups supported by the builder.
	 *
	 * @var array|null $popup_types
	 * @since 1.4.3
	 */
	protected $popup_types;

	/**
	 * Options for triggering the popup display.
	 *
	 * @var array|null $triggered_options
	 * @since 1.4.3
	 */
	protected $triggered_options;

	/**
	 * ID of the current popup.
	 *
	 * @var int|null $popup_id
	 * @since 1.4.3
	 */
	protected $popup_id;

	/**
	 * Title of the popup.
	 *
	 * @var string|null $popup_title
	 * @since 1.4.3
	 */
	protected $popup_title;

	/**
	 * Content of the popup.
	 *
	 * @var string|null $popup_content
	 * @since 1.4.3
	 */
	protected $popup_content;

	/**
	 * Settings for the popup.
	 *
	 * @var array|null $popup_settings
	 * @since 1.4.3
	 */
	protected $popup_settings;

	/**
	 * Conditions for displaying the popup.
	 *
	 * @var array|null $popup_conditions
	 * @since 1.4.3
	 */
	protected $popup_conditions;

	/**
	 * Available templates for popups.
	 *
	 * @var array|null $popup_templates
	 * @since 1.4.3
	 */
	protected $popup_templates;

	/**
	 * Constructor for the PopupBuilder class.
	 *
	 * Initializes the popup types, triggering options, and hooks into WordPress actions.
	 *
	 * @since 1.4.3
	 * @return void
	 */

	protected $is_already_increment;

	public function __construct() {
		$this->popup_types = array(
			'floating',
			'modal',
			'slide_in',
		);

		$this->triggered_options = array(
			'exit_intent',
			'time_delay',
			'scroll_depth',
			'on_click',
			'on_scroll',
		);

		add_action( 'init', array( $this, 'register_popup_builder' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_scripts' ) );

		// Render Popup on frontend.
		add_action( 'wp_body_open', array( $this, 'display_popup_triggers' ) );

		// The 'manage_omnipress-popup_posts_columns' filter is used to add the column,.
		add_filter( 'manage_omnipress-popup_posts_columns', array( $this, 'add_popup_toggle_column' ) );
		// The 'manage_omnipress-popup_posts_custom_column' action is used to render the column content.
		add_action( 'manage_omnipress-popup_posts_custom_column', array( $this, 'render_status_toggle_column' ), 10, 2 );

		add_action( 'admin_enqueue_scripts', array( $this, 'popup_admin_scripts' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_editor_assets' ) );

		// ajax handler.
		add_action( 'wp_ajax_op_popup_status_updater', array( $this, 'toggle_popup_status' ) );
		add_action( 'wp_trash_post', array( $this, 'remove_popup_related_data' ) );
	}

	public function enqueue_block_editor_assets() {
		global $post;

		if ( isset( $post->post_type ) && 'omnipress-popup' === $post->post_type ) {

			$block_assets = include_once OMNIPRESS_PATH . 'assets/build/js/blocks/popup.asset.php';
			wp_enqueue_script( 'omnipress_popup_block', OMNIPRESS_URL . 'assets/build/js/blocks/popup.js', $block_assets['dependencies'], $block_assets['version'], true );
		}
	}


	/**
	 * Render popup enable disabled toggler button.
	 *
	 * @param mixed $column column.
	 * @param int   $post_id post id.
	 *
	 * @since 1.4.3
	 *
	 * @return void
	 */
	public function render_status_toggle_column( $column, $post_id ) {
		if ( 'op_status_toggle' === $column ) {
			$current_value = get_post_meta( $post_id, 'opp_is_enabled', true );

			$is_enabled_popup = 'false' !== $current_value;

			$toggle_text = $is_enabled_popup ? __( 'Enabled', 'textdomain' ) : __( 'Disabled', 'textdomain' );

			printf(
				'<button class="op-popup__switcher %s  op-py-2 op-px-5 op-rounded-sm op-cursor-pointer" data-enabled="%s" data-post-id="%s">%s</button>',
				$is_enabled_popup ? 'active op-bg-primary op-text-white' : ' ',
				esc_attr( $is_enabled_popup ),
				esc_attr( $post_id ),
				esc_html( $toggle_text )
			);
		}
	}

	/**
	 * Count how many times user visit on current page memorize user how many times user visit.
	 *
	 * @return void
	 */
	public function count_user_visit() {
		$page_slug   = get_post_field( 'post_name', get_post() ); // Gets the current page slug.
		$cookie_name = 'user_visit_count_' . $page_slug;

		// Check if the cookie exists.
		if ( isset( $_COOKIE[ $cookie_name ] ) ) {
			// Increment the visit count.
			$visit_count = intval( $_COOKIE[ $cookie_name ] );
			++$visit_count;
		} else {
			// If the cookie doesn't exist, start with 1 visit.
			$visit_count = 1;
		}

		// Set the cookie with the updated visit count. The cookie lasts for 30 days.
		setcookie( $cookie_name, $visit_count, time() + ( 30 * DAY_IN_SECONDS ), COOKIEPATH, COOKIE_DOMAIN );

		// Optionally, you can store this data in the user meta if the user is logged in.
		if ( is_user_logged_in() ) {
			$user_id = get_current_user_id();
			update_user_meta( $user_id, $cookie_name, $visit_count );
		}
		$page_slug   = get_post_field( 'post_name', get_post() );
		$cookie_name = 'user_visit_count_' . $page_slug;

		// Retrieve the visit count from the cookie.
		if ( isset( $_COOKIE[ $cookie_name ] ) ) {
			$visit_count = intval( $_COOKIE[ $cookie_name ] );
			echo 'You have visited this page ' . esc_html( $visit_count ) . ' times.';
		} else {
			echo 'This is your first visit to this page.';
		}
	}

	/**
	 * Add the toggle button to the custom column. This button will change the status of the post when clicked.
	 *
	 * @param mixed $columns already registered columns.
	 *
	 * @since 1.4.3
	 *
	 * @return mixed
	 */
	public function add_popup_toggle_column( $columns ) {
		$columns['op_status_toggle'] = __( 'Enable/Disable', 'omnipress' );
		return $columns;
	}

	/**
	 * Renders the content for the custom admin menu page.
	 *
	 * @since 1.4.3
	 * @return void
	 */
	public function render_admin_page() {
		echo '<div class="wrap">';
		echo '<h1>' . esc_html__( 'Popup Management', 'omnipress' ) . '</h1>';
		echo '<p>' . esc_html__( 'Manage your popups here.', 'omnipress' ) . '</p>';
		echo '</div>';
	}

	/**
	 * Registers the custom post type for the popup builder.
	 *
	 * Defines the labels, supported features, and settings for the 'omnipress-popup' custom post type.
	 *
	 * @since 1.4.3
	 * @return void
	 */
	public function register_popup_builder() {
		$supports = array(
			'title',
			'editor',
			'custom-fields',
			'author',
		);

		$labels = array(
			'name'               => _x( 'Popups', 'plural', 'omnipress' ),
			'singular_name'      => _x( 'Popup', 'singular', 'omnipress' ),
			'view_item'          => __( 'View Popup', 'omnipress' ),
			'add_new'            => __( 'Add New Popup', 'omnipress' ),
			'add_new_item'       => __( 'Add New Popup', 'omnipress' ),
			'edit_item'          => __( 'Edit Popup', 'omnipress' ),
			'new_item'           => __( 'New Popup', 'omnipress' ),
			'search_items'       => __( 'Search Popups', 'omnipress' ),
			'not_found'          => __( 'No Popups Found', 'omnipress' ),
			'not_found_in_trash' => __( 'No Popups in Trash', 'omnipress' ),
			'all_items'          => __( 'All Popups', 'omnipress' ),
			'item_published'     => __( 'Popup Published', 'omnipress' ),
			'item_updated'       => __( 'Popup Updated', 'omnipress' ),
		);

		$args = array(
			'supports'          => $supports,
			'labels'            => $labels,
			'public'            => false,
			'show_ui'           => true,
			'show_in_menu'      => 'omnipress-templates', // Show under custom admin menu.
			'show_in_admin_bar' => true,
			'show_in_rest'      => true,
			'template'          => array(
				array( 'omnipress/popup', array() ),
			),
			'rewrite'           => array(
				'slug'       => 'omnipress-popup',
				'with-front' => false,
				'pages'      => false,
			),
		);

		register_post_type( 'omnipress-popup', $args );

		do_action( 'init_omnipress_popup' );
	}

	/**
	 * Loads and registers predefined templates for popups.
	 *
	 * @since 1.4.3
	 * @return void
	 */
	public function load_popup_templates() {
		$this->popup_templates = array(
			'template_1' => __( 'Template 1', 'omnipress' ),
			'template_2' => __( 'Template 2', 'omnipress' ),
		);
	}

	/**
	 * Enqueues the necessary scripts and styles for displaying popups on the frontend.
	 *
	 * @since 1.4.3
	 * @return void
	 */
	public function enqueue_frontend_scripts() {
		\wp_register_script_module(
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
	}

	/**
	 * Displays popups on the frontend based on configured triggers and conditions.
	 *
	 * This function checks all available popups, verifies their display limits using cookies,
	 * and outputs the popup content if conditions are met.
	 *
	 * @since 1.4.3
	 * @return void
	 */
	public function display_popup_triggers() {

		// Retrieve all published popups.
		$popups = $this->get_all_popups();
		$count  = 0;

		++$count;

		foreach ( $popups as $popup ) {

			$popup_id         = $popup->ID;
			$popup_status     = get_post_meta( $popup_id, 'opp_is_enabled', true );
			$is_popup_enabled = 'false' !== $popup_status;

			if ( ! $is_popup_enabled ) {
				return;
			}

			// Get the maximum number of times this popup should be shown.
			$popup_display_limit = (int) get_post_meta( $popup_id, self::POPUP_REPETITION_META_NAME, true );

			// Define the cookie name used to track the number of times this popup has been displayed.
			$cookie_name   = self::POPUP_COOKIE_PREFIX . "$popup_id";
			$display_count = isset( $_COOKIE[ $cookie_name ] ) ? intval( $_COOKIE[ $cookie_name ] ) : 0;

			// Skip displaying the popup if it has reached or exceeded the display limit.
			if ( $display_count >= $popup_display_limit && -1 !== $popup_display_limit ) {
				continue;
			}

			// Apply content filters and output the popup content.
			$popup_content = apply_filters( 'the_content', $popup->post_content );
			$meta_key      = 'op_popup_show_after';

			// Display the popup only after the number of visits has exceeded the specified threshold.
			$remaining_count = get_post_meta( $popup_id, $meta_key, true );
			if ( ! empty( $remaining_count ) && $remaining_count['count'] <= $remaining_count['total'] ) {

				// Check if the transient 'op_popup_render_count' is not set (expired or does not exist).
				// If it's not set, increment the popup render count, update the post meta with the new count,
				// and set the transient to prevent multiple increments within a 3-second window.
				if ( false === get_transient( 'op_popup_render_count' ) ) {
					++$remaining_count['count'];
					update_post_meta( $popup_id, $meta_key, $remaining_count );
					set_transient( 'op_popup_render_count', true, 3 );
				}

				return;
			}

			// remove extra empty p tag.
			$popup_content = preg_replace( '/<p>\s*<\/p>/', '', $popup_content );
			$popup_content = trim( $popup_content );

			if ( ! empty( $popup_content ) ) {
				echo $popup_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			$this->is_already_increment = true;
		}
	}


	/**
	 * Fetches the popup data by its ID.
	 *
	 * @since 1.4.3
	 *
	 * @param int $id The ID of the popup.
	 * @return \WP_Post|null The popup post object or null if not found.
	 */
	public function get_popup_by_id( $id ) {
		return get_post( $id );
	}

	/**
	 * Enqueue popup admin scripts
	 *
	 * @return void
	 */
	public function popup_admin_scripts() {
		global $post;
		wp_enqueue_style( 'op-popup-admin', OMNIPRESS_URL . 'assets/build/css/admin.css', array(), OMNIPRESS_VERSION );

		if ( isset( $post->post_type ) && 'omnipress-popup' === $post->post_type ) {
			wp_enqueue_script( 'op_popup_toggle_status_script', OMNIPRESS_URL . 'assets/build/js/admin/popup-admin.js', array(), OMNIPRESS_VERSION, true );

			wp_localize_script(
				'op_popup_toggle_status_script',
				'OMNIPRESS_POPUP_BUILDER',
				array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'nonce'    => wp_create_nonce( 'status_toggle_nonce' ),
				)
			);
		}
	}

	/**
	 * Saves the popup data.
	 *
	 * @since 1.4.3
	 *
	 * @param array $data An associative array of popup data.
	 * @return int|WP_Error The ID of the saved popup or a WP_Error object on failure.
	 */
	public function save_popup( $data ) {
		$post_data = array(
			'post_title'   => $data['title'],
			'post_content' => $data['content'],
			'post_type'    => 'omnipress-popup',
			'post_status'  => 'publish',
		);

		if ( isset( $data['id'] ) && $data['id'] ) {
			$post_data['ID'] = $data['id'];
			$result          = wp_update_post( $post_data );
		} else {
			$result = wp_insert_post( $post_data );
		}

		return $result;
	}

	/**
	 * Deletes a popup by ID.
	 *
	 * @since 1.4.3
	 *
	 * @param int $id The ID of the popup.
	 * @return void
	 */
	public function delete_popup( $id ) {
		if ( $id ) {
			wp_delete_post( $id, true );
		}
	}

	/**
	 * Retrieves a list of all popups.
	 *
	 * @since 1.4.3
	 * @return array An array of WP_Post objects representing all popups.
	 */
	public function get_all_popups() {
		$args = array(
			'post_type'      => 'omnipress-popup',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		);

		$popups = get_posts( $args );
		return $popups;
	}

	/**
	 * Toggles the status of a popup.
	 *
	 * @since 1.4.3
	 * @return void
	 */
	public function toggle_popup_status() {
		if ( ! isset( $_POST['post_id'], $_POST['nonce'] ) ||
			! wp_verify_nonce( $_POST['nonce'], 'status_toggle_nonce' ) ) {
			wp_send_json_error( array( 'message' => __( 'Invalid nonce', 'textdomain' ) ) );
		}

		$post_id = intval( $_POST['post_id'] );

		// Retrieve the current value of the meta key.
		$current_value = get_post_meta( $post_id, 'opp_is_enabled', true );

		// Determine the next value based on the current value.
		// If $current_value is set and is true (including '1' string), set it to false, otherwise true.
		$next_value = 'false' === $current_value ? 'true' : 'false';

		// Update the post meta with the new value.
		$updated = update_post_meta( $post_id, 'opp_is_enabled', $next_value );

		if ( $updated || 0 == $updated ) {
			// Send success response if the update was successful or if no change was made (value remains the same).
			wp_send_json_success(
				array(
					'message' => __( 'Status updated successfully.', 'omnipress' ),
					'status'  => $next_value,
				)
			);
		} else {
			// Send error response if the update failed.
			wp_send_json_error(
				array(
					'message' => __( 'Failed to update status.', 'omnipress' ),
					'status'  => $next_value,
				)
			);
		}
	}



	/**
	 * Builds the popup structure.
	 *
	 * @since 1.4.3
	 * @return array The constructed popup array.
	 */
	public function build_popup() {
		$popup = array(
			'id'         => $this->popup_id,
			'title'      => $this->popup_title,
			'content'    => $this->popup_content,
			'settings'   => $this->popup_settings,
			'conditions' => $this->popup_conditions,
		);

		return $popup;
	}

	/**
	 * Removes data related to a specific popup when the post is moved to the trash.
	 *
	 * This includes clearing any associated cookies that track the popup.
	 *
	 * @param int $popup_id The ID of the popup post being trashed.
	 *
	 * @return void
	 */
	public function remove_popup_related_data( $popup_id ) {
		if ( 'omnipress-popup' !== get_post_type( $popup_id ) ) {
			return;
		}

		$cookie_name = self::POPUP_COOKIE_PREFIX . "$popup_id";

		setcookie( $cookie_name, '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN );

		if ( isset( $_COOKIE[ $cookie_name ] ) ) {
			unset( $_COOKIE[ $cookie_name ] );
		}
	}
}

PopupBuilder::init();
