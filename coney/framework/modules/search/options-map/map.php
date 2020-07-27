<?php

if ( ! function_exists('coney_qodef_search_options_map') ) {

	function coney_qodef_search_options_map() {

		coney_qodef_add_admin_page(
			array(
				'slug' => '_search_page',
				'title' => esc_html__('Search', 'coney'),
				'icon' => 'fa fa-search'
			)
		);

		$search_page_panel = coney_qodef_add_admin_panel(
			array(
				'title' => esc_html__('Search Page', 'coney'),
				'name' => 'search_template',
				'page' => '_search_page'
			)
		);

		coney_qodef_add_admin_field(array(
			'name'        => 'search_page_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'coney'),
            'description' 	=> esc_html__("Choose a sidebar layout for search page", 'coney'),
            'default_value' => 'no-sidebar',
            'options'       => array(
                'no-sidebar'        => esc_html__('No Sidebar', 'coney'),
                'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'coney'),
                'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'coney'),
                'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'coney'),
                'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'coney')
            ),
			'parent'      => $search_page_panel
		));

        $coney_custom_sidebars = coney_qodef_get_custom_sidebars();
        if(count($coney_custom_sidebars) > 0) {
            coney_qodef_add_admin_field(array(
                'name' => 'search_custom_sidebar_area',
                'type' => 'selectblank',
                'label' => esc_html__('Sidebar to Display', 'coney'),
                'description' => esc_html__('Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'coney'),
                'parent' => $search_page_panel,
                'options' => $coney_custom_sidebars
            ));
        }

		$search_panel = coney_qodef_add_admin_panel(
			array(
				'title' => esc_html__('Search', 'coney'),
				'name' => 'search',
				'page' => '_search_page'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'select',
				'name'			=> 'search_type',
				'default_value'	=> 'fullscreen',
				'label' 		=> esc_html__('Select Search Type', 'coney'),
				'description' 	=> esc_html__("Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with Vertical Header)", 'coney'),
				'options' 		=> array(
					'fullscreen' => esc_html__('Fullscreen Search', 'coney'),
					'slide-from-header-bottom' => esc_html__('Slide From Header Bottom', 'coney'),
                    'slide-from-icon' => esc_html__('Slide From Icon' , 'coney')
				)
			)
		);
		
		coney_qodef_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'select',
				'name'			=> 'search_icon_pack',
				'default_value'	=> 'font_elegant',
				'label'			=> esc_html__('Search Icon Pack', 'coney'),
				'description'	=> esc_html__('Choose icon pack for search icon', 'coney'),
				'options'		=> coney_qodef_icon_collections()->getIconCollectionsExclude(array('linea_icons'))
			)
		);

        coney_qodef_add_admin_field(
            array(
                'parent'		=> $search_panel,
                'type'			=> 'yesno',
                'name'			=> 'search_in_grid',
                'default_value'	=> 'yes',
                'label'			=> esc_html__('Enable Grid Layout', 'coney'),
                'description'	=> esc_html__('Set search area to be in grid. (Applied for Search covers header and Slide from Window Top types.', 'coney'),
            )
        );
		
		coney_qodef_add_admin_section_title(
			array(
				'parent' 	=> $search_panel,
				'name'		=> 'initial_header_icon_title',
				'title'		=> esc_html__('Initial Search Icon in Header', 'coney')
			)
		);
		
		coney_qodef_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'text',
				'name'			=> 'header_search_icon_size',
				'default_value'	=> '',
				'label'			=> esc_html__('Icon Size', 'coney'),
				'description'	=> esc_html__('Set size for icon', 'coney'),
				'args'			=> array(
					'col_width' => 3,
					'suffix'	=> 'px'
				)
			)
		);
		
		$search_icon_color_group = coney_qodef_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title'		=> esc_html__('Icon Colors', 'coney'),
				'description' => esc_html__('Define color style for icon', 'coney'),
				'name'		=> 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = coney_qodef_add_admin_row(
			array(
				'parent'	=> $search_icon_color_group,
				'name'		=> 'search_icon_color_row'
			)
		);
		
		coney_qodef_add_admin_field(
			array(
				'parent'	=> $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_search_icon_color',
				'label'		=> esc_html__('Color', 'coney')
			)
		);
		
		coney_qodef_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_search_icon_hover_color',
				'label'		=> esc_html__('Hover Color', 'coney')
			)
		);
	}

	add_action('coney_qodef_options_map', 'coney_qodef_search_options_map', 16);
}