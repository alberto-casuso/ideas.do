<?php

if ( ! function_exists('coney_qodef_sidearea_options_map') ) {

	function coney_qodef_sidearea_options_map() {

		coney_qodef_add_admin_page(
			array(
				'slug' => '_side_area_page',
				'title' => esc_html__('Side Area', 'coney'),
				'icon' => 'fa fa-indent'
			)
		);

		$side_area_panel = coney_qodef_add_admin_panel(
			array(
				'title' => esc_html__('Side Area', 'coney'),
				'name' => 'side_area',
				'page' => '_side_area_page'
			)
		);

		$side_area_icon_style_group = coney_qodef_add_admin_group(
			array(
				'parent' => $side_area_panel,
				'name' => 'side_area_icon_style_group',
				'title' => esc_html__('Side Area Icon Style', 'coney'),
				'description' => esc_html__('Define styles for Side Area icon', 'coney')
			)
		);

		$side_area_icon_style_row1 = coney_qodef_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row1'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_color',
				'label' => esc_html__('Color', 'coney')
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_hover_color',
				'label' => esc_html__('Hover Color', 'coney')
			)
		);

		$side_area_icon_style_row2 = coney_qodef_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row2',
				'next'		=> true
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type' => 'colorsimple',
				'name' => 'side_area_close_icon_color',
				'label' => esc_html__('Close Icon Color', 'coney')
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type' => 'colorsimple',
				'name' => 'side_area_close_icon_hover_color',
				'label' => esc_html__('Close Icon Hover Color', 'coney')
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_width',
				'default_value' => '',
				'label' => esc_html__('Side Area Width', 'coney'),
				'description' => esc_html__('Enter a width for Side Area', 'coney'),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'color',
				'name' => 'side_area_background_color',
				'label' => esc_html__('Background Color', 'coney'),
				'description' => esc_html__('Choose a background color for Side Area', 'coney')
			)
		);
		
		coney_qodef_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_padding',
				'label' => esc_html__('Padding', 'coney'),
				'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'coney'),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'selectblank',
				'name' => 'side_area_aligment',
				'default_value' => '',
				'label' => esc_html__('Text Alignment', 'coney'),
				'description' => esc_html__('Choose text alignment for side area', 'coney'),
				'options' => array(
					'' => esc_html__('Default', 'coney'),
					'left' => esc_html__('Left', 'coney'),
					'center' => esc_html__('Center', 'coney'),
					'right' => esc_html__('Right', 'coney')
				)
			)
		);
	}

	add_action('coney_qodef_options_map', 'coney_qodef_sidearea_options_map', 15);
}