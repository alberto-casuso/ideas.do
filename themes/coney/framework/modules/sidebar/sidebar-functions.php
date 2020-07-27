<?php

if ( ! function_exists( 'coney_qodef_sidebar_layout' ) ) {
	/**
	 * Function that check is sidebar is enabled and return type of sidebar layout
	 */
	function coney_qodef_sidebar_layout() {
		$sidebar_layout         = '';
		$sidebar_layout_meta    = coney_qodef_get_meta_field_intersect( 'sidebar_layout' );
		$archive_sidebar_layout = coney_qodef_options()->getOptionValue( 'archive_sidebar_layout' );
		$search_sidebar_layout  = coney_qodef_options()->getOptionValue( 'search_page_sidebar_layout' );
		$single_sidebar_layout  = coney_qodef_get_meta_field_intersect( 'blog_single_sidebar_layout' );

		if ( ! empty( $sidebar_layout_meta ) ) {
			$sidebar_layout = $sidebar_layout_meta;
		}

		if ( is_singular( 'post' ) && ! empty( $single_sidebar_layout ) ) {
			$sidebar_layout = $single_sidebar_layout;
		}

		if ( is_search() && ! coney_qodef_is_woocommerce_shop() && ! empty( $search_sidebar_layout ) ) {
			$sidebar_layout = $search_sidebar_layout;
		}

		if ( ( is_archive() || ( is_home() && is_front_page() ) ) && ! coney_qodef_is_woocommerce_page() && ! empty( $archive_sidebar_layout ) ) {
			$sidebar_layout = $archive_sidebar_layout;
		}

		if ( is_archive() && coney_qodef_is_woocommerce_installed() ) {
			if ( is_product_category() || is_product_tag() ) {
				$shop_id        = get_option( 'woocommerce_shop_page_id' );
				$sidebar_layout = coney_qodef_get_meta_field_intersect( 'sidebar_layout', $shop_id );
			}
		}

		if ( ! empty( $sidebar_layout ) && ! is_active_sidebar( coney_qodef_get_sidebar() ) ) {
			$sidebar_layout = '';
		}

		return $sidebar_layout;
	}
}

if ( ! function_exists( 'coney_qodef_sidebar_columns_class' ) ) {
	/**
	 * Return classes for columns holder when sidebar is active
	 *
	 * @return array
	 */
	function coney_qodef_sidebar_columns_class() {
		$sidebar_class  = array();
		$sidebar_layout = coney_qodef_sidebar_layout();

		switch ( $sidebar_layout ):
			case 'sidebar-33-right':
				$sidebar_class[] = 'qodef-content-columns-66-33';
				$sidebar_class[] = 'qodef-content-sidebar-right';
				$sidebar_class[] = 'qodef-content-has-sidebar';
				break;
			case 'sidebar-25-right':
				$sidebar_class[] = 'qodef-content-columns-75-25';
				$sidebar_class[] = 'qodef-content-sidebar-right';
				$sidebar_class[] = 'qodef-content-has-sidebar';
				break;
			case 'sidebar-33-left':
				$sidebar_class[] = 'qodef-content-columns-33-66';
				$sidebar_class[] = 'qodef-content-sidebar-left';
				$sidebar_class[] = 'qodef-content-has-sidebar';
				break;
			case 'sidebar-25-left':
				$sidebar_class[] = 'qodef-content-columns-25-75';
				$sidebar_class[] = 'qodef-content-sidebar-left';
				$sidebar_class[] = 'qodef-content-has-sidebar';
				break;
			default:
				$sidebar_class[] = 'qodef-content-columns-100';
		endswitch;

		$sidebar_class = apply_filters( 'coney_qodef_sidebar_columns_classes', $sidebar_class );

		$sidebar_class = implode( ' ', $sidebar_class );

		return $sidebar_class;
	}
}

if ( ! function_exists( 'coney_qodef_sidebar_columns_space_class' ) ) {
	/**
	 * Set space between columns holder when sidebar is active
	 *
	 * @return array
	 */
	function coney_qodef_sidebar_columns_space_class( $classes ) {
		$sidebar_classes   = array();
		$sidebar_classes[] = 'qodef-columns-normal-space';
		$sidebar_classes   = apply_filters( 'coney_qodef_sidebar_columns_space_classes', $sidebar_classes );

		$sidebar_classes = array_merge( $classes, $sidebar_classes );

		return $sidebar_classes;
	}

	add_filter( 'coney_qodef_sidebar_columns_classes', 'coney_qodef_sidebar_columns_space_class' );
}

if ( ! function_exists( 'coney_qodef_get_sidebar' ) ) {
	/**
	 * Return Sidebar name
	 *
	 * @return string
	 */
	function coney_qodef_get_sidebar() {
		$sidebar_name                = 'sidebar';
		$custom_sidebar_area         = coney_qodef_get_meta_field_intersect( 'custom_sidebar_area' );
		$custom_archive_sidebar_area = coney_qodef_options()->getOptionValue( 'archive_custom_sidebar_area' );
		$custom_search_sidebar_area  = coney_qodef_options()->getOptionValue( 'search_custom_sidebar_area' );
		$custom_single_sidebar_area  = coney_qodef_get_meta_field_intersect( 'blog_single_custom_sidebar_area' );

		if ( ! empty( $custom_sidebar_area ) ) {
			$sidebar_name = $custom_sidebar_area;
		}

		if ( is_singular( 'post' ) && ! empty( $custom_single_sidebar_area ) ) {
			$sidebar_name = $custom_single_sidebar_area;
		}

		if ( is_search() && ! empty( $custom_search_sidebar_area ) ) {
			$sidebar_name = $custom_search_sidebar_area;
		}

		if ( ( is_archive() || ( is_home() && is_front_page() ) ) && ! coney_qodef_is_woocommerce_page() && ! empty( $custom_archive_sidebar_area ) ) {
			$sidebar_name = $custom_archive_sidebar_area;
		}

		if ( is_archive() && coney_qodef_is_woocommerce_installed() ) {
			if ( is_product_category() || is_product_tag() ) {
				$shop_id      = get_option( 'woocommerce_shop_page_id' );
				$sidebar_name = coney_qodef_get_meta_field_intersect( 'custom_sidebar_area', $shop_id );
			}
		}

		return $sidebar_name;
	}
}

if ( ! function_exists( 'coney_qodef_get_custom_sidebars' ) ) {
	/**
	 * Function that returns all custom made sidebars.
	 *
	 * @return array array of custom made sidebars where key and value are sidebar name
	 * @uses get_option()
	 */
	function coney_qodef_get_custom_sidebars() {
		$coney_custom_sidebars = get_option( 'qode_sidebars' );
		$formatted_array       = array();

		if ( is_array( $coney_custom_sidebars ) && count( $coney_custom_sidebars ) ) {
			foreach ( $coney_custom_sidebars as $custom_sidebar ) {
				$formatted_array[ sanitize_title( $custom_sidebar ) ] = $custom_sidebar;
			}
		}

		return $formatted_array;
	}
}




