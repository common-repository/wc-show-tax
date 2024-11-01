<?php
/**
 * Plugin Name: Show Tax for WooCommerce
 * Plugin URI: https://celtabyte.es
 * Description: Shortcode to display product prices including or excluding taxes in WooCommerce.
 * Version: 1.0.1
 * Author: wooenvio
 * Author URI: https://celtabyte.es
 */

require __DIR__ . '/vendor/autoload.php';

load_plugin_textdomain( 'wcshowtax', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

CeltaByte\WcShowTax\Action\init_action();
CeltaByte\WcShowTax\Repository\init_repository();
CeltaByte\WcShowTax\Shortcode\init_shortcode();
