<?php

if (!function_exists('coney_qodef_side_area_slide_from_right_type_style')) {

	function coney_qodef_side_area_slide_from_right_type_style()	{
		$width = coney_qodef_options()->getOptionValue('side_area_width');
		
		if ($width !== '') {
			echo coney_qodef_dynamic_css('.qodef-side-menu-slide-from-right .qodef-side-menu', array(
				'right' => '-'.coney_qodef_filter_px($width) . 'px',
				'width' => coney_qodef_filter_px($width) . 'px'
			));
		}
	}

	add_action('coney_qodef_style_dynamic', 'coney_qodef_side_area_slide_from_right_type_style');
}

if (!function_exists('coney_qodef_side_area_icon_color_styles')) {

	function coney_qodef_side_area_icon_color_styles() {
		$icon_color             = coney_qodef_options()->getOptionValue('side_area_icon_color');
		$icon_hover_color       = coney_qodef_options()->getOptionValue('side_area_icon_hover_color');
		$close_icon_color       = coney_qodef_options()->getOptionValue('side_area_close_icon_color');
		$close_icon_hover_color = coney_qodef_options()->getOptionValue('side_area_close_icon_hover_color');
		
		$icon_hover_selector    = array(
			'.qodef-side-menu-button-opener:hover',
			'.qodef-side-menu-button-opener.opened'
		);
		
		if (!empty($icon_color)) {
			echo coney_qodef_dynamic_css('.qodef-side-menu-button-opener', array(
				'color' => $icon_color
			));
		}

		if (!empty($icon_hover_color)) {
			echo coney_qodef_dynamic_css($icon_hover_selector, array(
				'color' => $icon_hover_color . '!important'
			));
		}

		if (!empty($close_icon_color)) {
			echo coney_qodef_dynamic_css('.qodef-side-menu a.qodef-close-side-menu', array(
				'color' => $close_icon_color
			));
		}

		if (!empty($close_icon_hover_color)) {
			echo coney_qodef_dynamic_css('.qodef-side-menu a.qodef-close-side-menu:hover', array(
				'color' => $close_icon_hover_color
			));
		}
	}

	add_action('coney_qodef_style_dynamic', 'coney_qodef_side_area_icon_color_styles');
}

if (!function_exists('coney_qodef_side_area_styles')) {
	function coney_qodef_side_area_styles() {
		
		$side_area_styles = array();
		$background_color = coney_qodef_options()->getOptionValue('side_area_background_color');
		$padding          = coney_qodef_options()->getOptionValue('side_area_padding');
		$text_alignment   = coney_qodef_options()->getOptionValue('side_area_aligment');

		if (!empty($background_color)) {
			$side_area_styles['background-color'] = $background_color;
		}

		if (!empty($padding)) {
			$side_area_styles['padding'] = esc_attr($padding);
		}
		
		if (!empty($text_alignment)) {
			$side_area_styles['text-align'] = $text_alignment;
		}

		if (!empty($side_area_styles)) {
			echo coney_qodef_dynamic_css('.qodef-side-menu', $side_area_styles);
		}
		
		if($text_alignment === 'center') {
			echo coney_qodef_dynamic_css('.qodef-side-menu .widget img', array(
				'margin' => '0 auto'
			));
		}
	}

	add_action('coney_qodef_style_dynamic', 'coney_qodef_side_area_styles');
}