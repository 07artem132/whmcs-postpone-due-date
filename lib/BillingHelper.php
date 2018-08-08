<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 05.07.2018
 * Time: 21:07
 */

namespace WHMCS\Module\Addon\PostponeDueDate;

/**
 * Class BillingHelper
 * @package WHMCS\Module\Addon\PostponeDueDate
 */
class BillingHelper {
	/**
	 * @param $cycle
	 *
	 * @return int
	 * @throws \Exception
	 */
	public static function CycleToMonthly( $cycle ): int {
		switch ( $cycle ) {
			case "Monthly":
				return 1;
				break;
			case "Quarterly":
				return 3;
				break;
			case "Semi-Annually":
				return 6;
				break;
			case "Annually":
				return 12;
				break;
			case "Biennially":
				return 24;
				break;
			case "Triennially":
				return 36;
				break;
			case "One Time":
				return 0;
				break;
			case "Free Account":
				return 0;
				break;
			default:
				throw new \Exception( 'Не известный цикл биллинга' );
				break;
		}
	}

	/**
	 * @param $cycle
	 *
	 * @return int
	 * @throws \Exception
	 */
	public static function CycleToDays( $cycle ): int {
		switch ( $cycle ) {
			case "Monthly":
				return 30;
				break;
			case "Quarterly":
				return 90;
				break;
			case "Semi-Annually":
				return 180;
				break;
			case "Annually":
				return 360;
				break;
			case "Biennially":
				return 720;
				break;
			case "Triennially":
				return 960;
				break;
			case "One Time":
				return 0;
				break;
			case "Free Account":
				return 0;
				break;
			default:
				throw new \Exception( 'Не известный цикл биллинга' );
				break;
		}
	}

}