<?php

if ( ! function_exists('coney_qodef_footer_options_map') ) {
	/**
	 * Add footer options
	 */
	function coney_qodef_footer_options_map() {

		coney_qodef_add_admin_page(
			array(
				'slug' => '_footer_page',
				'title' => esc_html__('Footer', 'coney'),
				'icon' => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = coney_qodef_add_admin_panel(
			array(
				'title' => esc_html__('Footer', 'coney'),
				'name' => 'footer',
				'page' => '_footer_page'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'footer_in_grid',
				'default_value' => 'yes',
				'label' => esc_html__('Footer in Grid', 'coney'),
				'description' => esc_html__('Enabling this option will place Footer content in grid', 'coney'),
				'parent' => $footer_panel,
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_top',
				'default_value' => 'yes',
				'label' => esc_html__('Show Footer Top', 'coney'),
				'description' => esc_html__('Enabling this option will show Footer Top area', 'coney'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_show_footer_top_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_top_container = coney_qodef_add_admin_container(
			array(
				'name' => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);


		coney_qodef_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_type',
				'default_value' => '',
				'label' => esc_html__('Footer Top Type', 'coney'),
				'description' => esc_html__('Choose a Footer Top type', 'coney'),
				'options' => array(
					'' 	=> esc_html__('Footer Top Standard', 'coney'),
					'simple' 	=> esc_html__('Footer Top Simple', 'coney'),
				),
				'parent' => $show_footer_top_container,
				'args' => array(
					'dependence' => true,
					'show' => array(
						'footer_top_standard' => '#qodef_show_footer_top_standard_container',
						'footer_top_simple'   => ''
					),
					'hide' => array(
						'footer_top_standard' => '',
						'footer_top_simple'   => '#qodef_show_footer_top_standard_container',
					)
				)
			)
		);

		coney_qodef_add_admin_field(array(
			'name' => 'footer_top_background_color',
			'type' => 'color',
			'label' => esc_html__('Background Color', 'coney'),
			'description' => esc_html__('Set background color for top footer area', 'coney'),
			'parent' => $show_footer_top_container
		));

		$show_footer_top_standard_container = coney_qodef_add_admin_container(
			array(
				'name' => 'show_footer_top_standard_container',
				'hidden_property' => 'footer_top_type',
				'hidden_value' => 'footer_top_simple',
				'parent' => $show_footer_top_container
			)
		);


		coney_qodef_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns',
				'default_value' => '4',
				'label' => esc_html__('Footer Top Columns', 'coney'),
				'description' => esc_html__('Choose number of columns for Footer Top area', 'coney'),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				),
				'parent' => $show_footer_top_standard_container,
				'args' => array(
					'dependence' => true,
					'show' => array(
						'1' => '',
						'2' => '',
						'3' => '#qodef_footer_top_three_columns_container',
						'4' => '',
					),
					'hide' => array(
						'1' => '#qodef_footer_top_three_columns_container',
						'2' => '#qodef_footer_top_three_columns_container',
						'3' => '',
						'4' => '#qodef_footer_top_three_columns_container',
					)
				)
			)
		);

		$footer_top_three_columns_container = coney_qodef_add_admin_container(array(
			'name' => 'footer_top_three_columns_container',
			'parent' => $show_footer_top_standard_container,
			'hidden_property' => 'footer_top_columns',
			'hidden_values' => array('1','2','4')
		));

		coney_qodef_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_three_columns_layout',
				'default_value' => '33-33-33',
				'label' => esc_html__('Footer Top Three Columns Layout', 'coney'),
				'description' => esc_html__('Choose Three Columns Layout', 'coney'),
				'options' => array(
					'33-33-33' => esc_html__('33%-33%-33%', 'coney'),
					'25-25-50' => esc_html__('25%-25%-50%', 'coney'),
					'50-25-25' => esc_html__('50%-25%-25%', 'coney')
				),
				'parent' => $footer_top_three_columns_container
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label' => esc_html__('Footer Top Columns Alignment', 'coney'),
				'description' => esc_html__('Text Alignment in Footer Columns', 'coney'),
				'options' => array(
					'left' => esc_html__('Left', 'coney'),
					'center' => esc_html__('Center', 'coney'),
					'right' => esc_html__('Right', 'coney')
				),
				'parent' => $show_footer_top_standard_container,
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_bottom',
				'default_value' => 'yes',
				'label' => esc_html__('Show Footer Bottom', 'coney'),
				'description' => esc_html__('Enabling this option will show Footer Bottom area', 'coney'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_show_footer_bottom_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_bottom_container = coney_qodef_add_admin_container(
			array(
				'name' => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_bottom_columns',
				'default_value' => '4',
				'label' => esc_html__('Footer Bottom Columns', 'coney'),
				'description' => esc_html__('Choose number of columns for Footer Bottom area', 'coney'),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				'parent' => $show_footer_bottom_container,
			)
		);

		coney_qodef_add_admin_field(array(
			'name' => 'footer_bottom_background_color',
			'type' => 'color',
			'label' => esc_html__('Background Color', 'coney'),
			'description' => esc_html__('Set background color for bottom footer area', 'coney'),
			'parent' => $show_footer_bottom_container
		));

		coney_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'enable_footer_bottom_border_top',
				'default_value' => 'yes',
				'label' => esc_html__('Enable Border Top', 'coney'),
				'description' => esc_html__('Enabling this option will show Footer Bottom Border Top', 'coney'),
				'parent' => $show_footer_bottom_container,
			)
		);
	}

	add_action( 'coney_qodef_options_map', 'coney_qodef_footer_options_map', 11);
}