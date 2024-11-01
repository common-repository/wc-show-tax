<?php
namespace CeltaByte\WcShowTax\Repository;

const SHOWING_TAX_SESSION_KEY        = 'wcshowtax';
const WOOCOMMERCE_DISPLAY_TAX_OPTION = 'woocommerce_tax_display_shop';

function init_repository() {
	add_action( 'init', 'CeltaByte\WcShowTax\Repository\maybe_start_woocoomerce_session', PHP_INT_MAX );
}

function maybe_start_woocoomerce_session() {
	if ( is_woocommerce_session_started() ) {
		return;
	}
	woocommerce_session_start();
}

function is_woocommerce_session_started() : bool {
	if ( ! function_exists( '\WC' ) ) {
		return false;
	}
	if ( ! \WC()->session ) {
		return false;
	}
	return \WC()->session->has_session();
}

function woocommerce_session_start() {
	if ( is_null( \WC()->session ) ) {
		return;
	}
	\WC()->session->set_customer_session_cookie( true );
}

function get_showing_tax( string $default_showing_tax ) : string {
	if ( is_null( \WC()->session ) ) {
		return $default_showing_tax;
	}
	return get_session_showing_tax( $default_showing_tax );
}

function toggle_showing_tax() {
	$old_showing_tax = \WC()->session->get( SHOWING_TAX_SESSION_KEY, 'incl' );
	$new_showing_tax = 'incl' === $old_showing_tax ? 'excl' : 'incl';
	\WC()->session->set( SHOWING_TAX_SESSION_KEY, $new_showing_tax );
}

function get_session_showing_tax( string $default_showing_tax = 'incl' ) : string {
	return \WC()->session->get( SHOWING_TAX_SESSION_KEY, $default_showing_tax );
}
