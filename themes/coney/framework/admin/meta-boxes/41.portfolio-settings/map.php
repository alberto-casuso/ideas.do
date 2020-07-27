<?php

if(!function_exists('coney_qodef_map_portfolio_settings_meta')) {
    function coney_qodef_map_portfolio_settings_meta() {
        $meta_box = coney_qodef_create_meta_box(array(
            'scope' => 'portfolio-item',
            'title' => esc_html__('Portfolio Settings', 'coney'),
            'name'  => 'portfolio_settings_meta_box'
        ));

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_portfolio_single_template_meta',
            'type'        => 'select',
            'label'       => esc_html__('Portfolio Type', 'coney'),
            'description' => esc_html__('Choose a default type for Single Project pages', 'coney'),
            'parent'      => $meta_box,
            'options'     => array(
                ''                  => esc_html__('Default', 'coney'),
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
		            ''                  => '',
		            'images'            => '',
		            'small-images'      => '',
		            'slider'            => '',
		            'small-slider'      => '',
		            'gallery'           => '#qodef_qodef_gallery_type_meta_container',
		            'custom'            => '',
		            'full-width-custom' => ''
	            ),
	            'hide' => array(
		            ''                  => '#qodef_qodef_gallery_type_meta_container',
		            'images'            => '#qodef_qodef_gallery_type_meta_container',
		            'small-images'      => '#qodef_qodef_gallery_type_meta_container',
		            'slider'            => '#qodef_qodef_gallery_type_meta_container',
		            'small-slider'      => '#qodef_qodef_gallery_type_meta_container',
		            'gallery'           => '',
		            'custom'            => '#qodef_qodef_gallery_type_meta_container',
		            'full-width-custom' => '#qodef_qodef_gallery_type_meta_container'
	            )
            )
        ));
	
	    /***************** Gallery Layout *****************/
	
	    $gallery_type_meta_container = coney_qodef_add_admin_container(
		    array(
			    'parent' => $meta_box,
			    'name' => 'qodef_gallery_type_meta_container',
			    'hidden_property' => 'qodef_portfolio_single_template_meta',
			    'hidden_values' => array(
				    'images',
				    'small-images',
				    'slider',
				    'small-slider',
				    'custom',
				    'full-width-custom'
			    )
		    )
	    );
	
	        coney_qodef_create_meta_box_field(array(
			    'name'        => 'qodef_portfolio_single_gallery_columns_number_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Number of Columns', 'coney'),
			    'default_value' => '',
			    'description' => esc_html__('Set number of columns for portfolio gallery type', 'coney'),
			    'parent'      => $gallery_type_meta_container,
			    'options'     => array(
				    ''      => esc_html__('Default', 'coney'),
				    'two'   => esc_html__('2 Columns', 'coney'),
				    'three' => esc_html__('3 Columns', 'coney'),
				    'four'  => esc_html__('4 Columns', 'coney')
			    )
		    ));
	
	        coney_qodef_create_meta_box_field(array(
			    'name'        => 'qodef_portfolio_single_gallery_space_between_items_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Space Between Items', 'coney'),
			    'default_value' => '',
			    'description' => esc_html__('Set space size between columns for portfolio gallery type', 'coney'),
			    'parent'      => $gallery_type_meta_container,
			    'options'     => array(
				    ''          => esc_html__('Default', 'coney'),
				    'normal'    => esc_html__('Normal', 'coney'),
				    'small'     => esc_html__('Small', 'coney'),
				    'tiny'      => esc_html__('Tiny', 'coney'),
				    'no'        => esc_html__('No Space', 'coney')
			    )
		    ));
	
	    /***************** Gallery Layout *****************/

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_show_title_area_portfolio_single_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Show Title Area', 'coney'),
                'description' => esc_html__('Enabling this option will show title area on your single portfolio page', 'coney'),
                'parent'      => $meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'coney'),
                    'yes' => esc_html__('Yes', 'coney'),
                    'no' => esc_html__('No', 'coney')
                )
            )
        );

	    coney_qodef_create_meta_box_field(array(
		    'name'        => 'portfolio_info_top_padding',
		    'type'        => 'text',
		    'label'       => esc_html__('Portfolio Info Top Padding', 'coney'),
		    'description' => esc_html__('Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'coney'),
		    'parent'      => $meta_box,
		    'args'        => array(
			    'col_width' => 3,
			    'suffix' => 'px'
		    )
	    ));

        $all_pages = array();
        $pages     = get_pages();
        foreach($pages as $page) {
            $all_pages[$page->ID] = $page->post_title;
        }

        coney_qodef_create_meta_box_field(array(
            'name'        => 'portfolio_single_back_to_link',
            'type'        => 'select',
            'label'       => esc_html__('"Back To" Link', 'coney'),
            'description' => esc_html__('Choose "Back To" page to link from portfolio Single Project page', 'coney'),
            'parent'      => $meta_box,
            'options'     => $all_pages
        ));

        coney_qodef_create_meta_box_field(array(
            'name'        => 'portfolio_external_link',
            'type'        => 'text',
            'label'       => esc_html__('Portfolio External Link', 'coney'),
            'description' => esc_html__('Enter URL to link from Portfolio List page', 'coney'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_portfolio_settings_meta', 41);
}