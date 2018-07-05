<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 05.07.2018
 * Time: 23:13
 */

namespace WHMCS\Module\Addon\PostponeDueDate;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class InvoiceItemHelper
 * @package WHMCS\Module\Addon\PostponeDueDate
 */
class InvoiceItemHelper {
	/**
	 * @param int $invoiceItemID
	 * @param string $description
	 */
	public static function UpdateDescription( int $invoiceItemID, string $description ):void {
		Capsule::table( 'tblinvoiceitems' )
		       ->where( 'id', $invoiceItemID )
		       ->update( [ 'description' => $description ] );
	}
}