<?php

if ( ! function_exists('coney_qodef_logo_options_map') ) {

	function coney_qodef_logo_options_map() {

		coney_qodef_add_admin_page(
			array(
				'slug' => '_logo_page',
				'title' => esc_html__('Logo', 'coney'),
				'icon' => 'fa fa-coffee'
			)
		);

		$panel_logo = coney_qodef_add_admin_panel(
			array(
				'page' => '_logo_page',
				'name' => 'panel_logo',
				'title' => esc_html__('Logo', 'coney')
			)
		);

		coney_qodef_add_admin_field(
			array(
				'parent' => $panel_logo,
				'type' => 'yesno',
				'name' => 'hide_logo',
				'default_value' => 'no',
				'label' => esc_html__('Hide Logo', 'coney'),
				'description' => esc_html__('Enabling this option will hide logo image', 'coney'),
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#qodef_hide_logo_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$hide_logo_container = coney_qodef_add_admin_container(
			array(
				'parent' => $panel_logo,
				'name' => 'hide_logo_container',
				'hidden_property' => 'hide_logo',
				'hidden_value' => 'yes'
			)
		);

		coney_qodef_add_admin_field(
			array(
				'name' => 'logo_image',
				'type' => 'image',
				'default_value' => QODE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Default', 'coney'),
				'parent' => $hide_logo_container
			)
		);

		coney_qodef_add_admin_field(
			array(
				'name' => 'logo_image_dark',
				'type' => 'image',
				'default_value' => QODE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Dark', 'coney'),
				'parent' => $hide_logo_container
			)
		);

		coney_qodef_add_admin_field(
			array(
				'name' => 'logo_image_light',
				'type' => 'image',
				'default_value' => QODE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Light', 'coney'),
				'parent' => $hide_logo_container
			)
		);

		coney_qodef_add_admin_field(
			array(
				'name' => 'logo_image_classic_header',
				'type' => 'image',
				'default_value' => QODE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Centered Header', 'coney'),
				'parent' => $hide_logo_container
			)
		);

		coney_qodef_add_admin_field(
			array(
				'name' => 'logo_image_divided_header',
				'type' => 'image',
				'default_value' => QODE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Divided Header', 'coney'),
				'parent' => $hide_logo_container
			)
		);

		coney_qodef_add_admin_field(
			array(
				'name' => 'logo_image_vertical_header',
				'type' => 'image',
				'default_value' => QODE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Vertical Header', 'coney'),
				'parent' => $hide_logo_container
			)
		);

		coney_qodef_add_admin_field(
			array(
				'name' => 'logo_image_sticky',
				'type' => 'image',
				'default_value' => QODE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Sticky', 'coney'),
				'parent' => $hide_logo_container
			)
		);

		coney_qodef_add_admin_field(
			array(
				'name' => 'logo_image_mobile',
				'type' => 'image',
				'default_value' => QODE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Mobile', 'coney'),
				'parent' => $hide_logo_container
			)
		);
	}

	add_action( 'coney_qodef_options_map', 'coney_qodef_logo_options_map', 2);
}