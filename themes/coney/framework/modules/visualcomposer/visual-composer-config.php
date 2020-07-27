<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if(function_exists('vc_set_as_theme')) {
	vc_set_as_theme();
}

/**
 * Change path for overridden templates
 */
if(function_exists('vc_set_shortcodes_templates_dir')) {
	$dir = QODE_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists('coney_qodef_configure_visual_composer_frontend_editor') ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function coney_qodef_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if(function_exists('vc_disable_frontend')){
			vc_disable_frontend();
		}
	}

	add_action('vc_after_init', 'coney_qodef_configure_visual_composer_frontend_editor');
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Qodef_Accordion extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qodef_Accordion_Tab extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qodef_Animation_Holder extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qodef_Clients_Carousel extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_Qodef_Clients extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_Client extends WPBakeryShortCodesContainer {    }
	class WPBakeryShortCode_Qodef_Elements_Holder extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qodef_Elements_Holder_Item extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qodef_Item_Showcase extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qodef_Parallax extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qodef_Pricing_Tables extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qodef_Tabs extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qodef_Tab extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qodef_Vertical_Split_Slider extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qodef_Vertical_Split_Slider_Left_Panel extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qodef_Vertical_Split_Slider_Right_Panel extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qodef_Vertical_Split_Slider_Content_Item extends WPBakeryShortCodesContainer {}
}

if (!function_exists('coney_qodef_vc_row_map')) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function coney_qodef_vc_row_map() {

		vc_add_param('vc_row', array(
			'type' => 'dropdown',
			'param_name' => 'row_content_width',
			'heading' => esc_html__('Select Row Content Width', 'coney'),
			'value' => array(
				esc_html__('Full Width', 'coney') => 'full-width',
				esc_html__('In Grid', 'coney') => 'grid'
			)
		));

		vc_add_param('vc_row', array(
			'type' => 'textfield',
			'param_name' => 'anchor',
			'heading' => esc_html__('Select Anchor ID', 'coney'),
			'description' => esc_html__('For example "home"', 'coney')
		));

		vc_add_param('vc_row', array(
			'type' => 'dropdown',
			'param_name' => 'content_text_aligment',
			'heading' => esc_html__('Select Content Aligment', 'coney'),
			'value' => array(
				esc_html__('Default', 'coney') => '',
				esc_html__('Left', 'coney') => 'left',
				esc_html__('Center', 'coney') => 'center',
				esc_html__('Right', 'coney') => 'right'
			)
		));

		/*** Row Inner ***/

		vc_add_param('vc_row_inner', array(
			'type' => 'dropdown',
			'param_name' => 'row_content_width',
			'heading' => esc_html__('Select Row Content Width', 'coney'),
			'value' => array(
				esc_html__('Full Width', 'coney') => 'full-width',
				esc_html__('In Grid', 'coney') => 'grid'
			)
		));

		vc_add_param('vc_row_inner', array(
			'type' => 'dropdown',
			'param_name' => 'content_text_aligment',
			'heading' => esc_html__('Select Content Aligment', 'coney'),
			'value' => array(
				esc_html__('Default', 'coney') => '',
				esc_html__('Left', 'coney') => 'left',
				esc_html__('Center', 'coney') => 'center',
				esc_html__('Right', 'coney') => 'right'
			)
		));
	}

	add_action('vc_after_init', 'coney_qodef_vc_row_map');
}