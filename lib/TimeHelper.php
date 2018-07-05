<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 05.07.2018
 * Time: 20:33
 */

namespace WHMCS\Module\Addon\PostponeDueDate;

/**
 * Class TimeHelper
 * @package WHMCS\Module\Addon\PostponeDueDate
 */
class TimeHelper {

	/**
	 * Вернет значение timestamp с учетом того что часы,минуты,секунды равны нулю.
	 *
	 * @param string $Date
	 *
	 * @return int
	 */
	public static function MysqlDateToTimestamp( string $Date ): int {
		list( $invoice_year, $invoice_month, $invoice_day ) = explode( "-", $Date );

		return (int) mktime( 0, 0, 0, $invoice_month, $invoice_day, $invoice_year );
	}

	public static function TimestampToMysqlDate( int $timestamp ) {
		return date( "Y-m-d", $timestamp );
	}

	/**
	 * Вернет значение timestamp с учетом того что часы,минуты,секунды равны нулю.
	 * @return int
	 */
	public static function GetCurrentTimestampFormatMysqlDate(): int {
		return mktime( 0, 0, 0, date( "m" ), date( "d" ), date( "Y" ) );
	}

}