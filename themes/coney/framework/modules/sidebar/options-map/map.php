<?php

if ( ! function_exists('coney_qodef_sidebar_options_map') ) {

	function coney_qodef_sidebar_options_map() {

		coney_qodef_add_admin_page(
			array(
				'slug' => '_sidebar_page',
				'title' => esc_html__('Sidebar Area', 'coney'),
				'icon' => 'fa fa-indent'
			)
		);

		$sidebar_panel = coney_qodef_add_admin_panel(
			array(
				'title' => esc_html__('Sidebar Area', 'coney'),
				'name' => 'sidebar',
				'page' => '_sidebar_page'
			)
		);
		
		coney_qodef_add_admin_field(array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__('Sidebar Layout', 'coney'),
			'description'   => esc_html__('Choose a sidebar layout for pages', 'coney'),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
			'options'       => array(
				'no-sidebar'        => esc_html__('No Sidebar', 'coney'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'coney'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'coney'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'coney'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'coney')
			)
		));
		
		$coney_custom_sidebars = coney_qodef_get_custom_sidebars();
		if(count($coney_custom_sidebars) > 0) {
			coney_qodef_add_admin_field(array(
				'name' => 'custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display', 'coney'),
				'description' => esc_html__('Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'coney'),
				'parent' => $sidebar_panel,
				'options' => $coney_custom_sidebars
			));
		}
	}

	add_action('coney_qodef_options_map', 'coney_qodef_sidebar_options_map', 9);
}