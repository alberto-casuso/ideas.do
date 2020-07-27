<?php

if ( ! function_exists('coney_qodef_blog_options_map') ) {

	function coney_qodef_blog_options_map() {

		coney_qodef_add_admin_page(
			array(
				'slug' => '_blog_page',
				'title' => esc_html__('Blog', 'coney'),
				'icon' => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */
		$panel_blog_lists = coney_qodef_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_lists',
				'title' => esc_html__('Blog Lists', 'coney')
			)
		);

		coney_qodef_add_admin_field(array(
			'name'        => 'blog_list_type',
			'type'        => 'select',
			'label'       => esc_html__('Blog Layout for Archive Pages', 'coney'),
			'description' => esc_html__('Choose a default blog layout for archived blog post lists', 'coney'),
			'default_value' => 'masonry',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'centered'			    => esc_html__('Blog: Centered', 'coney'),
				'chequered' 		    => esc_html__('Blog: Chequered', 'coney'),
				'full-width-photo'	    => esc_html__('Blog: Full Width Photo', 'coney'),
				'masonry'               => esc_html__('Blog: Masonry', 'coney'),
                'metro'                 => esc_html__('Blog: Metro', 'coney'),
                'narrow'                => esc_html__('Blog: Narrow', 'coney'),
                'split-column'          => esc_html__('Blog: Split Column', 'coney'),
                'standard'              => esc_html__('Blog: Standard', 'coney'),
			)
		));

		coney_qodef_add_admin_field(array(
			'name'        => 'archive_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout for Archive Pages', 'coney'),
			'description' => esc_html__('Choose a sidebar layout for archived blog post lists', 'coney'),
			'default_value' => '',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				''		            => esc_html__('Default', 'coney'),
				'no-sidebar'		=> esc_html__('No Sidebar', 'coney'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'coney'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'coney'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'coney'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'coney')
			)
		));
		
		$coney_custom_sidebars = coney_qodef_get_custom_sidebars();
		if(count($coney_custom_sidebars) > 0) {
			coney_qodef_add_admin_field(array(
				'name' => 'archive_custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display for Archive Pages', 'coney'),
				'description' => esc_html__('Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'coney'),
				'parent' => $panel_blog_lists,
				'options' => coney_qodef_get_custom_sidebars()
			));
		}

        coney_qodef_add_admin_field(array(
            'name'        => 'blog_masonry_layout',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Layout', 'coney'),
            'default_value' => 'in-grid',
            'description' => esc_html__('Set masonry layout. Default is in grid.', 'coney'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'in-grid'    => esc_html__('In Grid', 'coney'),
                'full-width' => esc_html__('Full Width', 'coney')
            )
        ));
		
		coney_qodef_add_admin_field(array(
			'name'        => 'blog_masonry_number_of_columns',
			'type'        => 'select',
			'label'       => esc_html__('Masonry - Number of Columns', 'coney'),
			'default_value' => 'three',
			'description' => esc_html__('Set number of columns for your masonry blog lists. Default value is 4 columns', 'coney'),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'two'   => esc_html__('2 Columns', 'coney'),
				'three' => esc_html__('3 Columns', 'coney'),
				'four'  => esc_html__('4 Columns', 'coney'),
				'five'  => esc_html__('5 Columns', 'coney')
			)
		));
		
		coney_qodef_add_admin_field(array(
			'name'        => 'blog_masonry_space_between_items',
			'type'        => 'select',
			'label'       => esc_html__('Masonry - Space Between Items', 'coney'),
			'default_value' => 'normal',
			'description' => esc_html__('Set space size between posts for your masonry blog lists. Default value is normal', 'coney'),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'normal'  => esc_html__('Normal', 'coney'),
				'small'   => esc_html__('Small', 'coney'),
				'tiny'    => esc_html__('Tiny', 'coney'),
				'no'      => esc_html__('No Space', 'coney')
			)
		));

        coney_qodef_add_admin_field(array(
            'name'        => 'blog_list_featured_image_proportion',
            'type'        => 'select',
            'label'       => esc_html__('Featured Image Proportion', 'coney'),
            'default_value' => 'fixed',
            'description' => esc_html__('Choose type of proportions you want to use for featured images on metro blog template.', 'coney'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'fixed'    => esc_html__('Fixed', 'coney'),
                'original' => esc_html__('Original', 'coney')
            )
        ));

		coney_qodef_add_admin_field(array(
			'name'        => 'blog_pagination_type',
			'type'        => 'select',
			'label'       => esc_html__('Pagination Type', 'coney'),
			'description' => esc_html__('Choose a pagination layout for Blog Lists', 'coney'),
			'parent'      => $panel_blog_lists,
			'default_value' => 'standard',
			'options'     => array(
				'standard'		  => esc_html__('Standard', 'coney'),
				'load-more'		  => esc_html__('Load More', 'coney'),
				'infinite-scroll' => esc_html__('Infinite Scroll', 'coney'),
				'no-pagination'   => esc_html__('No Pagination', 'coney')
			)
		));
	
		coney_qodef_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'number_of_chars',
				'default_value' => '40',
				'label' => esc_html__('Number of Words in Excerpt', 'coney'),
				'description' => esc_html__('Enter a number of words in excerpt (article summary). Default value is 40', 'coney'),
				'parent' => $panel_blog_lists,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'enable_blog_widget_area',
				'default_value' => 'no',
				'label'       => esc_html__('Enable Blog Widget Area', 'coney'),
				'description' => esc_html__('This option will enable Blog Widget Area on blog lists', 'coney'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_show_blog_widget_area_container'
				),
				'parent'      => $panel_blog_lists,
			)
		);

		$show_blog_widget_area_container = coney_qodef_add_admin_container(
			array(
				'name' => 'show_blog_widget_area_container',
				'hidden_property' => 'enable_blog_widget_area',
				'hidden_value' => 'no',
				'parent' => $panel_blog_lists
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_widget_area_in_grid',
				'default_value' => 'yes',
				'label' => esc_html__('Blog Widget Area in Grid', 'coney'),
				'description' => esc_html__('Enabling this option will place Blog Widget Area content in grid', 'coney'),
				'parent' => $show_blog_widget_area_container,
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'blog_widget_area_columns',
				'default_value' => '3',
				'label' => esc_html__('Blog Widget Area Columns', 'coney'),
				'description' => esc_html__('Choose number of columns for Blog widget area', 'coney'),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				'parent' => $show_blog_widget_area_container,
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'enable_blog_list_animation',
				'default_value' => 'no',
				'label'       => esc_html__('Enable Blog List Animation', 'coney'),
				'description' => esc_html__('This option will enable animated loading for Blog List', 'coney'),
				'parent' => $panel_blog_lists,
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'blog_quote_behavior',
				'default_value' => 'default_behavior',
				'label' => esc_html__('Quote posts behavior', 'coney'),
				'description' => esc_html__('Choose where Quote posts will lead to when clicked on. If you choose "Default Behavior" then Quote posts will not be clickable. If you set "Custom Behavior" then they will lead to the blog single pages.', 'coney'),
				'options' => array(
					'default_behavior' 	=> esc_html__('Default Behavior', 'coney'),
					'custom_behavior' 	=> esc_html__('Custom Behavior', 'coney'),
				),
				'parent' => $panel_blog_lists,
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'blog_link_behavior',
				'default_value' => 'default_behavior',
				'label' => esc_html__('Link posts behavior', 'coney'),
				'description' => esc_html__('Choose where Link posts will lead to when clicked on. If you choose "Default Behavior" then Link Posts will lead to the external link you set for that post. If you set "Custom Behavior" then they will lead to the blog single pages.', 'coney'),
				'options' => array(
					'default_behavior' 	=> esc_html__('Default Behavior', 'coney'),
					'custom_behavior' 	=> esc_html__('Custom Behavior', 'coney'),
				),
				'parent' => $panel_blog_lists,
			)
		);

        coney_qodef_add_admin_field(
            array(
                'type' => 'select',
                'name' => 'content_position',
                'default_value' => 'above',
                'label' => esc_html__('Content Position', 'coney'),
                'description' => esc_html__('Choose where content will be placed on blog lists.', 'coney'),
                'options' => array(
                    'above' 	=> esc_html__('Above Posts', 'coney'),
                    'below' 	=> esc_html__('Below Posts', 'coney'),
                ),
                'parent' => $panel_blog_lists,
            )
        );

		/**
		 * Blog Single
		 */
		$panel_blog_single = coney_qodef_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_single',
				'title' => esc_html__('Blog Single', 'coney')
			)
		);

        coney_qodef_add_admin_field(array(
            'name'        => 'blog_single_type',
            'type'        => 'select',
            'label'       => esc_html__('Blog Layout for Single Post Pages', 'coney'),
            'description' => esc_html__('Choose a default blog layout for single post pages', 'coney'),
            'default_value' => 'standard',
            'parent'      => $panel_blog_single,
            'options'     => array(
                'standard'              => esc_html__('Standard', 'coney'),
                'full-width-image'		=> esc_html__('Full width Image', 'coney'),
                'narrow' 		=> esc_html__('Narrow', 'coney')
            )
        ));

		coney_qodef_add_admin_field(array(
			'name'        => 'blog_single_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'coney'),
			'description' => esc_html__('Choose a sidebar layout for Blog Single pages', 'coney'),
			'default_value'	=> '',
			'parent'      => $panel_blog_single,
			'options'     => array(
				''		            => esc_html__('Default', 'coney'),
				'no-sidebar'		=> esc_html__('No Sidebar', 'coney'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'coney'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'coney'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'coney'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'coney')
			)
		));

		if(count($coney_custom_sidebars) > 0) {
			coney_qodef_add_admin_field(array(
				'name' => 'blog_single_custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display', 'coney'),
				'description' => esc_html__('Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'coney'),
				'parent' => $panel_blog_single,
				'options' => coney_qodef_get_custom_sidebars()
			));
		}
		
		coney_qodef_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'show_title_area_blog',
				'default_value' => '',
				'label'       => esc_html__('Show Title Area', 'coney'),
				'description' => esc_html__('Enabling this option will show title area on single post pages', 'coney'),
				'parent'      => $panel_blog_single,
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
			'name'          => 'blog_single_title_in_title_area',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Post Title in Title Area', 'coney'),
			'description'   => esc_html__('Enabling this option will show post title in title area on single post pages', 'coney'),
			'parent'        => $panel_blog_single,
			'default_value' => 'no'
		));

		coney_qodef_add_admin_field(array(
			'name'			=> 'blog_single_related_posts',
			'type'			=> 'yesno',
			'label'			=> esc_html__('Show Related Posts', 'coney'),
			'description'   => esc_html__('Enabling this option will show related posts on single post pages', 'coney'),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes',
			'args' => array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#qodef_related_posts_container'
			),
		));

		$related_posts_container = coney_qodef_add_admin_container(
			array(
				'name' 				=> 'related_posts_container',
				'hidden_property' 	=> 'blog_single_related_posts',
				'hidden_value' 		=> 'no',
				'parent' 			=> $panel_blog_single
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' 				=> 'select',
				'name' 				=> 'blog_single_related_posts_layout',
				'default_value'		=> 'list',
				'label' 			=> esc_html__('Related Posts Layout', 'coney'),
				'description' 		=> esc_html__('Choose Related Posts layout', 'coney'),
				'options' 			=> array(
                    ''          => esc_html__('List', 'coney'),
                    'carousel'  => esc_html__('Carousel', 'coney')
				),
				'parent' 			=> $related_posts_container,
			)
		);

		coney_qodef_add_admin_field(array(
			'name'          => 'blog_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments Form', 'coney'),
			'description'   => esc_html__('Enabling this option will show comments form on single post pages', 'coney'),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		coney_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_navigation',
				'default_value' => 'no',
				'label' => esc_html__('Enable Prev/Next Single Post Navigation Links', 'coney'),
				'description' => esc_html__('Enable navigation links through the blog posts (left and right arrows will appear)', 'coney'),
				'parent' => $panel_blog_single,
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_qodef_blog_single_navigation_container'
				)
			)
		);

		$blog_single_navigation_container = coney_qodef_add_admin_container(
			array(
				'name' => 'qodef_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'       => esc_html__('Enable Navigation Only in Current Category', 'coney'),
				'description' => esc_html__('Limit your navigation only through current category', 'coney'),
				'parent'      => $blog_single_navigation_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_author_info',
				'default_value' => 'yes',
				'label' => esc_html__('Show Author Info Box', 'coney'),
				'description' => esc_html__('Enabling this option will display author name and descriptions on single post pages', 'coney'),
				'parent' => $panel_blog_single,
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_qodef_blog_single_author_info_container'
				)
			)
		);

		$blog_single_author_info_container = coney_qodef_add_admin_container(
			array(
				'name' => 'qodef_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_author_info_email',
				'default_value' => 'no',
				'label'       => esc_html__('Show Author Email', 'coney'),
				'description' => esc_html__('Enabling this option will show author email', 'coney'),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		coney_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'       => esc_html__('Show Author Social Icons', 'coney'),
				'description' => esc_html__('Enabling this option will show author social icons on single post pages', 'coney'),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);
	}

	add_action( 'coney_qodef_options_map', 'coney_qodef_blog_options_map', 13);
}