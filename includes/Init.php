<?php
/**
 * Main file for omnipress plugin.
 *
 * @package Omnipress
 */

namespace Omnipress;

require_once OMNIPRESS_PATH . 'classes/class-blocks-assets-helper.php';
require_once OMNIPRESS_PATH . 'classes/class-block-settings.php';
require_once OMNIPRESS_PATH . 'classes/class-filesystem-util.php';
require_once OMNIPRESS_PATH . 'includes/Block.php';

use Omnipress\Abstracts\BlockTemplateBase;
use Omnipress\Admin\Init as AdminInit;
use Omnipress\Publics\Init as PublicsInit;
use Omnipress\RestApi\RestApi;

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main file for omnipress plugin.
 *
 * @since 1.1.0
 */
class Init {

	/**
	 * This object instance.
	 *
	 * @var \Omnipress\Init
	 */
	protected static $instance = null;

	/**
	 * Returns this object instance.
	 *
	 * @return \Omnipress\Init
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
	public function update_search_template_hierarchy( $templates ) {
		if ( ( is_search() && is_post_type_archive( 'product' ) ) && wc_current_theme_is_fse_theme() ) {
			array_unshift( $templates, self::SLUG );
		}
		return $templates;
	}

	/**
	 * Enqueue animation library.
	 */
	public static function enqueue_animation_library() {
	}
	/**
	 * Class construct.
	 */
	function log_enqueued_scripts() {
		global $wp_scripts;
	}
	public function __construct() {
		require_once OMNIPRESS_PATH . 'includes/Blocks/WpFormsExtender.php';
		require OMNIPRESS_PATH . 'includes/Models/BlocksModel.php';
		require_once OMNIPRESS_PATH . 'classes/class-popup-builder.php';
		new BlockSettings();
		AdminInit::init();
		PublicsInit::init();
		RestApi::init();
		add_action( 'enqueue_block_assets', array( $this, 'enqueue_animation_library' ) );

		BlockTemplateBase::init();
	}
}
