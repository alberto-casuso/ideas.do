<?php

if(!function_exists('coney_qodef_disable_wpml_css')) {
    function coney_qodef_disable_wpml_css() {
	    define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
    }

	add_action('after_setup_theme', 'coney_qodef_disable_wpml_css');
}