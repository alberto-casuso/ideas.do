<?php

if ( ! function_exists('coney_qodef_fullscreen_menu_options_map')) {

	function coney_qodef_fullscreen_menu_options_map() {

		coney_qodef_add_admin_page(
			array(
				'slug' => '_fullscreen_menu_page',
				'title' => esc_html__('Fullscreen Menu', 'coney'),
				'icon' => 'fa fa-th-large'
			)
		);

		$fullscreen_panel = coney_qodef_add_admin_panel(
			array(
				'title' => esc_html__('Fullscreen Menu', 'coney'),
				'name' => 'fullscreen_menu',
				'page' => '_fullscreen_menu_page'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'select',
				'name' => 'fullscreen_menu_animation_style',
				'default_value' => 'fade-push-text-right',
				'label' => esc_html__('Fullscreen Menu Overlay Animation', 'coney'),
				'description' => esc_html__('Choose animation type for fullscreen menu overlay', 'coney'),
				'options' => array(
					'fade-push-text-right' => esc_html__('Fade Push Text Right', 'coney'),
					'fade-push-text-top' => esc_html__('Fade Push Text Top', 'coney'),
					'fade-text-scaledown' => esc_html__('Fade Text Scaledown', 'coney')
				)
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent'        => $fullscreen_panel,
				'type'          => 'image',
				'name'          => 'fullscreen_logo',
				'default_value' => '',
				'label'         => esc_html__('Logo in Fullscreen Menu Overlay', 'coney'),
				'description'   => esc_html__('Place logo in top left corner of fullscreen menu overlay', 'coney'),
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'yesno',
				'name' => 'fullscreen_in_grid',
				'default_value' => 'no',
				'label' => esc_html__('Fullscreen Menu in Grid', 'coney'),
				'description' => esc_html__('Enabling this option will put fullscreen menu content in grid', 'coney'),
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'selectblank',
				'name' => 'fullscreen_alignment',
				'default_value' => '',
				'label' => esc_html__('Fullscreen Menu Alignment', 'coney'),
				'description' => esc_html__('Choose alignment for fullscreen menu content', 'coney'),
				'options' => array(
					'' => esc_html__('Default', 'coney'),
					'left' => esc_html__('Left', 'coney'),
					'center' => esc_html__('Center', 'coney'),
					'right' => esc_html__('Right', 'coney')
				)
			)
		);

		$background_group = coney_qodef_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'background_group',
				'title' => esc_html__('Background', 'coney'),
				'description' => esc_html__('Select a background color and transparency for fullscreen menu (0 = fully transparent, 1 = opaque)', 'coney')
			)
		);

		$background_group_row = coney_qodef_add_admin_row(
			array(
				'parent' => $background_group,
				'name' => 'background_group_row'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_background_color',
				'label' => esc_html__('Background Color', 'coney')
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_background_transparency',
				'label' => esc_html__('Background Transparency', 'coney')
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'image',
				'name' => 'fullscreen_menu_background_image',
				'label' => esc_html__('Background Image', 'coney'),
				'description' => esc_html__('Choose a background image for fullscreen menu background', 'coney')
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'image',
				'name' => 'fullscreen_menu_pattern_image',
				'label' => esc_html__('Pattern Background Image', 'coney'),
				'description' => esc_html__('Choose a pattern image for fullscreen menu background', 'coney')
			)
		);

		//1st level style group
		$first_level_style_group = coney_qodef_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'first_level_style_group',
				'title' => esc_html__('1st Level Style', 'coney'),
				'description' => esc_html__('Define styles for 1st level in Fullscreen Menu', 'coney')
			)
		);

		$first_level_style_row1 = coney_qodef_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row1'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color',
				'default_value' => '',
				'label' => esc_html__('Text Color', 'coney'),
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color',
				'default_value' => '',
				'label' => esc_html__('Hover Text Color', 'coney'),
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_active_color',
				'default_value' => '',
				'label' => esc_html__('Active Text Color', 'coney'),
			)
		);

		$first_level_style_row3 = coney_qodef_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row3'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts',
				'default_value' => '-1',
				'label' => esc_html__('Font Family', 'coney'),
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_font_size',
				'default_value' => '',
				'label' => esc_html__('Font Size', 'coney'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_line_height',
				'default_value' => '',
				'label' => esc_html__('Line Height', 'coney'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$first_level_style_row4 = coney_qodef_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row4'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_style',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'coney'),
				'options' => coney_qodef_get_font_style_array()
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_weight',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'coney'),
				'options' => coney_qodef_get_font_weight_array()
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letter_spacing',
				'default_value' => '',
				'label' => esc_html__('Lettert Spacing', 'coney'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_text_transform',
				'default_value' => '',
				'label' => esc_html__('Text Transform', 'coney'),
				'options' => coney_qodef_get_text_transform_array()
			)
		);

		//2nd level style group
		$second_level_style_group = coney_qodef_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'second_level_style_group',
				'title' => esc_html__('2nd Level Style', 'coney'),
				'description' => esc_html__('Define styles for 2nd level in Fullscreen Menu', 'coney')
			)
		);

		$second_level_style_row1 = coney_qodef_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row1'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color_2nd',
				'default_value' => '',
				'label' => esc_html__('Text Color', 'coney'),
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color_2nd',
				'default_value' => '',
				'label' => esc_html__('Hover/Active Text Color', 'coney'),
			)
		);

		$second_level_style_row2 = coney_qodef_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row2'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts_2nd',
				'default_value' => '-1',
				'label' => esc_html__('Font Family', 'coney'),
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_font_size_2nd',
				'default_value' => '',
				'label' => esc_html__('Font Size', 'coney'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_line_height_2nd',
				'default_value' => '',
				'label' => esc_html__('Line Height', 'coney'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_style_row3 = coney_qodef_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row3'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_style_2nd',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'coney'),
				'options' => coney_qodef_get_font_style_array()
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_weight_2nd',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'coney'),
				'options' => coney_qodef_get_font_weight_array()
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letter_spacing_2nd',
				'default_value' => '',
				'label' => esc_html__('Lettert Spacing', 'coney'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_text_transform_2nd',
				'default_value' => '',
				'label' => esc_html__('Text Transform', 'coney'),
				'options' => coney_qodef_get_text_transform_array()
			)
		);

		$third_level_style_group = coney_qodef_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'third_level_style_group',
				'title' => esc_html__('3rd Level Style', 'coney'),
				'description' => esc_html__('Define styles for 3rd level in Fullscreen Menu', 'coney')
			)
		);

		$third_level_style_row1 = coney_qodef_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'third_level_style_row1'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color_3rd',
				'default_value' => '',
				'label' => esc_html__('Text Color', 'coney'),
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color_3rd',
				'default_value' => '',
				'label' => esc_html__('Hover/Active Text Color', 'coney'),
			)
		);

		$third_level_style_row2 = coney_qodef_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'second_level_style_row2'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts_3rd',
				'default_value' => '-1',
				'label' => esc_html__('Font Family', 'coney'),
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_font_size_3rd',
				'default_value' => '',
				'label' => esc_html__('Font Size', 'coney'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_line_height_3rd',
				'default_value' => '',
				'label' => esc_html__('Line Height', 'coney'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_style_row3 = coney_qodef_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'second_level_style_row3'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_style_3rd',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'coney'),
				'options' => coney_qodef_get_font_style_array()
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_weight_3rd',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'coney'),
				'options' => coney_qodef_get_font_weight_array()
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letter_spacing_3rd',
				'default_value' => '',
				'label' => esc_html__('Lettert Spacing', 'coney'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_text_transform_3rd',
				'default_value' => '',
				'label' => esc_html__('Text Transform', 'coney'),
				'options' => coney_qodef_get_text_transform_array()
			)
		);

		$icon_colors_group = coney_qodef_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'fullscreen_menu_icon_colors_group',
				'title' => esc_html__('Full Screen Menu Icon Style', 'coney'),
				'description' => esc_html__('Define styles for Fullscreen Menu Icon', 'coney')
			)
		);

		$icon_colors_row1 = coney_qodef_add_admin_row(
			array(
				'parent' => $icon_colors_group,
				'name' => 'icon_colors_row1'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_color',
				'label' => esc_html__('Color', 'coney'),
			)
		);
		
		coney_qodef_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_hover_color',
				'label' => esc_html__('Hover Color', 'coney'),
			)
		);
	}

	add_action('coney_qodef_options_map', 'coney_qodef_fullscreen_menu_options_map', 17);
}