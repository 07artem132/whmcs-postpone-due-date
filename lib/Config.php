<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 02.07.2018
 * Time: 15:59
 */

namespace WHMCS\Module\Addon\PostponeDueDate;

use  WHMCS\Module\Addon\Setting;

/**
 * Class Config
 * @package WHMCS\Module\Addon\PostponeDueDate
 */
class Config implements \ArrayAccess {
	private $config;

	/**
	 * Config constructor.
	 */
	function __construct() {
		array_walk( $this->load(), function ( $val, $key ) {
			$this->config[ $val['setting'] ] = $val['value'];
		} );
	}

	/**
	 * @return string[]
	 */
	function load(): array {
		return Setting::Module( 'PostponeDueDate' )->get()->toArray();
	}

	/**
	 * @return array
	 */
	function toArray() {
		return (array) $this->config;
	}

	/**
	 * @param mixed $offset
	 * @param mixed $value
	 */
	public function offsetSet( $offset, $value ) {
		if ( is_null( $offset ) ) {
			$this->config[] = $value;
		} else {
			$this->config[ $offset ] = $value;
		}
	}

	/**
	 * @param mixed $offset
	 *
	 * @return bool
	 */
	public function offsetExists( $offset ) {
		return isset( $this->config[ $offset ] );
	}

	/**
	 * @param mixed $offset
	 */
	public function offsetUnset( $offset ) {
		unset( $this->config[ $offset ] );
	}

	/**
	 * @param mixed $offset
	 *
	 * @return mixed|null
	 */
	public function offsetGet( $offset ) {
		return isset( $this->config[ $offset ] ) ? $this->config[ $offset ] : null;
	}

}