<?php

if ( ! function_exists('coney_qodef_portfolio_options_map') ) {
	function coney_qodef_portfolio_options_map() {

		coney_qodef_add_admin_page(array(
			'slug'  => '_portfolio',
			'title' => esc_html__('Portfolio', 'coney'),
			'icon'  => 'fa fa-camera-retro'
		));

		$panel_archive = coney_qodef_add_admin_panel(array(
			'title' => esc_html__('Portfolio Archive', 'coney'),
			'name'  => 'panel_portfolio_archive',
			'page'  => '_portfolio'
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'portfolio_archive_number_of_items',
			'type'        => 'text',
			'label'       => esc_html__('Number of Items', 'coney'),
			'description' => esc_html__('Set number of items for your portfolio list on archive pages. Default value is 12', 'coney'),
			'parent'      => $panel_archive,
			'args'        => array(
				'col_width' => 3
			)
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'portfolio_archive_number_of_columns',
			'type'        => 'select',
			'label'       => esc_html__('Number of Columns', 'coney'),
			'default_value' => '4',
			'description' => esc_html__('Set number of columns for your portfolio list on archive pages. Default value is 4 columns', 'coney'),
			'parent'      => $panel_archive,
			'options'     => array(
				'2' => esc_html__('2 Columns', 'coney'),
				'3' => esc_html__('3 Columns', 'coney'),
				'4' => esc_html__('4 Columns', 'coney'),
				'5' => esc_html__('5 Columns', 'coney')
			)
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'portfolio_archive_space_between_items',
			'type'        => 'select',
			'label'       => esc_html__('Space Between Items', 'coney'),
			'default_value' => 'normal',
			'description' => esc_html__('Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'coney'),
			'parent'      => $panel_archive,
			'options'     => array(
				'normal'    => esc_html__('Normal', 'coney'),
				'small'     => esc_html__('Small', 'coney'),
				'tiny'      => esc_html__('Tiny', 'coney'),
				'no'        => esc_html__('No Space', 'coney')
			)
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'portfolio_archive_image_size',
			'type'        => 'select',
			'label'       => esc_html__('Image Proportions', 'coney'),
			'default_value' => 'landscape',
			'description' => esc_html__('Set image proportions for your portfolio list on archive pages. Default value is landscape', 'coney'),
			'parent'      => $panel_archive,
			'options'     => array(
				'full'      => esc_html__('Original', 'coney'),
				'landscape' => esc_html__('Landscape', 'coney'),
				'portrait'  => esc_html__('Portrait', 'coney'),
				'square'    => esc_html__('Square', 'coney')
			)
		));
		
		coney_qodef_add_admin_field(array(
			'name'        => 'portfolio_archive_item_layout',
			'type'        => 'select',
			'label'       => esc_html__('Item Style', 'coney'),
			'default_value' => 'standard-shader',
			'description' => esc_html__('Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'coney'),
			'parent'      => $panel_archive,
			'options'     => array(
				'standard-shader' => esc_html__('Info Bellow', 'coney'),
				'gallery-overlay' => esc_html__('Info on Hover', 'coney')
			)
		));

		$panel = coney_qodef_add_admin_panel(array(
			'title' => esc_html__('Portfolio Single', 'coney'),
			'name'  => 'panel_portfolio_single',
			'page'  => '_portfolio'
		));

		coney_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_template',
			'type'          => 'select',
			'label'         => esc_html__('Portfolio Type', 'coney'),
			'default_value'	=> 'small-images',
			'description'   => esc_html__('Choose a default type for Single Project pages', 'coney'),
			'parent'        => $panel,
			'options'       => array(
				'images'            => esc_html__('Portfolio Images', 'coney'),
				'small-images'      => esc_html__('Portfolio Small Images', 'coney'),
				'slider'            => esc_html__('Portfolio Slider', 'coney'),
				'small-slider'      => esc_html__('Portfolio Small Slider', 'coney'),
				'gallery'           => esc_html__('Portfolio Gallery', 'coney'),
				'custom'            => esc_html__('Portfolio Custom', 'coney'),
				'full-width-custom' => esc_html__('Portfolio Full Width Custom', 'coney')
			),
			'args' => array(
				'dependence' => true,
				'show' => array(
					'images'            => '',
					'small-images'      => '',
					'slider'            => '',
					'small-slider'      => '',
					'gallery'           => '#qodef_portfolio_gallery_container',
					'custom'            => '',
					'full-width-custom' => ''
				),
				'hide' => array(
					'images'            => '#qodef_portfolio_gallery_container',
					'small-images'      => '#qodef_portfolio_gallery_container',
					'slider'            => '#qodef_portfolio_gallery_container',
					'small-slider'      => '#qodef_portfolio_gallery_container',
					'gallery'           => '',
					'custom'            => '#qodef_portfolio_gallery_container',
					'full-width-custom' => '#qodef_portfolio_gallery_container'
				)
			)
		));
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = coney_qodef_add_admin_container(array(
			'parent'          => $panel,
			'name'            => 'portfolio_gallery_container',
			'hidden_property' => 'portfolio_single_template',
			'hidden_values' => array(
				'images',
				'small-images',
				'slider',
				'small-slider',
				'custom',
				'full-width-custom'
			)
		));
		
			coney_qodef_add_admin_field(array(
				'name'        => 'portfolio_single_gallery_columns_number',
				'type'        => 'select',
				'label'       => esc_html__('Number of Columns', 'coney'),
				'default_value' => 'three',
				'description' => esc_html__('Set number of columns for portfolio gallery type', 'coney'),
				'parent'      => $portfolio_gallery_container,
				'options'     => array(
					'two'   => esc_html__('2 Columns', 'coney'),
					'three' => esc_html__('3 Columns', 'coney'),
					'four'  => esc_html__('4 Columns', 'coney')
				)
			));
		
			coney_qodef_add_admin_field(array(
				'name'        => 'portfolio_single_gallery_space_between_items',
				'type'        => 'select',
				'label'       => esc_html__('Space Between Items', 'coney'),
				'default_value' => 'normal',
				'description' => esc_html__('Set space size between columns for portfolio gallery type', 'coney'),
				'parent'      => $portfolio_gallery_container,
				'options'     => array(
					'normal'    => esc_html__('Normal', 'coney'),
					'small'     => esc_html__('Small', 'coney'),
					'tiny'      => esc_html__('Tiny', 'coney'),
					'no'        => esc_html__('No Space', 'coney')
				)
			));
		
		/***************** Gallery Layout *****************/
		
		coney_qodef_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'       => esc_html__('Show Title Area', 'coney'),
				'description' => esc_html__('Enabling this option will show title area on single projects', 'coney'),
				'parent'      => $panel,
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

		coney_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_images',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Lightbox for Images', 'coney'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for projects with images', 'coney'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		coney_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_videos',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Lightbox for Videos', 'coney'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'coney'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		coney_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_enable_categories',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Categories', 'coney'),
			'description'   => esc_html__('Enabling this option will enable category meta description on single projects', 'coney'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		coney_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_hide_date',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Date', 'coney'),
			'description'   => esc_html__('Enabling this option will enable date meta on single projects', 'coney'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));
		
		coney_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_sticky_sidebar',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Sticky Side Text', 'coney'),
			'description'   => esc_html__('Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'coney'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		coney_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments', 'coney'),
			'description'   => esc_html__('Enabling this option will show comments on your page', 'coney'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		coney_qodef_add_admin_field(array(
			'name'          => 'portfolio_single_hide_pagination',
			'type'          => 'yesno',
			'label'         => esc_html__('Hide Pagination', 'coney'),
			'description'   => esc_html__('Enabling this option will turn off portfolio pagination functionality', 'coney'),
			'parent'        => $panel,
			'default_value' => 'no',
			'args' => array(
				'dependence' => true,
				'dependence_hide_on_yes' => '#qodef_navigate_same_category_container'
			)
		));

			$container_navigate_category = coney_qodef_add_admin_container(array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'hidden_property' => 'portfolio_single_hide_pagination',
				'hidden_value'    => 'yes'
			));
	
				coney_qodef_add_admin_field(array(
					'name'            => 'portfolio_single_nav_same_category',
					'type'            => 'yesno',
					'label'           => esc_html__('Enable Pagination Through Same Category', 'coney'),
					'description'     => esc_html__('Enabling this option will make portfolio pagination sort through current category', 'coney'),
					'parent'          => $container_navigate_category,
					'default_value'   => 'no'
				));

		coney_qodef_add_admin_field(array(
			'name'        => 'portfolio_single_slug',
			'type'        => 'text',
			'label'       => esc_html__('Portfolio Single Slug', 'coney'),
			'description' => esc_html__('Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'coney'),
			'parent'      => $panel,
			'args'        => array(
				'col_width' => 3
			)
		));
	}

	add_action( 'coney_qodef_options_map', 'coney_qodef_portfolio_options_map', 14);
}