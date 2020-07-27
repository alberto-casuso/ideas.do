<?php

if ( ! function_exists('coney_qodef_contact_form_map') ) {
	/**
	 * Map Contact Form 7 shortcode
	 * Hooks on vc_after_init action
	 */
	function coney_qodef_contact_form_map() {
		vc_add_param('contact-form-7', array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'coney'),
			'param_name' => 'html_class',
			'value' => array(
				esc_html__('Default', 'coney') => 'default',
				esc_html__('Custom Style 1', 'coney') => 'cf7_custom_style_1',
				esc_html__('Custom Style 2', 'coney') => 'cf7_custom_style_2',
				esc_html__('Custom Style 3', 'coney') => 'cf7_custom_style_3'
			),
			'description' => esc_html__('You can style each form element individually in Select Options > Contact Form 7', 'coney')
		));
	}
	
	add_action('vc_after_init', 'coney_qodef_contact_form_map');
}