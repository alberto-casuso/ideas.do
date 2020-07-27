<?php

/*** Child Theme Function  ***/

if ( ! function_exists( 'coney_qodef_child_theme_enqueue_scripts' ) ) {
	function coney_qodef_child_theme_enqueue_scripts() {
		$parent_style = 'coney-qodef-default-style';

		wp_enqueue_style( 'coney-qodef-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}

	add_action( 'wp_enqueue_scripts', 'coney_qodef_child_theme_enqueue_scripts' );
}