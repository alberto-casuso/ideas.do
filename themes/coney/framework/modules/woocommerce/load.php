<?php
include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/woocommerce-functions.php';

if ( coney_qodef_is_woocommerce_installed() ) {
	include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/options-map/map.php';
	include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/woocommerce-template-hooks.php';
	include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/woocommerce-config.php';
}