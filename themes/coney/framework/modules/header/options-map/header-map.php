<?php

if ( ! function_exists('coney_qodef_header_options_map') ) {

	function coney_qodef_header_options_map() {

		coney_qodef_add_admin_page(
			array(
				'slug' => '_header_page',
				'title' => esc_html__('Header', 'coney'),
				'icon' => 'fa fa-header'
			)
		);

		$panel_header = coney_qodef_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header',
				'title' => esc_html__('Header', 'coney')
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'radiogroup',
				'name' => 'header_type',
				'default_value' => 'header-standard',
				'label' => esc_html__('Choose Header Type', 'coney'),
				'description' => esc_html__('Select the type of header you would like to use', 'coney'),
				'options' => array(
					'header-standard' => array(
						'image' => QODE_FRAMEWORK_ADMIN_ASSETS_ROOT.'/img/header-standard.png'
					),
					'header-classic' => array(
						'image' => QODE_FRAMEWORK_ADMIN_ASSETS_ROOT.'/img/header-classic.png'
					),
					'header-divided' => array(
						'image' => QODE_FRAMEWORK_ADMIN_ASSETS_ROOT.'/img/header-divided.png'
					),
                    'header-full-screen' => array(
                        'image' => QODE_FRAMEWORK_ADMIN_ASSETS_ROOT.'/img/header-full-screen.png'
                    ),
					'header-vertical' => array(
						'image' => QODE_FRAMEWORK_ADMIN_ASSETS_ROOT.'/img/header-vertical.png'
					)
				),
				'args' => array(
					'use_images' => true,
					'hide_labels' => true,
					'dependence' => true,
					'show' => array(
						'header-standard' => '#qodef_panel_header_standard,#qodef_header_behaviour,#qodef_panel_fixed_header,#qodef_panel_sticky_header,#qodef_panel_main_menu',
						'header-classic' => '#qodef_panel_header_classic,#qodef_header_behaviour,#qodef_panel_fixed_header,#qodef_panel_sticky_header,#qodef_panel_main_menu',
						'header-divided' => '#qodef_panel_header_divided,#qodef_header_behaviour,#qodef_panel_fixed_header,#qodef_panel_sticky_header,#qodef_panel_main_menu',
						'header-full-screen' => '#qodef_panel_header_full_screen',
						'header-vertical' => '#qodef_panel_header_vertical,#qodef_panel_vertical_main_menu'
					),
					'hide' => array(
						'header-standard' => '#qodef_panel_header_classic,#qodef_panel_header_divided,#qodef_panel_header_full_screen,#qodef_panel_header_vertical,#qodef_panel_vertical_main_menu',
						'header-classic' => '#qodef_panel_header_standard,#qodef_panel_header_divided,#qodef_panel_header_full_screen,#qodef_panel_header_vertical,#qodef_panel_vertical_main_menu',
						'header-divided' => '#qodef_panel_header_standard,#qodef_panel_header_classic,#qodef_panel_header_full_screen,#qodef_panel_header_vertical,#qodef_panel_vertical_main_menu',
						'header-full-screen' => '#qodef_panel_header_standard,#qodef_panel_header_classic,#qodef_panel_header_divided,#qodef_panel_header_vertical,#qodef_panel_vertical_main_menu,#qodef_panel_main_menu,#qodef_header_behaviour,#qodef_panel_fixed_header,#qodef_panel_sticky_header',
						'header-vertical' => '#qodef_panel_header_standard,#qodef_panel_header_classic,#qodef_panel_header_divided,#qodef_panel_header_full_screen,#qodef_header_behaviour,#qodef_panel_fixed_header,#qodef_panel_sticky_header,#qodef_panel_main_menu'
					)
				)
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'select',
				'name' => 'header_behaviour',
				'default_value' => 'fixed-on-scroll',
				'label' => esc_html__('Choose Header Behaviour', 'coney'),
				'description' => esc_html__('Select the behaviour of header when you scroll down to page', 'coney'),
				'options' => array(
					'sticky-header-on-scroll-up' => esc_html__('Sticky on scroll up', 'coney'),
					'sticky-header-on-scroll-down-up' => esc_html__('Sticky on scroll up/down', 'coney'),
					'fixed-on-scroll' => esc_html__('Fixed on scroll', 'coney')
				),
				'args' => array(
					'dependence' => true,
					'show' => array(
						'sticky-header-on-scroll-up' => '#qodef_panel_sticky_header',
						'sticky-header-on-scroll-down-up' => '#qodef_panel_sticky_header',
						'fixed-on-scroll' => '#qodef_panel_fixed_header'
					),
					'hide' => array(
						'sticky-header-on-scroll-up' => '#qodef_panel_fixed_header',
						'sticky-header-on-scroll-down-up' => '#qodef_panel_fixed_header',
						'fixed-on-scroll' => '#qodef_panel_sticky_header'
					)
				),
                'hidden_property' => 'header_type',
                'hidden_values' => array(
	                'header-full-screen',
	                'header-vertical'
                )
			)
		);

		/***************** Top Header Layout **********************/

			coney_qodef_add_admin_field(
				array(
					'name' => 'top_bar',
					'type' => 'yesno',
					'default_value' => 'no',
					'label' => esc_html__('Top Bar', 'coney'),
					'description' => esc_html__('Enabling this option will show top bar area', 'coney'),
					'parent' => $panel_header,
					'args' => array(
						"dependence" => true,
						"dependence_hide_on_yes" => "",
						"dependence_show_on_yes" => "#qodef_top_bar_container"
					)
				)
			);

			$top_bar_container = coney_qodef_add_admin_container(array(
				'name' => 'top_bar_container',
				'parent' => $panel_header,
				'hidden_property' => 'top_bar',
				'hidden_value' => 'no'
			));

			coney_qodef_add_admin_field(
				array(
					'parent' => $top_bar_container,
					'type' => 'select',
					'name' => 'top_bar_color_skin',
					'default_value' => '',
					'label' => esc_html__('Choose Top Bar Color Skin', 'coney'),
					'options' => array(
						'' => esc_html__('Default', 'coney'),
						'top-dark' => esc_html__('Dark', 'coney'),
						'top-light' => esc_html__('Light', 'coney')
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $top_bar_container,
					'type' => 'select',
					'name' => 'top_bar_layout',
					'default_value' => 'three-columns',
					'label' => esc_html__('Choose Top Bar Layout', 'coney'),
					'description' => esc_html__('Select the layout for top bar', 'coney'),
					'options' => array(
						'two-columns' => esc_html__('Two Columns', 'coney'),
						'three-columns' => esc_html__('Three Columns', 'coney')
					),
					'args' => array(
						"dependence" => true,
						"hide" => array(
							"two-columns" => "#qodef_top_bar_layout_container",
							"three-columns" => ""
						),
						"show" => array(
							"two-columns" => "",
							"three-columns" => "#qodef_top_bar_layout_container"
						)
					)
				)
			);

			$top_bar_layout_container = coney_qodef_add_admin_container(array(
				'name' => 'top_bar_layout_container',
				'parent' => $top_bar_container,
				'hidden_property' => 'top_bar_layout',
				'hidden_values' => array("two-columns"),
			));

			coney_qodef_add_admin_field(
				array(
					'parent' => $top_bar_layout_container,
					'type' => 'select',
					'name' => 'top_bar_column_widths',
					'default_value' => '30-30-30',
					'label' => esc_html__('Choose Column Widths', 'coney'),
					'options' => array(
						'30-30-30' => '33% - 33% - 33%',
						'25-50-25' => '25% - 50% - 25%'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'name' => 'top_bar_in_grid',
					'type' => 'yesno',
					'default_value' => 'no',
					'label' => esc_html__('Enable Grid Layout', 'coney'),
					'description' => esc_html__('Set top bar content to be in grid', 'coney'),
					'parent' => $top_bar_container
				)
			);

			coney_qodef_add_admin_field(array(
				'name' => 'top_bar_background_color',
				'type' => 'color',
				'label' => esc_html__('Background Color', 'coney'),
				'description' => esc_html__('Choose a background color for header area', 'coney'),
				'parent' => $top_bar_container
			));

			coney_qodef_add_admin_field(array(
				'name' => 'top_bar_background_transparency',
				'type' => 'text',
				'label' => esc_html__('Background Transparency', 'coney'),
				'description' => esc_html__('Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'coney'),
				'parent' => $top_bar_container,
				'args' => array('col_width' => 3)
			));

			coney_qodef_add_admin_field(array(
				'name' => 'top_bar_height',
				'type' => 'text',
				'label' => esc_html__('Top Bar Height', 'coney'),
				'description' => esc_html__('Enter top bar height (Default is 42px)', 'coney'),
				'parent' => $top_bar_container,
				'args' => array(
					'col_width' => 2,
					'suffix' => 'px'
				)
			));

		/***************** Top Header Layout **********************/
		
		/***************** Header Skin Options ********************/
		
			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_header,
					'type' => 'select',
					'name' => 'header_style',
					'default_value' => '',
					'label' => esc_html__('Header Skin', 'coney'),
					'description' => esc_html__('Choose a predefined header style for header elements (logo, main menu, side menu opener...)', 'coney'),
					'options' => array(
						'' => esc_html__('Default', 'coney'),
						'light-header' => esc_html__('Light', 'coney'),
						'dark-header' => esc_html__('Dark', 'coney')
					)
				)
			);
		
		/***************** Header Skin Options ********************/
		
		/***************** Header Style **********************/
			
			coney_qodef_add_admin_section_title(
				array(
					'parent' => $panel_header,
					'name' => 'header_area_style',
					'title' => esc_html__('Header Area Style', 'coney')
				)
			);
		
			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_header,
					'type' => 'yesno',
					'name' => 'enable_grid_layout_header',
					'default_value' => 'yes',
					'label' => esc_html__('Enable Grid Layout', 'coney'),
					'description' => esc_html__('Enabling this option you will set header area to be in grid', 'coney'),
				)
			);
			
			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_header,
					'type' => 'color',
					'name' => 'header_area_background_color',
					'default_value' => '',
					'label' => esc_html__('Background Color', 'coney'),
					'description' => esc_html__('Choose a background color for header area', 'coney'),
				)
			);
			
			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_header,
					'type' => 'text',
					'name' => 'header_area_background_transparency',
					'default_value' => '',
					'label' => esc_html__('Background Transparency', 'coney'),
					'description' => esc_html__('Choose a transparency for the header area background color (0 = fully transparent, 1 = opaque)', 'coney'),
					'args' => array(
						'col_width' => 3
					)
				)
			);
			
			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_header,
					'type' => 'color',
					'name' => 'header_area_border_top_color',
					'default_value' => '',
					'label' => esc_html__('Border Top Color', 'coney'),
					'description' => esc_html__('Set border top color for header area. This option doesn\'t work for Vertical header layout', 'coney')
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_header,
					'type' => 'color',
					'name' => 'header_area_border_color',
					'default_value' => '',
					'label' => esc_html__('Border Bottom Color', 'coney'),
					'description' => esc_html__('Set border bottom color for header area. This option doesn\'t work for Vertical header layout', 'coney')
				)
			);

		/***************** Header Style **********************/

		/***************** Standard Header Layout *****************/

			$panel_header_standard = coney_qodef_add_admin_panel(
				array(
					'page' => '_header_page',
					'name' => 'panel_header_standard',
					'title' => esc_html__('Header Standard', 'coney'),
					'hidden_property' => 'header_type',
					'hidden_value' => '',
					'hidden_values' => array(
						'header-classic',
						'header-divided',
	                    'header-full-screen',
						'header-vertical'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_header_standard,
					'type' => 'select',
					'name' => 'set_menu_area_position',
					'default_value' => 'center',
					'label' => esc_html__('Choose Menu Area Position', 'coney'),
					'description' => esc_html__('Select menu area position in your header', 'coney'),
					'options' => array(
						'center' => esc_html__('Center', 'coney'),
						'left' => esc_html__('Left', 'coney'),
						'right' => esc_html__('Right', 'coney')
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_header_standard,
					'type' => 'text',
					'name' => 'menu_area_height_header_standard',
					'default_value' => '',
					'label' => esc_html__('Height', 'coney'),
					'description' => esc_html__('Enter Header Height (default is 80px)', 'coney'),
					'args' => array(
						'col_width' => 3,
						'suffix' => 'px'
					)
				)
			);

		/***************** Standard Header Layout *****************/
		
		/****************** Classic Header Layout *****************/
		
			$panel_header_classic = coney_qodef_add_admin_panel(
				array(
					'page' => '_header_page',
					'name' => 'panel_header_classic',
					'title' => esc_html__('Header Centered', 'coney'),
					'hidden_property' => 'header_type',
					'hidden_value' => '',
					'hidden_values' => array(
						'header-standard',
						'header-divided',
						'header-full-screen',
						'header-vertical'
					)
				)
			);
			
			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_header_classic,
					'type' => 'text',
					'name' => 'logo_area_height_header_classic',
					'default_value' => '',
					'label' => esc_html__('Logo Area Height', 'coney'),
					'description' => esc_html__('Enter Logo Area Height (default is 350px)', 'coney'),
					'args' => array(
						'col_width' => 3,
						'suffix' => 'px'
					)
				)
			);
			
			coney_qodef_add_admin_field(
				array(
					'parent'      => $panel_header_classic,
					'type'        => 'text',
					'name'        => 'logo_area_top_padding_header_classic',
					'label'       => esc_html__('Top Padding For Non-Scrolled Logo', 'coney'),
					'description' => esc_html__('Enter top padding value to move your logo image down in pixels', 'coney'),
					'args'        => array(
						'col_width' => 3,
						'suffix'    => 'px'
					)
				)
			);
			
			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_header_classic,
					'type' => 'text',
					'name' => 'menu_area_height_header_classic',
					'default_value' => '',
					'label' => esc_html__('Menu Area Height', 'coney'),
					'description' => esc_html__('Enter Menu Area Height (default is 80px)', 'coney'),
					'args' => array(
						'col_width' => 3,
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_header_classic,
					'type' => 'text',
					'name' => 'logo_text_header_classic',
					'default_value' => '',
					'label' => esc_html__('Logo Area Text', 'coney'),
					'description' => esc_html__('Enter text under logo for Centered Header type', 'coney'),
					'args' => array(
						'col_width' => 3
					)
				)
			);
		
		/****************** Classic Header Layout ******************/

		/***************** Divided Header Layout *******************/

			$panel_header_divided = coney_qodef_add_admin_panel(
				array(
					'page' => '_header_page',
					'name' => 'panel_header_divided',
					'title' => esc_html__('Header Divided', 'coney'),
					'hidden_property' => 'header_type',
					'hidden_value' => '',
					'hidden_values' => array(
						'header-standard',
						'header-classic',
						'header-full-screen',
						'header-vertical'
					)
				)
			);

			coney_qodef_add_admin_section_title(
				array(
					'parent' => $panel_header_divided,
					'name' => 'header_divided_title',
					'title' => esc_html__('Header Divided', 'coney')
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_header_divided,
					'type' => 'text',
					'name' => 'menu_area_height_header_divided',
					'default_value' => '',
					'label' => esc_html__('Height', 'coney'),
					'description' => esc_html__('Enter Header Height (default is 80px)', 'coney'),
					'args' => array(
						'col_width' => 3,
						'suffix' => 'px'
					)
				)
			);

		/***************** Divided Header Layout *******************/

		/***************** Full Screen Header Layout *******************/

			$panel_header_full_screen = coney_qodef_add_admin_panel(
				array(
					'page' => '_header_page',
					'name' => 'panel_header_full_screen',
					'title' => esc_html__('Header Full Screen', 'coney'),
					'hidden_property' => 'header_type',
					'hidden_value' => '',
					'hidden_values' => array(
	                    'header-standard',
						'header-classic',
						'header-divided',
						'header-vertical'
					)
				)
			);

			coney_qodef_add_admin_section_title(
				array(
					'parent' => $panel_header_full_screen,
					'name' => 'header_full_screen_title',
					'title' => esc_html__('Header Full Screen', 'coney')
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_header_full_screen,
					'type' => 'text',
					'name' => 'menu_area_height_header_full_screen',
					'default_value' => '',
					'label' => esc_html__('Height', 'coney'),
					'description' => esc_html__('Enter Header Height (default is 80px)', 'coney'),
					'args' => array(
						'col_width' => 3,
						'suffix' => 'px'
					)
				)
			);

		/***************** Full Screen Header Layout *******************/

		/***************** Vertical Header Layout *****************/

			$panel_header_vertical = coney_qodef_add_admin_panel(
				array(
					'page' => '_header_page',
					'name' => 'panel_header_vertical',
					'title' => esc_html__('Header Vertical', 'coney'),
					'hidden_property' => 'header_type',
					'hidden_value' => '',
					'hidden_values' => array(
						'header-standard',
						'header-classic',
						'header-divided',
						'header-full-screen'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'name' => 'vertical_header_background_image',
					'type' => 'image',
					'label' => esc_html__('Background Image', 'coney'),
					'description' => esc_html__('Set background image for vertical menu', 'coney'),
					'parent' => $panel_header_vertical
				)
			);

			coney_qodef_add_admin_field(
				array(
					'name' => 'vertical_header_text_align',
					'type' => 'select',
					'default_value' => '',
					'label' => esc_html__('Choose Text Alignment', 'coney'),
					'description' => esc_html__('Choose text alignment for Vertical Header elements (logo, menu and widgets)', 'coney'),
					'parent' => $panel_header_vertical,
					'options' => array(
						'' => esc_html__('Default', 'coney'),
						'left' => esc_html__('Left', 'coney'),
						'center' => esc_html__('Center', 'coney')
					)
				)
			);

		/***************** Vertical Header Layout *****************/

        /***************** Sticky Header Layout *******************/

			$panel_sticky_header = coney_qodef_add_admin_panel(
				array(
					'title' => esc_html__('Sticky Header', 'coney'),
					'name' => 'panel_sticky_header',
					'page' => '_header_page',
					'hidden_property' => 'header_behaviour',
					'hidden_value' => '',
					'hidden_values' => array(
						'fixed-on-scroll'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'name' => 'scroll_amount_for_sticky',
					'type' => 'text',
					'label' => esc_html__('Scroll Amount for Sticky', 'coney'),
					'description' => esc_html__('Enter scroll amount for Sticky Menu to appear (deafult is header height). This value can be overriden on a page level basis', 'coney'),
					'parent' => $panel_sticky_header,
					'args' => array(
						'col_width' => 2,
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'name' => 'sticky_header_in_grid',
					'type' => 'yesno',
					'default_value' => 'no',
					'label' => esc_html__('Sticky Header in Grid', 'coney'),
					'description' => esc_html__('Enabling this option will put sticky header in grid', 'coney'),
					'parent' => $panel_sticky_header,
				)
			);

            coney_qodef_add_admin_field(
                array(
                    'parent' => $panel_sticky_header,
                    'type' => 'select',
                    'name' => 'set_sticky_menu_area_position',
                    'default_value' => 'center',
                    'label' => esc_html__('Choose Sticky Menu Area Position', 'coney'),
                    'description' => esc_html__('Select menu area position in your sticky header', 'coney'),
                    'options' => array(
                        'center' => esc_html__('Center', 'coney'),
                        'left' => esc_html__('Left', 'coney'),
                        'right' => esc_html__('Right', 'coney')
                    )
                )
            );

			coney_qodef_add_admin_field(array(
				'name' => 'sticky_header_background_color',
				'type' => 'color',
				'label' => esc_html__('Background Color', 'coney'),
				'description' => esc_html__('Choose a background color for header area', 'coney'),
				'parent' => $panel_sticky_header
			));

			coney_qodef_add_admin_field(array(
				'name' => 'sticky_header_transparency',
				'type' => 'text',
				'label' => esc_html__('Background Transparency', 'coney'),
				'description' => esc_html__('Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'coney'),
				'parent' => $panel_sticky_header,
				'args' => array(
					'col_width' => 1
				)
			));

			coney_qodef_add_admin_field(array(
				'name' => 'sticky_header_border_color',
				'type' => 'color',
				'label' => esc_html__('Border Color', 'coney'),
				'description' => esc_html__('Set border bottom color for header area', 'coney'),
				'parent' => $panel_sticky_header
			));

			coney_qodef_add_admin_field(array(
				'name' => 'sticky_header_height',
				'type' => 'text',
				'label' => esc_html__('Sticky Header Height', 'coney'),
				'description' => esc_html__('Enter height for sticky header (default is 60px)', 'coney'),
				'parent' => $panel_sticky_header,
				'args' => array(
					'col_width' => 2,
					'suffix' => 'px'
				)
			));

			$group_sticky_header_menu = coney_qodef_add_admin_group(array(
				'title' => esc_html__('Sticky Header Menu', 'coney'),
				'name' => 'group_sticky_header_menu',
				'parent' => $panel_sticky_header,
				'description' => esc_html__('Define styles for sticky menu items', 'coney')
			));

			$row1_sticky_header_menu = coney_qodef_add_admin_row(array(
				'name' => 'row1',
				'parent' => $group_sticky_header_menu
			));

			coney_qodef_add_admin_field(array(
				'name' => 'sticky_color',
				'type' => 'colorsimple',
				'label' => esc_html__('Text Color', 'coney'),
				'description' => '',
				'parent' => $row1_sticky_header_menu
			));

			coney_qodef_add_admin_field(array(
				'name' => 'sticky_hovercolor',
				'type' => 'colorsimple',
				'label' => esc_html__(esc_html__('Hover/Active Color', 'coney'), 'coney'),
				'description' => '',
				'parent' => $row1_sticky_header_menu
			));

			$row2_sticky_header_menu = coney_qodef_add_admin_row(array(
				'name' => 'row2',
				'parent' => $group_sticky_header_menu
			));

			coney_qodef_add_admin_field(
				array(
					'name' => 'sticky_google_fonts',
					'type' => 'fontsimple',
					'label' => esc_html__('Font Family', 'coney'),
					'default_value' => '-1',
					'parent' => $row2_sticky_header_menu,
				)
			);

			coney_qodef_add_admin_field(
				array(
					'type' => 'textsimple',
					'name' => 'sticky_font_size',
					'label' => esc_html__('Font Size', 'coney'),
					'default_value' => '',
					'parent' => $row2_sticky_header_menu,
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'type' => 'textsimple',
					'name' => 'sticky_line_height',
					'label' => esc_html__('Line Height', 'coney'),
					'default_value' => '',
					'parent' => $row2_sticky_header_menu,
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'type' => 'selectblanksimple',
					'name' => 'sticky_text_transform',
					'label' => esc_html__('Text Transform', 'coney'),
					'default_value' => '',
					'options' => coney_qodef_get_text_transform_array(),
					'parent' => $row2_sticky_header_menu
				)
			);

			$row3_sticky_header_menu = coney_qodef_add_admin_row(array(
				'name' => 'row3',
				'parent' => $group_sticky_header_menu
			));

			coney_qodef_add_admin_field(
				array(
					'type' => 'selectblanksimple',
					'name' => 'sticky_font_style',
					'default_value' => '',
					'label' => esc_html__('Font Style', 'coney'),
					'options' => coney_qodef_get_font_style_array(),
					'parent' => $row3_sticky_header_menu
				)
			);

			coney_qodef_add_admin_field(
				array(
					'type' => 'selectblanksimple',
					'name' => 'sticky_font_weight',
					'default_value' => '',
					'label' => esc_html__('Font Weight', 'coney'),
					'options' => coney_qodef_get_font_weight_array(),
					'parent' => $row3_sticky_header_menu
				)
			);

			coney_qodef_add_admin_field(
				array(
					'type' => 'textsimple',
					'name' => 'sticky_letter_spacing',
					'label' => esc_html__('Letter Spacing', 'coney'),
					'default_value' => '',
					'parent' => $row3_sticky_header_menu,
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

		/***************** Sticky Header Layout *******************/	

		/***************** Fixed Header Layout ********************/	

			$panel_fixed_header = coney_qodef_add_admin_panel(
				array(
					'title' => esc_html__('Fixed Header', 'coney'),
					'name' => 'panel_fixed_header',
					'page' => '_header_page',
					'hidden_property' => 'header_behaviour',
					'hidden_value' => '',
					'hidden_values' => array(
						'sticky-header-on-scroll-up',
						'sticky-header-on-scroll-down-up'
					)
				)
			);

			coney_qodef_add_admin_field(array(
				'name' => 'fixed_header_background_color',
				'type' => 'color',
				'default_value' => '',
				'label' => esc_html__('Background Color', 'coney'),
				'description' => esc_html__('Choose a background color for header area', 'coney'),
				'parent' => $panel_fixed_header
			));

			coney_qodef_add_admin_field(array(
				'name' => 'fixed_header_transparency',
				'type' => 'text',
				'label' => esc_html__('Background Transparency', 'coney'),
				'description' => esc_html__('Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'coney'),
				'parent' => $panel_fixed_header,
				'args' => array(
					'col_width' => 1
				)
			));

			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_fixed_header,
					'type' => 'color',
					'name' => 'fixed_header_border_bottom_color',
					'default_value' => '',
					'label' => esc_html__('Border Color', 'coney'),
					'description' => esc_html__('Set border bottom color for header area', 'coney'),
				)
			);

			$group_fixed_header_menu = coney_qodef_add_admin_group(array(
				'title' => esc_html__('Fixed Header Menu', 'coney'),
				'name' => 'group_fixed_header_menu',
				'parent' => $panel_fixed_header,
				'description' => esc_html__('Define styles for fixed menu items', 'coney')
			));

			$row1_fixed_header_menu = coney_qodef_add_admin_row(array(
				'name' => 'row1',
				'parent' => $group_fixed_header_menu
			));

			coney_qodef_add_admin_field(array(
				'name' => 'fixed_color',
				'type' => 'colorsimple',
				'label' => esc_html__('Text Color', 'coney'),
				'description' => '',
				'parent' => $row1_fixed_header_menu
			));

			coney_qodef_add_admin_field(array(
				'name' => 'fixed_hovercolor',
				'type' => 'colorsimple',
				'label' => esc_html__(esc_html__('Hover/Active Color', 'coney'), 'coney'),
				'description' => '',
				'parent' => $row1_fixed_header_menu
			));

			$row2_fixed_header_menu = coney_qodef_add_admin_row(array(
				'name' => 'row2',
				'parent' => $group_fixed_header_menu
			));

			coney_qodef_add_admin_field(
				array(
					'name' => 'fixed_google_fonts',
					'type' => 'fontsimple',
					'label' => esc_html__('Font Family', 'coney'),
					'default_value' => '-1',
					'parent' => $row2_fixed_header_menu,
				)
			);

			coney_qodef_add_admin_field(
				array(
					'type' => 'textsimple',
					'name' => 'fixed_font_size',
					'label' => esc_html__('Font Size', 'coney'),
					'default_value' => '',
					'parent' => $row2_fixed_header_menu,
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'type' => 'textsimple',
					'name' => 'fixed_line_height',
					'label' => esc_html__('Line Height', 'coney'),
					'default_value' => '',
					'parent' => $row2_fixed_header_menu,
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'type' => 'selectblanksimple',
					'name' => 'fixed_text_transform',
					'label' => esc_html__('Text Transform', 'coney'),
					'default_value' => '',
					'options' => coney_qodef_get_text_transform_array(),
					'parent' => $row2_fixed_header_menu
				)
			);

			$row3_fixed_header_menu = coney_qodef_add_admin_row(array(
				'name' => 'row3',
				'parent' => $group_fixed_header_menu
			));

			coney_qodef_add_admin_field(
				array(
					'type' => 'selectblanksimple',
					'name' => 'fixed_font_style',
					'default_value' => '',
					'label' => esc_html__('Font Style', 'coney'),
					'options' => coney_qodef_get_font_style_array(),
					'parent' => $row3_fixed_header_menu
				)
			);

			coney_qodef_add_admin_field(
				array(
					'type' => 'selectblanksimple',
					'name' => 'fixed_font_weight',
					'default_value' => '',
					'label' => esc_html__('Font Weight', 'coney'),
					'options' => coney_qodef_get_font_weight_array(),
					'parent' => $row3_fixed_header_menu
				)
			);

			coney_qodef_add_admin_field(
				array(
					'type' => 'textsimple',
					'name' => 'fixed_letter_spacing',
					'label' => esc_html__('Letter Spacing', 'coney'),
					'default_value' => '',
					'parent' => $row3_fixed_header_menu,
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

		/***************** Fixed Header Layout ********************/	

		/******************* Main Menu Layout *********************/

			$panel_main_menu = coney_qodef_add_admin_panel(
				array(
					'title' => esc_html__('Main Menu', 'coney'),
					'name' => 'panel_main_menu',
					'page' => '_header_page',
					'hidden_property' => 'header_type',
	                'hidden_values' => array(
	                	'header-full-screen',
		                'header-vertical'
	            	)
				)
			);

			coney_qodef_add_admin_section_title(
				array(
					'parent' => $panel_main_menu,
					'name' => 'main_menu_area_title',
					'title' => esc_html__('Main Menu General Settings', 'coney')
				)
			);

			$drop_down_group = coney_qodef_add_admin_group(
				array(
					'parent' => $panel_main_menu,
					'name' => 'drop_down_group',
					'title' => esc_html__('Main Dropdown Menu', 'coney'),
					'description' => esc_html__('Choose a color and transparency for the main menu background (0 = fully transparent, 1 = opaque)', 'coney')
				)
			);

			$drop_down_row1 = coney_qodef_add_admin_row(
				array(
					'parent' => $drop_down_group,
					'name' => 'drop_down_row1',
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $drop_down_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_background_color',
					'default_value' => '',
					'label' => esc_html__('Background Color', 'coney'),
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $drop_down_row1,
					'type' => 'textsimple',
					'name' => 'dropdown_background_transparency',
					'default_value' => '',
					'label' => esc_html__('Background Transparency', 'coney'),
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_main_menu,
					'type' => 'select',
					'name' => 'menu_dropdown_appearance',
					'default_value' => 'dropdown-animate-height',
					'label' => esc_html__('Main Dropdown Menu Appearance', 'coney'),
					'description' => esc_html__('Choose appearance for dropdown menu', 'coney'),
					'options' => array(
						'dropdown-default' => esc_html__('Default', 'coney'),
						'dropdown-animate-height' => esc_html__('Animate Height', 'coney')
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent'        => $panel_main_menu,
					'type'          => 'yesno',
					'name'          => 'enable_wide_menu_background',
					'default_value' => 'no',
					'label'         => esc_html__('Enable Full Width Background for Wide Dropdown Type', 'coney'),
					'description'   => esc_html__('Enabling this option will show full width background  for wide dropdown type', 'coney')
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $panel_main_menu,
					'type' => 'text',
					'name' => 'dropdown_top_position',
					'default_value' => '',
					'label' => esc_html__('Dropdown Position', 'coney'),
					'description' => esc_html__('Enter value in percentage of entire header height', 'coney'),
					'args' => array(
						'col_width' => 3,
						'suffix' => '%'
					)
				)
			);

			$first_level_group = coney_qodef_add_admin_group(
				array(
					'parent' => $panel_main_menu,
					'name' => 'first_level_group',
					'title' => esc_html__('1st Level Menu', 'coney'),
					'description' => esc_html__('Define styles for 1st level in Top Navigation Menu', 'coney')
				)
			);

			$first_level_row1 = coney_qodef_add_admin_row(
				array(
					'parent' => $first_level_group,
					'name' => 'first_level_row1'
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row1,
					'type' => 'colorsimple',
					'name' => 'menu_color',
					'default_value' => '',
					'label' => esc_html__('Text Color', 'coney'),
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row1,
					'type' => 'colorsimple',
					'name' => 'menu_hovercolor',
					'default_value' => '',
					'label' => esc_html__('Hover Text Color', 'coney'),
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row1,
					'type' => 'colorsimple',
					'name' => 'menu_activecolor',
					'default_value' => '',
					'label' => esc_html__('Active Text Color', 'coney'),
				)
			);

			$first_level_row3 = coney_qodef_add_admin_row(
				array(
					'parent' => $first_level_group,
					'name' => 'first_level_row3',
					'next' => true
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row3,
					'type' => 'colorsimple',
					'name' => 'menu_light_hovercolor',
					'default_value' => '',
					'label' => esc_html__('Light Menu Hover Text Color', 'coney'),
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row3,
					'type' => 'colorsimple',
					'name' => 'menu_light_activecolor',
					'default_value' => '',
					'label' => esc_html__('Light Menu Active Text Color', 'coney'),
				)
			);

			$first_level_row4 = coney_qodef_add_admin_row(
				array(
					'parent' => $first_level_group,
					'name' => 'first_level_row4',
					'next' => true
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row4,
					'type' => 'colorsimple',
					'name' => 'menu_dark_hovercolor',
					'default_value' => '',
					'label' => esc_html__('Dark Menu Hover Text Color', 'coney'),
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row4,
					'type' => 'colorsimple',
					'name' => 'menu_dark_activecolor',
					'default_value' => '',
					'label' => esc_html__('Dark Menu Active Text Color', 'coney'),
				)
			);

			$first_level_row5 = coney_qodef_add_admin_row(
				array(
					'parent' => $first_level_group,
					'name' => 'first_level_row5',
					'next' => true
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row5,
					'type' => 'fontsimple',
					'name' => 'menu_google_fonts',
					'default_value' => '-1',
					'label' => esc_html__('Font Family', 'coney'),
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row5,
					'type' => 'textsimple',
					'name' => 'menu_font_size',
					'default_value' => '',
					'label' => esc_html__('Font Size', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row5,
					'type' => 'textsimple',
					'name' => 'menu_line_height',
					'default_value' => '',
					'label' => esc_html__('Line Height', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			$first_level_row6 = coney_qodef_add_admin_row(
				array(
					'parent' => $first_level_group,
					'name' => 'first_level_row6',
					'next' => true
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row6,
					'type' => 'selectblanksimple',
					'name' => 'menu_font_style',
					'default_value' => '',
					'label' => esc_html__('Font Style', 'coney'),
					'options' => coney_qodef_get_font_style_array()
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row6,
					'type' => 'selectblanksimple',
					'name' => 'menu_font_weight',
					'default_value' => '',
					'label' => esc_html__('Font Weight', 'coney'),
					'options' => coney_qodef_get_font_weight_array()
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row6,
					'type' => 'textsimple',
					'name' => 'menu_letter_spacing',
					'default_value' => '',
					'label' => esc_html__('Letter Spacing', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row6,
					'type' => 'selectblanksimple',
					'name' => 'menu_text_transform',
					'default_value' => '',
					'label' => esc_html__('Text Transform', 'coney'),
					'options' => coney_qodef_get_text_transform_array()
				)
			);

			$first_level_row7 = coney_qodef_add_admin_row(
				array(
					'parent' => $first_level_group,
					'name' => 'first_level_row7',
					'next' => true
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row7,
					'type' => 'textsimple',
					'name' => 'menu_padding_left_right',
					'default_value' => '',
					'label' => esc_html__('Padding Left/Right', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $first_level_row7,
					'type' => 'textsimple',
					'name' => 'menu_margin_left_right',
					'default_value' => '',
					'label' => esc_html__('Margin Left/Right', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			$second_level_group = coney_qodef_add_admin_group(
				array(
					'parent' => $panel_main_menu,
					'name' => 'second_level_group',
					'title' => esc_html__('2nd Level Menu', 'coney'),
					'description' => esc_html__('Define styles for 2nd level in Top Navigation Menu', 'coney')
				)
			);

			$second_level_row1 = coney_qodef_add_admin_row(
				array(
					'parent' => $second_level_group,
					'name' => 'second_level_row1'
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_color',
					'default_value' => '',
					'label' => esc_html__('Text Color', 'coney')
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_hovercolor',
					'default_value' => '',
					'label' => esc_html__('Hover/Active Color', 'coney')
				)
			);

			$second_level_row2 = coney_qodef_add_admin_row(
				array(
					'parent' => $second_level_group,
					'name' => 'second_level_row2',
					'next' => true
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_row2,
					'type' => 'fontsimple',
					'name' => 'dropdown_google_fonts',
					'default_value' => '-1',
					'label' => esc_html__('Font Family', 'coney')
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_font_size',
					'default_value' => '',
					'label' => esc_html__('Font Size', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_line_height',
					'default_value' => '',
					'label' => esc_html__('Line Height', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			$second_level_row3 = coney_qodef_add_admin_row(
				array(
					'parent' => $second_level_group,
					'name' => 'second_level_row3',
					'next' => true
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_font_style',
					'default_value' => '',
					'label' => esc_html__('Font Style', 'coney'),
					'options' => coney_qodef_get_font_style_array()
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_font_weight',
					'default_value' => '',
					'label' => esc_html__('Font Weight', 'coney'),
					'options' => coney_qodef_get_font_weight_array()
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_row3,
					'type' => 'textsimple',
					'name' => 'dropdown_letter_spacing',
					'default_value' => '',
					'label' => esc_html__('Letter Spacing', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_text_transform',
					'default_value' => '',
					'label' => esc_html__('Text Transform', 'coney'),
					'options' => coney_qodef_get_text_transform_array()
				)
			);

			$second_level_wide_group = coney_qodef_add_admin_group(
				array(
					'parent' => $panel_main_menu,
					'name' => 'second_level_wide_group',
					'title' => esc_html__('2nd Level Wide Menu', 'coney'),
					'description' => esc_html__('Define styles for 2nd level in Wide Menu', 'coney')
				)
			);

			$second_level_wide_row1 = coney_qodef_add_admin_row(
				array(
					'parent' => $second_level_wide_group,
					'name' => 'second_level_wide_row1'
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_wide_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_wide_color',
					'default_value' => '',
					'label' => esc_html__('Text Color', 'coney')
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_wide_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_wide_hovercolor',
					'default_value' => '',
					'label' => esc_html__('Hover/Active Color', 'coney')
				)
			);

			$second_level_wide_row2 = coney_qodef_add_admin_row(
				array(
					'parent' => $second_level_wide_group,
					'name' => 'second_level_wide_row2',
					'next' => true
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_wide_row2,
					'type' => 'fontsimple',
					'name' => 'dropdown_wide_google_fonts',
					'default_value' => '-1',
					'label' => esc_html__('Font Family', 'coney')
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_wide_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_wide_font_size',
					'default_value' => '',
					'label' => esc_html__('Font Size', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_wide_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_wide_line_height',
					'default_value' => '',
					'label' => esc_html__('Line Height', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			$second_level_wide_row3 = coney_qodef_add_admin_row(
				array(
					'parent' => $second_level_wide_group,
					'name' => 'second_level_wide_row3',
					'next' => true
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_wide_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_wide_font_style',
					'default_value' => '',
					'label' => esc_html__('Font Style', 'coney'),
					'options' => coney_qodef_get_font_style_array()
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_wide_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_wide_font_weight',
					'default_value' => '',
					'label' => esc_html__('Font Weight', 'coney'),
					'options' => coney_qodef_get_font_weight_array()
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_wide_row3,
					'type' => 'textsimple',
					'name' => 'dropdown_wide_letter_spacing',
					'default_value' => '',
					'label' => esc_html__('Letter Spacing', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $second_level_wide_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_wide_text_transform',
					'default_value' => '',
					'label' => esc_html__('Text Transform', 'coney'),
					'options' => coney_qodef_get_text_transform_array()
				)
			);

			$third_level_group = coney_qodef_add_admin_group(
				array(
					'parent' => $panel_main_menu,
					'name' => 'third_level_group',
					'title' => esc_html__('3nd Level Menu', 'coney'),
					'description' => esc_html__('Define styles for 3nd level in Top Navigation Menu', 'coney')
				)
			);

			$third_level_row1 = coney_qodef_add_admin_row(
				array(
					'parent' => $third_level_group,
					'name' => 'third_level_row1'
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_color_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Text Color', 'coney')
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_hovercolor_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Hover/Active Color', 'coney')
				)
			);

			$third_level_row2 = coney_qodef_add_admin_row(
				array(
					'parent' => $third_level_group,
					'name' => 'third_level_row2',
					'next' => true
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_row2,
					'type' => 'fontsimple',
					'name' => 'dropdown_google_fonts_thirdlvl',
					'default_value' => '-1',
					'label' => esc_html__('Font Family', 'coney')
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_font_size_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Font Size', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_line_height_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Line Height', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			$third_level_row3 = coney_qodef_add_admin_row(
				array(
					'parent' => $third_level_group,
					'name' => 'third_level_row3',
					'next' => true
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_font_style_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Font Style', 'coney'),
					'options' => coney_qodef_get_font_style_array()
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_font_weight_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Font Weight', 'coney'),
					'options' => coney_qodef_get_font_weight_array()
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_row3,
					'type' => 'textsimple',
					'name' => 'dropdown_letter_spacing_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Letter Spacing', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_text_transform_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Text Transform', 'coney'),
					'options' => coney_qodef_get_text_transform_array()
				)
			);

			$third_level_wide_group = coney_qodef_add_admin_group(
				array(
					'parent' => $panel_main_menu,
					'name' => 'third_level_wide_group',
					'title' => esc_html__('3rd Level Wide Menu', 'coney'),
					'description' => esc_html__('Define styles for 3rd level in Wide Menu', 'coney')
				)
			);

			$third_level_wide_row1 = coney_qodef_add_admin_row(
				array(
					'parent' => $third_level_wide_group,
					'name' => 'third_level_wide_row1'
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_wide_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_wide_color_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Text Color', 'coney')
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_wide_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_wide_hovercolor_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Hover/Active Color', 'coney')
				)
			);

			$third_level_wide_row2 = coney_qodef_add_admin_row(
				array(
					'parent' => $third_level_wide_group,
					'name' => 'third_level_wide_row2',
					'next' => true
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_wide_row2,
					'type' => 'fontsimple',
					'name' => 'dropdown_wide_google_fonts_thirdlvl',
					'default_value' => '-1',
					'label' => esc_html__('Font Family', 'coney')
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_wide_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_wide_font_size_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Font Size', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_wide_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_wide_line_height_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Line Height', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			$third_level_wide_row3 = coney_qodef_add_admin_row(
				array(
					'parent' => $third_level_wide_group,
					'name' => 'third_level_wide_row3',
					'next' => true
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_wide_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_wide_font_style_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Font Style', 'coney'),
					'options' => coney_qodef_get_font_style_array()
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_wide_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_wide_font_weight_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Font Weight', 'coney'),
					'options' => coney_qodef_get_font_weight_array()
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_wide_row3,
					'type' => 'textsimple',
					'name' => 'dropdown_wide_letter_spacing_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Letter Spacing', 'coney'),
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			coney_qodef_add_admin_field(
				array(
					'parent' => $third_level_wide_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_wide_text_transform_thirdlvl',
					'default_value' => '',
					'label' => esc_html__('Text Transform', 'coney'),
					'options' => coney_qodef_get_text_transform_array()
				)
			);

        /******************* Main Menu Layout *********************/

		/****************** Vertical Main Menu Layout ********************/

			$panel_vertical_main_menu = coney_qodef_add_admin_panel(
				array(
					'title' => esc_html__('Vertical Main Menu', 'coney'),
					'name' => 'panel_vertical_main_menu',
					'page' => '_header_page',
					'hidden_property' => 'header_type',
					'hidden_values' => array(
						'header-standard',
						'header-classic',
						'header-divided',
						'header-full-screen'
					)
				)
			);

			$drop_down_group = coney_qodef_add_admin_group(
				array(
					'parent' => $panel_vertical_main_menu,
					'name' => 'vertical_drop_down_group',
					'title' => esc_html__('Main Dropdown Menu', 'coney'),
					'description' => esc_html__('Set a style for dropdown menu', 'coney')
				)
			);

			$vertical_drop_down_row1 = coney_qodef_add_admin_row(
				array(
					'parent' => $drop_down_group,
					'name' => 'qodef_drop_down_row1',
				)
			);

			coney_qodef_add_admin_field(array(
				'type'			=> 'textsimple',
				'name'			=> 'vertical_menu_top_margin',
				'default_value'	=> '',
				'label'			=> esc_html__('Top Margin', 'coney'),
				'args'			=> array(
					'suffix'	=> 'px'
				),
				'parent'		=> $vertical_drop_down_row1
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'textsimple',
				'name'			=> 'vertical_menu_bottom_margin',
				'default_value'	=> '',
				'label'			=> esc_html__('Bottom Margin', 'coney'),
				'args'			=> array(
					'suffix'	=> 'px'
				),
				'parent'		=> $vertical_drop_down_row1
			));

			$group_vertical_first_level = coney_qodef_add_admin_group(array(
				'name'			=> 'group_vertical_first_level',
				'title'			=> esc_html__('1st level', 'coney'),
				'description'	=> esc_html__('Define styles for 1st level menu', 'coney'),
				'parent'		=> $panel_vertical_main_menu
			));

			$row_vertical_first_level_1 = coney_qodef_add_admin_row(array(
				'name'		=> 'row_vertical_first_level_1',
				'parent'	=> $group_vertical_first_level
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'colorsimple',
				'name'			=> 'vertical_menu_1st_color',
				'default_value'	=> '',
				'label'			=> esc_html__('Text Color', 'coney'),
				'parent'		=> $row_vertical_first_level_1
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'colorsimple',
				'name'			=> 'vertical_menu_1st_hover_color',
				'default_value'	=> '',
				'label'			=> esc_html__('Hover/Active Color', 'coney'),
				'parent'		=> $row_vertical_first_level_1
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'textsimple',
				'name'			=> 'vertical_menu_1st_font_size',
				'default_value'	=> '',
				'label'			=> esc_html__('Font Size', 'coney'),
				'args'			=> array(
					'suffix'	=> 'px'
				),
				'parent'		=> $row_vertical_first_level_1
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'textsimple',
				'name'			=> 'vertical_menu_1st_line_height',
				'default_value'	=> '',
				'label'			=> esc_html__('Line Height', 'coney'),
				'args'			=> array(
					'suffix'	=> 'px'
				),
				'parent'		=> $row_vertical_first_level_1
			));

			$row_vertical_first_level_2 = coney_qodef_add_admin_row(array(
				'name'		=> 'row_vertical_first_level_2',
				'parent'	=> $group_vertical_first_level,
				'next'		=> true
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'selectblanksimple',
				'name'			=> 'vertical_menu_1st_text_transform',
				'default_value'	=> '',
				'label'			=> esc_html__('Text Transform', 'coney'),
				'options'		=> coney_qodef_get_text_transform_array(),
				'parent'		=> $row_vertical_first_level_2
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'fontsimple',
				'name'			=> 'vertical_menu_1st_google_fonts',
				'default_value'	=> '-1',
				'label'			=> esc_html__('Font Family', 'coney'),
				'parent'		=> $row_vertical_first_level_2
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'selectblanksimple',
				'name'			=> 'vertical_menu_1st_font_style',
				'default_value'	=> '',
				'label'			=> esc_html__('Font Style', 'coney'),
				'options'		=> coney_qodef_get_font_style_array(),
				'parent'		=> $row_vertical_first_level_2
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'selectblanksimple',
				'name'			=> 'vertical_menu_1st_font_weight',
				'default_value'	=> '',
				'label'			=> esc_html__('Font Weight', 'coney'),
				'options'		=> coney_qodef_get_font_weight_array(),
				'parent'		=> $row_vertical_first_level_2
			));

			$row_vertical_first_level_3 = coney_qodef_add_admin_row(array(
				'name'		=> 'row_vertical_first_level_3',
				'parent'	=> $group_vertical_first_level,
				'next'		=> true
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'textsimple',
				'name'			=> 'vertical_menu_1st_letter_spacing',
				'default_value'	=> '',
				'label'			=> esc_html__('Letter Spacing', 'coney'),
				'args'			=> array(
					'suffix'	=> 'px'
				),
				'parent'		=> $row_vertical_first_level_3
			));

			$group_vertical_second_level = coney_qodef_add_admin_group(array(
				'name'			=> 'group_vertical_second_level',
				'title'			=> esc_html__('2nd level', 'coney'),
				'description'	=> esc_html__('Define styles for 2nd level menu', 'coney'),
				'parent'		=> $panel_vertical_main_menu
			));

			$row_vertical_second_level_1 = coney_qodef_add_admin_row(array(
				'name'		=> 'row_vertical_second_level_1',
				'parent'	=> $group_vertical_second_level
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'colorsimple',
				'name'			=> 'vertical_menu_2nd_color',
				'default_value'	=> '',
				'label'			=> esc_html__('Text Color', 'coney'),
				'parent'		=> $row_vertical_second_level_1
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'colorsimple',
				'name'			=> 'vertical_menu_2nd_hover_color',
				'default_value'	=> '',
				'label'			=> esc_html__('Hover/Active Color', 'coney'),
				'parent'		=> $row_vertical_second_level_1
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'textsimple',
				'name'			=> 'vertical_menu_2nd_font_size',
				'default_value'	=> '',
				'label'			=> esc_html__('Font Size', 'coney'),
				'args'			=> array(
					'suffix'	=> 'px'
				),
				'parent'		=> $row_vertical_second_level_1
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'textsimple',
				'name'			=> 'vertical_menu_2nd_line_height',
				'default_value'	=> '',
				'label'			=> esc_html__('Line Height', 'coney'),
				'args'			=> array(
					'suffix'	=> 'px'
				),
				'parent'		=> $row_vertical_second_level_1
			));

			$row_vertical_second_level_2 = coney_qodef_add_admin_row(array(
				'name'		=> 'row_vertical_second_level_2',
				'parent'	=> $group_vertical_second_level,
				'next'		=> true
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'selectblanksimple',
				'name'			=> 'vertical_menu_2nd_text_transform',
				'default_value'	=> '',
				'label'			=> esc_html__('Text Transform', 'coney'),
				'options'		=> coney_qodef_get_text_transform_array(),
				'parent'		=> $row_vertical_second_level_2
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'fontsimple',
				'name'			=> 'vertical_menu_2nd_google_fonts',
				'default_value'	=> '-1',
				'label'			=> esc_html__('Font Family', 'coney'),
				'parent'		=> $row_vertical_second_level_2
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'selectblanksimple',
				'name'			=> 'vertical_menu_2nd_font_style',
				'default_value'	=> '',
				'label'			=> esc_html__('Font Style', 'coney'),
				'options'		=> coney_qodef_get_font_style_array(),
				'parent'		=> $row_vertical_second_level_2
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'selectblanksimple',
				'name'			=> 'vertical_menu_2nd_font_weight',
				'default_value'	=> '',
				'label'			=> esc_html__('Font Weight', 'coney'),
				'options'		=> coney_qodef_get_font_weight_array(),
				'parent'		=> $row_vertical_second_level_2
			));

			$row_vertical_second_level_3 = coney_qodef_add_admin_row(array(
				'name'		=> 'row_vertical_second_level_3',
				'parent'	=> $group_vertical_second_level,
				'next'		=> true
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'textsimple',
				'name'			=> 'vertical_menu_2nd_letter_spacing',
				'default_value'	=> '',
				'label'			=> esc_html__('Letter Spacing', 'coney'),
				'args'			=> array(
					'suffix'	=> 'px'
				),
				'parent'		=> $row_vertical_second_level_3
			));

			$group_vertical_third_level = coney_qodef_add_admin_group(array(
				'name'			=> 'group_vertical_third_level',
				'title'			=> esc_html__('3rd level', 'coney'),
				'description'	=> esc_html__('Define styles for 3rd level menu', 'coney'),
				'parent'		=> $panel_vertical_main_menu
			));

			$row_vertical_third_level_1 = coney_qodef_add_admin_row(array(
				'name'		=> 'row_vertical_third_level_1',
				'parent'	=> $group_vertical_third_level
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'colorsimple',
				'name'			=> 'vertical_menu_3rd_color',
				'default_value'	=> '',
				'label'			=> esc_html__('Text Color', 'coney'),
				'parent'		=> $row_vertical_third_level_1
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'colorsimple',
				'name'			=> 'vertical_menu_3rd_hover_color',
				'default_value'	=> '',
				'label'			=> esc_html__('Hover/Active Color', 'coney'),
				'parent'		=> $row_vertical_third_level_1
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'textsimple',
				'name'			=> 'vertical_menu_3rd_font_size',
				'default_value'	=> '',
				'label'			=> esc_html__('Font Size', 'coney'),
				'args'			=> array(
					'suffix'	=> 'px'
				),
				'parent'		=> $row_vertical_third_level_1
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'textsimple',
				'name'			=> 'vertical_menu_3rd_line_height',
				'default_value'	=> '',
				'label'			=> esc_html__('Line Height', 'coney'),
				'args'			=> array(
					'suffix'	=> 'px'
				),
				'parent'		=> $row_vertical_third_level_1
			));

			$row_vertical_third_level_2 = coney_qodef_add_admin_row(array(
				'name'		=> 'row_vertical_third_level_2',
				'parent'	=> $group_vertical_third_level,
				'next'		=> true
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'selectblanksimple',
				'name'			=> 'vertical_menu_3rd_text_transform',
				'default_value'	=> '',
				'label'			=> esc_html__('Text Transform', 'coney'),
				'options'		=> coney_qodef_get_text_transform_array(),
				'parent'		=> $row_vertical_third_level_2
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'fontsimple',
				'name'			=> 'vertical_menu_3rd_google_fonts',
				'default_value'	=> '-1',
				'label'			=> esc_html__('Font Family', 'coney'),
				'parent'		=> $row_vertical_third_level_2
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'selectblanksimple',
				'name'			=> 'vertical_menu_3rd_font_style',
				'default_value'	=> '',
				'label'			=> esc_html__('Font Style', 'coney'),
				'options'		=> coney_qodef_get_font_style_array(),
				'parent'		=> $row_vertical_third_level_2
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'selectblanksimple',
				'name'			=> 'vertical_menu_3rd_font_weight',
				'default_value'	=> '',
				'label'			=> esc_html__('Font Weight', 'coney'),
				'options'		=> coney_qodef_get_font_weight_array(),
				'parent'		=> $row_vertical_third_level_2
			));

			$row_vertical_third_level_3 = coney_qodef_add_admin_row(array(
				'name'		=> 'row_vertical_third_level_3',
				'parent'	=> $group_vertical_third_level,
				'next'		=> true
			));

			coney_qodef_add_admin_field(array(
				'type'			=> 'textsimple',
				'name'			=> 'vertical_menu_3rd_letter_spacing',
				'default_value'	=> '',
				'label'			=> esc_html__('Letter Spacing', 'coney'),
				'args'			=> array(
					'suffix'	=> 'px'
				),
				'parent'		=> $row_vertical_third_level_3
			));

		/****************** Vertical Main Menu Layout ********************/

	}

	add_action( 'coney_qodef_options_map', 'coney_qodef_header_options_map', 4);
}