<?php
/**
 * Patterns model class.
 *
 * @package Omnipress\Admin
 */

namespace Omnipress\Admin;

use Omnipress\Abstracts\PatternsDemosModelsBase;

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Patterns model class.
 *
 * @since 1.1.0
 */
class PatternsModel extends PatternsDemosModelsBase {

	protected $model_type = 'patterns';

}