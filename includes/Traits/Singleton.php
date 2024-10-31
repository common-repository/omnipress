<?php

namespace Omnipress\Traits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SingletonTrait
 *
 * A trait to implement the singleton pattern in classes.
 *
 * @package Omnipress\Includes\Traits
 */
trait Singleton {
	private static $instance;

	/**
	 * Get the singleton instance of the class
	 *
	 * @return static
	 */
	public static function init() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Prevent object cloning
	 */
	public function __clone() {}

	/**
	 * Prevent unserializing of the class
	 */
	public function __wakeup() {}
}
