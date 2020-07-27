<?php

if ( ! function_exists('coney_qodef_woocommerce_options_map') ) {

	/**
	 * Add Woocommerce options page
	 */
	function coney_qodef_woocommerce_options_map() {

		coney_qodef_add_admin_page(
			array(
				'slug' => '_woocommerce_page',
				'title' => esc_html__('Woocommerce', 'coney'),
				'icon' => 'fa fa-shopping-cart'
			)
		);

		/**
		 * Product List Settings
		 */
		$panel_product_list = coney_qodef_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_product_list',
				'title' => esc_html__('Product List', 'coney')
			)
		);

		coney_qodef_add_admin_field(array(
			'name'        	=> 'qodef_woo_product_list_columns',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Product List Columns', 'coney'),
			'default_value'	=> 'qodef-woocommerce-columns-4',
			'description' 	=> esc_html__('Choose number of columns for product listing and related products on single product', 'coney'),
			'options'		=> array(
				'qodef-woocommerce-columns-3' => esc_html__('3 Columns', 'coney'),
				'qodef-woocommerce-columns-4' => esc_html__('4 Columns', 'coney')
			),
			'parent'      	=> $panel_product_list,
		));
		
		coney_qodef_add_admin_field(array(
			'name'        	=> 'qodef_woo_product_list_columns_space',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Space Between Products', 'coney'),
			'default_value'	=> 'qodef-woo-normal-space',
			'description' 	=> esc_html__('Select space between products for product listing and related products on single product', 'coney'),
			'options'		=> array(
				'qodef-woo-normal-space' => esc_html__('Normal', 'coney'),
				'qodef-woo-small-space'  => esc_html__('Small', 'coney'),
				'qodef-woo-no-space'     => esc_html__('No Space', 'coney')
			),
			'parent'      	=> $panel_product_list,
		));

		coney_qodef_add_admin_field(array(
			'name'        	=> 'qodef_woo_products_per_page',
			'type'        	=> 'text',
			'label'       	=> esc_html__('Number of products per page', 'coney'),
			'default_value'	=> '',
			'description' 	=> esc_html__('Set number of products on shop page', 'coney'),
			'parent'      	=> $panel_product_list,
			'args' 			=> array(
				'col_width' => 3
			)
		));

		coney_qodef_add_admin_field(array(
			'name'        	=> 'qodef_products_list_title_tag',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Products Title Tag', 'coney'),
			'default_value'	=> 'h5',
			'description' 	=> '',
			'options'       => coney_qodef_get_title_tag(),
			'parent'      	=> $panel_product_list,
		));

		/**
		 * Single Product Settings
		 */
		$panel_single_product = coney_qodef_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_single_product',
				'title' => esc_html__('Single Product', 'coney')
			)
		);
		
			coney_qodef_add_admin_field(array(
				'name'          => 'woo_enable_single_thumb_featured_switch',
				'type'          => 'yesno',
				'label'         => esc_html__('Switch Featured Image on Thumbnail Click', 'coney'),
				'description'   => esc_html__('Enabling this option will switch featured image with thumbnail image on thumbnail click', 'coney'),
				'default_value' => 'no',
				'parent'        => $panel_single_product
			));
			
			coney_qodef_add_admin_field(array(
				'name'          => 'woo_set_thumb_images_position',
				'type'          => 'select',
				'label'         => esc_html__('Set Thumbnail Images Position', 'coney'),
				'default_value' => 'below-image',
				'options'		=> array(
					'below-image'  => esc_html__('Below Featured Image', 'coney'),
					'on-left-side' => esc_html__('On The Left Side Of Featured Image', 'coney')
				),
				'parent'        => $panel_single_product
			));

			coney_qodef_add_admin_field(array(
				'name'        	=> 'qodef_single_product_title_tag',
				'type'        	=> 'select',
				'label'       	=> esc_html__('Single Product Title Tag', 'coney'),
				'default_value'	=> 'h3',
				'description' 	=> '',
				'options'       => coney_qodef_get_title_tag(),
				'parent'      	=> $panel_single_product,
			));

            coney_qodef_add_admin_field(
                array(
                    'type' => 'select',
                    'name' => 'show_title_area_woo',
                    'default_value' => '',
                    'label'       => esc_html__('Show Title Area', 'coney'),
                    'description' => esc_html__('Enabling this option will show title area on single post pages', 'coney'),
                    'parent'      => $panel_single_product,
                    'options' => array(
                        '' => esc_html__('Default', 'coney'),
                        'yes' => esc_html__('Yes', 'coney'),
                        'no' => esc_html__('No', 'coney')
                    ),
                    'args' => array(
                        'col_width' => 3
                    )
                )
            );

		/**
		 * DropDown Cart Widget Settings
		 */
		$panel_dropdown_cart = coney_qodef_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_dropdown_cart',
				'title' => esc_html__('Dropdown Cart Widget', 'coney')
			)
		);

			coney_qodef_add_admin_field(array(
				'name'        	=> 'qodef_woo_dropdown_cart_description',
				'type'        	=> 'text',
				'label'       	=> esc_html__('Cart Description', 'coney'),
				'default_value'	=> '',
				'description' 	=> esc_html__('Enter dropdown cart description', 'coney'),
				'parent'      	=> $panel_dropdown_cart
			));
	}

	add_action( 'coney_qodef_options_map', 'coney_qodef_woocommerce_options_map', 21);
}