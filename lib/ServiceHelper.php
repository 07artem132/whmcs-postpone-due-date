<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 05.07.2018
 * Time: 20:40
 */

namespace WHMCS\Module\Addon\PostponeDueDate;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class ServiceHelper
 * @package WHMCS\Module\Addon\PostponeDueDate
 */
class ServiceHelper {

	/**
	 * @param int $serviceID
	 *
	 * @return  \stdClass
	 */
	public static function Get( int $serviceID ): \stdClass {
		return Capsule::table( 'tblhosting' )->where( 'id', $serviceID )->first();

	}

	/**
	 * @param int $serviceID
	 * @param string $Date
	 */
	public static function UpdateNextDueDate( int $serviceID, string $Date ): void {
		Capsule::table( 'tblhosting' )
		       ->where( 'id', $serviceID )
		       ->update( [ 'nextduedate' => $Date ] );
	}

	/**
	 * @param int $serviceID
	 * @param string $Date
	 */
	public static function UpdateNextInvoiceDate( int $serviceID, string $Date ): void {
		Capsule::table( 'tblhosting' )
		       ->where( 'id', $serviceID )
		       ->update( [ 'nextinvoicedate' => $Date ] );
	}

}