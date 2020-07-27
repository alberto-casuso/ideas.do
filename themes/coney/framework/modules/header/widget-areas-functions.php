<?php

if ( ! function_exists( 'coney_qodef_register_top_header_areas' ) ) {
	/**
	 * Registers widget areas for top header bar when it is enabled
	 */
	function coney_qodef_register_top_header_areas() {

		register_sidebar( array(
			'name'          => esc_html__( 'Top Bar Left Column', 'coney' ),
			'id'            => 'qodef-top-bar-left',
			'before_widget' => '<div id="%1$s" class="widget %2$s qodef-top-bar-widget">',
			'after_widget'  => '</div>',
			'description'   => esc_html__( 'Widgets added here will appear on the left side in top bar header', 'coney' )
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Top Bar Middle Column', 'coney' ),
			'id'            => 'qodef-top-bar-center',
			'before_widget' => '<div id="%1$s" class="widget %2$s qodef-top-bar-widget">',
			'after_widget'  => '</div>',
			'description'   => esc_html__( 'Widgets added here will appear on the middle side in top bar header', 'coney' )
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Top Bar Right Column', 'coney' ),
			'id'            => 'qodef-top-bar-right',
			'before_widget' => '<div id="%1$s" class="widget %2$s qodef-top-bar-widget">',
			'after_widget'  => '</div>',
			'description'   => esc_html__( 'Widgets added here will appear on the right side in top bar header', 'coney' )
		) );
	}

	add_action( 'widgets_init', 'coney_qodef_register_top_header_areas' );
}

if ( ! function_exists( 'coney_qodef_header_widget_areas' ) ) {
	/**
	 * Registers widget areas for header types
	 */
	function coney_qodef_header_standard_widget_areas() {
		if ( coney_qodef_core_plugin_installed() ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Header Widget Area', 'coney' ),
				'id'            => 'qodef-header-widget-area',
				'before_widget' => '<div id="%1$s" class="widget %2$s qodef-header-widget-area">',
				'after_widget'  => '</div>',
				'description'   => esc_html__( 'Widgets added here will appear on the right hand side from the main menu', 'coney' )
			) );
		}
	}

	add_action( 'widgets_init', 'coney_qodef_header_standard_widget_areas' );
}

if ( ! function_exists( 'coney_qodef_register_mobile_header_areas' ) ) {
	/**
	 * Registers widget areas for mobile header
	 */
	function coney_qodef_register_mobile_header_areas() {
		if ( coney_qodef_is_responsive_on() && coney_qodef_core_plugin_installed() ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Mobile Header Widget Area', 'coney' ),
				'id'            => 'qodef-right-from-mobile-logo',
				'before_widget' => '<div id="%1$s" class="widget %2$s qodef-right-from-mobile-logo">',
				'after_widget'  => '</div>',
				'description'   => esc_html__( 'Widgets added here will appear on the right hand side from the mobile logo on mobile header', 'coney' )
			) );
		}
	}

	add_action( 'widgets_init', 'coney_qodef_register_mobile_header_areas' );
}

if ( ! function_exists( 'coney_qodef_register_sticky_header_areas' ) ) {
	/**
	 * Registers widget area for sticky header
	 */
	function coney_qodef_register_sticky_header_areas() {
		if ( in_array( coney_qodef_options()->getOptionValue( 'header_behaviour' ), array(
			'sticky-header-on-scroll-up',
			'sticky-header-on-scroll-down-up'
		) ) ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Sticky Header Widget Area', 'coney' ),
				'id'            => 'qodef-sticky-right',
				'before_widget' => '<div id="%1$s" class="widget %2$s qodef-sticky-right">',
				'after_widget'  => '</div>',
				'description'   => esc_html__( 'Widgets added here will appear on the right hand side from the sticky menu', 'coney' )
			) );
		}
	}

	add_action( 'widgets_init', 'coney_qodef_register_sticky_header_areas' );
}