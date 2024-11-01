<?php
namespace CeltaByte\WcShowTax\Action;

use function CeltaByte\WcShowTax\Repository\get_showing_tax;
use function  CeltaByte\WcShowTax\Repository\toggle_showing_tax;
use const CeltaByte\WcShowTax\Repository\WOOCOMMERCE_DISPLAY_TAX_OPTION;

const ACTION = 'weshowtax_toggle_show_tax';
const NONCE  = 'weshowtax_nonce';

function init_action() {
	add_action( 'init', 'CeltaByte\WcShowTax\Action\toggle_show_tax', PHP_INT_MAX );
	$default_showing_tax = \get_option( WOOCOMMERCE_DISPLAY_TAX_OPTION, 'incl' );
	add_filter(
		'option_woocommerce_tax_display_shop',
		function() use ( $default_showing_tax ) {
			$display_tax = get_showing_tax( $default_showing_tax );
			return $display_tax;
		}
	);
}

function toggle_show_tax() {
	if ( false === is_toggle_show_tax_action() ) {
		return;
	}
	toggle_showing_tax();
}

function is_toggle_show_tax_action() : bool {
	if ( ! isset( $_REQUEST[ ACTION ] ) || ! isset( $_REQUEST[ NONCE ] ) ) {
		return false;
	}
	return wp_verify_nonce( $_REQUEST[ NONCE ], NONCE );
}
