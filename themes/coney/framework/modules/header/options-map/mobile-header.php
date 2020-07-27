<?php

if ( ! function_exists('coney_qodef_mobile_header_options_map') ) {

	function coney_qodef_mobile_header_options_map() {

		coney_qodef_add_admin_page(array(
			'slug'  => '_mobile_header',
			'title' => esc_html__('Mobile Header', 'coney'),
			'icon'  => 'fa fa-mobile'
		));

		$panel_mobile_header = coney_qodef_add_admin_panel(array(
			'title' => esc_html__('Mobile Header', 'coney'),
			'name'  => 'panel_mobile_header',
			'page'  => '_mobile_header'
		));
		
		$mobile_header_group = coney_qodef_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'mobile_header_group',
				'title' => esc_html__('Mobile Header Styles', 'coney')
			)
		);
		
		$mobile_header_row1 = coney_qodef_add_admin_row(
			array(
				'parent' => $mobile_header_group,
				'name' => 'mobile_header_row1'
			)
		);

			coney_qodef_add_admin_field(array(
				'name'        => 'mobile_header_height',
				'type'        => 'textsimple',
				'label'       => esc_html__('Height', 'coney'),
				'parent'      => $mobile_header_row1,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			));
	
			coney_qodef_add_admin_field(array(
				'name'        => 'mobile_header_background_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Background Color', 'coney'),
				'parent'      => $mobile_header_row1
			));
	
			coney_qodef_add_admin_field(array(
				'name'        => 'mobile_header_border_bottom_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Border Bottom Color', 'coney'),
				'parent'      => $mobile_header_row1
			));
		
		$mobile_menu_group = coney_qodef_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'mobile_menu_group',
				'title' => esc_html__('Mobile Menu Styles', 'coney')
			)
		);
		
		$mobile_menu_row1 = coney_qodef_add_admin_row(
			array(
				'parent' => $mobile_menu_group,
				'name' => 'mobile_menu_row1'
			)
		);

			coney_qodef_add_admin_field(array(
				'name'        => 'mobile_menu_background_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Background Color', 'coney'),
				'parent'      => $mobile_menu_row1
			));
	
			coney_qodef_add_admin_field(array(
				'name'        => 'mobile_menu_border_bottom_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Border Bottom Color', 'coney'),
				'parent'      => $mobile_menu_row1
			));
	
			coney_qodef_add_admin_field(array(
				'name'        => 'mobile_menu_separator_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Menu Item Separator Color', 'coney'),
				'parent'      => $mobile_menu_row1
			));
		
		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_logo_height',
			'type'        => 'text',
			'label'       => esc_html__('Logo Height For Mobile Header', 'coney'),
			'description' => esc_html__('Define logo height for screen size smaller than 1024px', 'coney'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));
		
		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_logo_height_phones',
			'type'        => 'text',
			'label'       => esc_html__('Logo Height For Mobile Devices', 'coney'),
			'description' => esc_html__('Define logo height for screen size smaller than 480px', 'coney'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		coney_qodef_add_admin_section_title(array(
			'parent' => $panel_mobile_header,
			'name'   => 'mobile_header_fonts_title',
			'title'  => esc_html__('Typography', 'coney')
		));

		$first_level_group = coney_qodef_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'first_level_group',
				'title' => esc_html__('1st Level Menu', 'coney'),
				'description' => esc_html__('Define styles for 1st level in Mobile Menu Navigation', 'coney')
			)
		);

		$first_level_row1 = coney_qodef_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row1'
			)
		);

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_text_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Text Color', 'coney'),
			'parent'      => $first_level_row1
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_text_hover_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Hover/Active Text Color', 'coney'),
			'parent'      => $first_level_row1
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_google_fonts',
			'type'        => 'fontsimple',
			'label'       => esc_html__('Font Family', 'coney'),
			'parent'      => $first_level_row1
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_font_size',
			'type'        => 'textsimple',
			'label'       => esc_html__('Font Size', 'coney'),
			'parent'      => $first_level_row1,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		$first_level_row2 = coney_qodef_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row2'
			)
		);

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_line_height',
			'type'        => 'textsimple',
			'label'       => esc_html__('Line Height', 'coney'),
			'parent'      => $first_level_row2,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_text_transform',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Text Transform', 'coney'),
			'parent'      => $first_level_row2,
			'options'     => coney_qodef_get_text_transform_array()
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_font_style',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Style', 'coney'),
			'parent'      => $first_level_row2,
			'options'     => coney_qodef_get_font_style_array()
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_font_weight',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Weight', 'coney'),
			'parent'      => $first_level_row2,
			'options'     => coney_qodef_get_font_weight_array()
		));
		
		$first_level_row3 = coney_qodef_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row3'
			)
		);
		
		coney_qodef_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'mobile_letter_spacing',
				'label' => esc_html__('Letter Spacing', 'coney'),
				'default_value' => '',
				'parent' => $first_level_row3,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_group = coney_qodef_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'second_level_group',
				'title' => esc_html__('Dropdown Menu', 'coney'),
				'description' => esc_html__('Define styles for drop down menu items in Mobile Menu Navigation', 'coney')
			)
		);

		$second_level_row1 = coney_qodef_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row1'
			)
		);

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Text Color', 'coney'),
			'parent'      => $second_level_row1
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_hover_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Hover/Active Text Color', 'coney'),
			'parent'      => $second_level_row1
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_dropdown_google_fonts',
			'type'        => 'fontsimple',
			'label'       => esc_html__('Font Family', 'coney'),
			'parent'      => $second_level_row1
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_size',
			'type'        => 'textsimple',
			'label'       => esc_html__('Font Size', 'coney'),
			'parent'      => $second_level_row1,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		$second_level_row2 = coney_qodef_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row2'
			)
		);

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_dropdown_line_height',
			'type'        => 'textsimple',
			'label'       => esc_html__('Line Height', 'coney'),
			'parent'      => $second_level_row2,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_transform',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Text Transform', 'coney'),
			'parent'      => $second_level_row2,
			'options'     => coney_qodef_get_text_transform_array()
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_style',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Style', 'coney'),
			'parent'      => $second_level_row2,
			'options'     => coney_qodef_get_font_style_array()
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_weight',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Weight', 'coney'),
			'parent'      => $second_level_row2,
			'options'     => coney_qodef_get_font_weight_array()
		));
		
		$second_level_row3 = coney_qodef_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row3'
			)
		);
		
		coney_qodef_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'mobile_dropdown_letter_spacing',
				'label' => esc_html__('Letter Spacing', 'coney'),
				'default_value' => '',
				'parent' => $second_level_row3,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		coney_qodef_add_admin_section_title(array(
			'name' => 'mobile_opener_panel',
			'parent' => $panel_mobile_header,
			'title' => esc_html__('Mobile Menu Opener', 'coney')
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_menu_title',
			'type'        => 'text',
			'label'       => esc_html__('Mobile Navigation Title', 'coney'),
			'description' => esc_html__('Enter title for mobile menu navigation', 'coney'),
			'parent'      => $panel_mobile_header,
			'default_value' => esc_html__('Menu', 'coney'),
			'args' => array(
				'col_width' => 3
			)
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_icon_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Navigation Icon Color', 'coney'),
			'parent'      => $panel_mobile_header
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'mobile_icon_hover_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Navigation Icon Hover Color', 'coney'),
			'parent'      => $panel_mobile_header
		));
	}

	add_action( 'coney_qodef_options_map', 'coney_qodef_mobile_header_options_map', 5);
}