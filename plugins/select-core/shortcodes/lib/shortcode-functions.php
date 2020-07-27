<?php

if ( ! function_exists( 'coney_qodef_load_shortcode_interface' ) ) {
	function coney_qodef_load_shortcode_interface() {
		include_once QODE_CORE_ABS_PATH . '/shortcodes/lib/shortcode-interface.php';
	}

	add_action( 'coney_qodef_before_options_map', 'coney_qodef_load_shortcode_interface' );
}

if ( ! function_exists( 'coney_qodef_load_shortcodes' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 * and loads load.php file in each. Hooks to coney_qodef_after_options_map action
	 *
	 * @see http://php.net/manual/en/function.glob.php
	 */
	function coney_qodef_load_shortcodes() {
		foreach ( glob( QODE_CORE_ABS_PATH . '/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}

		do_action( 'coney_qodef_shortcode_loader' );
	}

	add_action( 'coney_qodef_before_options_map', 'coney_qodef_load_shortcodes' );
}