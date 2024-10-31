<?php

namespace Omnipress\Blocks;

use Omnipress\Abstracts\AbstractBlock;

/**
 * Class DynamicAbstract
 */
abstract class DynamicAbstract extends AbstractBlock {
	/**
	 *
	 * @param $default
	 * @return array
	 */
	protected function get_schema_boolean( $default = true ) {
		return array(
			'type'    => 'boolean',
			'default' => $default,
		);
	}

	/**
	 *
	 * @param $default
	 * @return array
	 */
	protected function get_schema_string( $default = '' ) {
		return array(
			'type'    => 'string',
			'default' => $default,
		);
	}

	/**
	 *
	 * @param $default
	 * @return array
	 */
	protected function get_schema_number( $default ) {
		return array(
			'type'    => 'number',
			'default' => $default,
		);
	}
}
