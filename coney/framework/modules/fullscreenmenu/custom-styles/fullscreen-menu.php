<?php

if (!function_exists('coney_qodef_fullscreen_menu_general_styles')) {
	function coney_qodef_fullscreen_menu_general_styles() {
		$text_alignment          = coney_qodef_options()->getOptionValue('fullscreen_alignment');
		$text_alignment_selector = array(
			'nav.qodef-fullscreen-menu ul li',
			'.qodef-fullscreen-above-menu-widget-holder',
			'.qodef-fullscreen-below-menu-widget-holder'
		);
		
		if (!empty($text_alignment)) {
			echo coney_qodef_dynamic_css($text_alignment_selector, array(
				'text-align' => $text_alignment
			));
		}
		
		$background_color         = coney_qodef_options()->getOptionValue('fullscreen_menu_background_color');
		$background_transparency  = coney_qodef_options()->getOptionValue('fullscreen_menu_background_transparency');
		$background_image         = coney_qodef_options()->getOptionValue('fullscreen_menu_background_image');
		$background_pattern_image = coney_qodef_options()->getOptionValue('fullscreen_menu_pattern_image');
		
		$fullscreen_background_color        = !empty($background_color) ? coney_qodef_hex2rgb($background_color) : '';
		$fullscreen_background_transparency = $background_transparency !== '' ? $background_transparency : 0.9;

		if (!empty($fullscreen_background_color)) {
			echo coney_qodef_dynamic_css('.qodef-fullscreen-menu-holder', array(
				'background-color' => 'rgba(' . $fullscreen_background_color[0] . ',' . $fullscreen_background_color[1] . ',' . $fullscreen_background_color[2] . ',' . $fullscreen_background_transparency . ')'
			));
		}

		if (!empty($background_image)) {
			echo coney_qodef_dynamic_css('.qodef-fullscreen-menu-holder', array(
				'background-image' => 'url(' . esc_url($background_image) . ')',
				'background-position' => 'center 0',
				'background-repeat' => 'no-repeat'
			));
		}

		if (!empty($background_pattern_image)) {
			echo coney_qodef_dynamic_css('.qodef-fullscreen-menu-holder', array(
				'background-image' => 'url(' . esc_url($background_pattern_image) . ')',
				'background-repeat' => 'repeat',
				'background-position' => '0 0'
			));
		}
	}

	add_action('coney_qodef_style_dynamic', 'coney_qodef_fullscreen_menu_general_styles');
}

if (!function_exists('coney_qodef_fullscreen_menu_first_level_style')) {
	function coney_qodef_fullscreen_menu_first_level_style()	{
		$first_menu_style = coney_qodef_get_typography_styles('fullscreen_menu');
		
		$first_menu_selector = array(
			'nav.qodef-fullscreen-menu > ul > li > a'
		);
		
		echo coney_qodef_dynamic_css($first_menu_selector, $first_menu_style);
		

		$first_menu_hover_style = array();

		if (coney_qodef_options()->getOptionValue('fullscreen_menu_hover_color') !== '') {
			$first_menu_hover_style['color'] = coney_qodef_options()->getOptionValue('fullscreen_menu_hover_color');
		}

		if (!empty($first_menu_hover_style)) {
			echo coney_qodef_dynamic_css('nav.qodef-fullscreen-menu > ul > li > a:hover', $first_menu_hover_style);
		}

		$first_menu_active_style = array();

		if (coney_qodef_options()->getOptionValue('fullscreen_menu_active_color') !== '') {
			$first_menu_active_style['color'] = coney_qodef_options()->getOptionValue('fullscreen_menu_active_color');
		}

		if (!empty($first_menu_active_style)) {
			echo coney_qodef_dynamic_css('nav.qodef-fullscreen-menu > ul > li.qodef-active-item > a', $first_menu_active_style);
		}
	}

	add_action('coney_qodef_style_dynamic', 'coney_qodef_fullscreen_menu_first_level_style');
}

if (!function_exists('coney_qodef_fullscreen_menu_second_level_style')) {
	function coney_qodef_fullscreen_menu_second_level_style() {
		$second_menu_style = coney_qodef_get_typography_styles('fullscreen_menu', '_2nd');
		
		$second_menu_selector = array(
			'nav.qodef-fullscreen-menu ul li ul li a'
		);
		
		echo coney_qodef_dynamic_css($second_menu_selector, $second_menu_style);
		

		$second_menu_hover_style = array();

		if (coney_qodef_options()->getOptionValue('fullscreen_menu_hover_color_2nd') !== '') {
			$second_menu_hover_style['color'] = coney_qodef_options()->getOptionValue('fullscreen_menu_hover_color_2nd');
		}

		if (!empty($second_menu_hover_style)) {
			echo coney_qodef_dynamic_css('nav.qodef-fullscreen-menu ul li ul li a:hover, nav.qodef-fullscreen-menu ul li ul li.current-menu-ancestor > a, nav.qodef-fullscreen-menu ul li ul li.current-menu-item > a', $second_menu_hover_style);
		}
	}

	add_action('coney_qodef_style_dynamic', 'coney_qodef_fullscreen_menu_second_level_style');
}

if (!function_exists('coney_qodef_fullscreen_menu_third_level_style')) {
	function coney_qodef_fullscreen_menu_third_level_style()	{
		$third_menu_style = coney_qodef_get_typography_styles('fullscreen_menu', '_3rd');
		
		$third_menu_selector = array(
			'nav.qodef-fullscreen-menu ul li ul li ul li a'
		);
		
		echo coney_qodef_dynamic_css($third_menu_selector, $third_menu_style);
		

		$third_menu_hover_style = array();

		if (coney_qodef_options()->getOptionValue('fullscreen_menu_hover_color_3rd') !== '') {
			$third_menu_hover_style['color'] = coney_qodef_options()->getOptionValue('fullscreen_menu_hover_color_3rd');
		}

		if (!empty($third_menu_hover_style)) {
			echo coney_qodef_dynamic_css('nav.qodef-fullscreen-menu ul li ul li ul li a:hover, nav.qodef-fullscreen-menu ul li ul li ul li.current-menu-ancestor > a, nav.qodef-fullscreen-menu ul li ul li ul li.current-menu-item > a', $third_menu_hover_style);
		}
	}

	add_action('coney_qodef_style_dynamic', 'coney_qodef_fullscreen_menu_third_level_style');
}

if (!function_exists('coney_qodef_fullscreen_menu_icon_styles')) {
	function coney_qodef_fullscreen_menu_icon_styles() {
		$icon_color       = coney_qodef_options()->getOptionValue('fullscreen_menu_icon_color');
		$icon_hover_color = coney_qodef_options()->getOptionValue('fullscreen_menu_icon_hover_color');
		
		$icon_hover_selector = array(
			'.qodef-fullscreen-menu-opener:hover',
			'.qodef-fullscreen-menu-opener.qodef-fm-opened'
		);
			
		if (!empty($icon_color)) {
			echo coney_qodef_dynamic_css('.qodef-fullscreen-menu-opener', array(
				'background-color' => $icon_color
			));
		}

		if (!empty($icon_hover_color)) {
			echo coney_qodef_dynamic_css($icon_hover_selector, array(
				'background-color' => $icon_hover_color
			));
		}
	}

	add_action('coney_qodef_style_dynamic', 'coney_qodef_fullscreen_menu_icon_styles');
}