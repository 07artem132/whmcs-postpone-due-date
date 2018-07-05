<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 05.07.2018
 * Time: 20:30
 */

namespace WHMCS\Module\Addon\PostponeDueDate;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class InvoiceHelper
 * @package WHMCS\Module\Addon\PostponeDueDate
 */
class InvoiceHelper {

	/**
	 * @param int $invoiceID
	 *
	 * @return \stdClass[]
	 */
public static 	function GetInvoiceItems( int $invoiceID ): array {

		return Capsule::table( 'tblinvoiceitems' )->where( 'invoiceid', $invoiceID )->get();
	}

}