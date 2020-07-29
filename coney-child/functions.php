<?php

/*** Child Theme Function  ***/

if ( ! function_exists( 'coney_qodef_child_theme_enqueue_scripts' ) ) {
	function coney_qodef_child_theme_enqueue_scripts() {
		$parent_style = 'coney-qodef-default-style';

		wp_enqueue_style( 'coney-qodef-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}

	add_action( 'wp_enqueue_scripts', 'coney_qodef_child_theme_enqueue_scripts' );

	// Incluyendo Bootstrap CSS
	function bootstrap_css() {
		wp_enqueue_style( 'bootstrap_css', 
						'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', 
						array(), 
						'4.0.0'
						); 
	}
	add_action( 'wp_enqueue_scripts', 'bootstrap_css');

	// Incluyendo Bootstrap JS
	function bootstrap_js() {
		wp_enqueue_script( 'bootstrap_js', 
						'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', 
						array('jquery'), 
						'4.0.0', 
						true); 
	}
	add_action( 'wp_enqueue_scripts', 'bootstrap_js');

}