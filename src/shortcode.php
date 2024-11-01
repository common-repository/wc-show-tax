<?php
namespace CeltaByte\WcShowTax\Shortcode;

use function CeltaByte\WcShowTax\Repository\get_session_showing_tax;
use const CeltaByte\WcShowTax\Action\NONCE;
use const CeltaByte\WcShowTax\Action\ACTION;

function init_shortcode() {
	add_shortcode( 'wc_show_tax', 'CeltaByte\WcShowTax\Shortcode\display_shortcode', PHP_INT_MAX );
}

function display_shortcode( $atts ) {
	$default = array(
		'class'           => 'wcshowtax',
		'including_label' => __( 'Prices including tax', 'wcshowtax' ),
		'excluding_label' => __( 'Prices excluding tax', 'wcshowtax' ),
	);
	$atts    = shortcode_atts( $default, $atts );

	$class       = $atts['class'];
	$label       = label( $atts );
	$action      = ACTION;
	$nonce       = NONCE;
	$nonce_value = wp_create_nonce( NONCE );

	ob_start();
	require __DIR__ . '/shortcode-tpl.php';
	return ob_get_clean();
}

function label( $atts ) : string {
	if ( 'incl' === get_session_showing_tax() ) {
		return $atts['excluding_label'];
	}
	return $atts['including_label'];
}
