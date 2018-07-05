<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 05.07.2018
 * Time: 17:22
 */

use WHMCS\Module\Addon\PostponeDueDate\Config;
use WHMCS\Module\Addon\PostponeDueDate\TimeHelper;
use WHMCS\Module\Addon\PostponeDueDate\BillingHelper;
use WHMCS\Module\Addon\PostponeDueDate\InvoiceHelper;
use WHMCS\Module\Addon\PostponeDueDate\ServiceHelper;
use WHMCS\Module\Addon\PostponeDueDate\InvoiceItemHelper;

add_hook( "InvoicePaidPreEmail", 1, function ( $vars ) {
	$config       = new Config();
	$invoiceItems = InvoiceHelper::GetInvoiceItems( $vars['invoiceid'] );

	foreach ( $invoiceItems as $item ) {
		$invoiceDueDate = TimeHelper::MysqlDateToTimestamp( $item->duedate );
		$currentDate    = TimeHelper::GetCurrentTimestampFormatMysqlDate();

		if ( $currentDate < $invoiceDueDate ) {
			return;
		}

		switch ( $item->type ) {
			case "Hosting":
				$Service = ServiceHelper::Get( $item->relid );

				if ( strcasecmp( $Service->regdate, $item->duedate ) === 0 && strcasecmp( $config['MoveFirstRenewalDate'], 'on' ) != 0 ) {
					return;
				}

				if ( strcasecmp( $Service->regdate, $item->duedate ) != 0 && strcasecmp( $config['MoveRenewalDate'], 'on' ) != 0 ) {
					return;
				}

				if ( strcasecmp( $config['OnlySuspended'], 'on' ) === 0 && strcasecmp( $Service->domainstatus, 'Suspended' ) != 0 ) {
					return;
				}

				$days = BillingHelper::CycleToDays( $Service->billingcycle );

				if ( $days === 0 ) {
					return;
				}

				$TimestampDays = $days * 86400;
				$nextDueDate   = $currentDate + $TimestampDays;

				$nextDueDateMysqlDate = TimeHelper::TimestampToMysqlDate( $nextDueDate );


				ServiceHelper::UpdateNextDueDate( $item->relid, $nextDueDateMysqlDate );
				ServiceHelper::UpdateNextInvoiceDate( $item->relid, $nextDueDateMysqlDate );

				$correct_description    = '(' . date( 'd/m/Y' ) . '- ' . date( 'd/m/y', $nextDueDate ) . ')';
				$invoiceItemDescription = preg_replace( "/\((\d+\/\d+\/\d+\s-\s\d+\/\d+\/\d+)\)/", $correct_description, $item->description );

				InvoiceItemHelper::UpdateDescription( $item->id, $invoiceItemDescription );
				break;
		}
	}
} );



