<?php

if ( ! function_exists('coney_qodef_reset_options_map') ) {
	/**
	 * Reset options panel
	 */
	function coney_qodef_reset_options_map() {

		coney_qodef_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__('Reset', 'coney'),
				'icon'  => 'fa fa-retweet'
			)
		);

		$panel_reset = coney_qodef_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__('Reset', 'coney')
			)
		);

		coney_qodef_add_admin_field(array(
			'type'	=> 'yesno',
			'name'	=> 'reset_to_defaults',
			'default_value'	=> 'no',
			'label'			=> esc_html__('Reset to Defaults', 'coney'),
			'description'	=> esc_html__('This option will reset all Select Options values to defaults', 'coney'),
			'parent'		=> $panel_reset
		));
	}

	add_action( 'coney_qodef_options_map', 'coney_qodef_reset_options_map', 100 );
}