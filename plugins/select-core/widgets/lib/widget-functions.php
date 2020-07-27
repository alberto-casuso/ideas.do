<?php

if ( ! function_exists( 'coney_qodef_load_widget_class' ) ) {
	/**
	 * Loades widget class file.
	 *
	 */
	function coney_qodef_load_widget_class() {
		include_once QODE_CORE_ABS_PATH . '/widgets/lib/widget-class.php';
	}

	add_action( 'coney_qodef_before_options_map', 'coney_qodef_load_widget_class' );
}

if ( ! function_exists( 'coney_qodef_load_widgets' ) ) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to coney_qodef_after_options_map action
	 */
	function coney_qodef_load_widgets() {
		foreach ( glob( QODE_CORE_ABS_PATH . '/widgets/*/load.php' ) as $widget_load ) {
			include_once $widget_load;
		}

		include_once QODE_CORE_ABS_PATH . '/widgets/lib/widget-loader.php';
	}

	add_action( 'coney_qodef_before_options_map', 'coney_qodef_load_widgets' );
}