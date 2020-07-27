<?php

if(!function_exists('coney_qodef_map_blog_meta')) {
    function coney_qodef_map_blog_meta() {
        $qode_blog_categories = array();
        $categories = get_categories();
        foreach($categories as $category) {
            $qode_blog_categories[$category->slug] = $category->name;
        }

        $yesnoarray = array(
            'yes' => esc_html__('Yes', 'coney'),
            'no' => esc_html__('No', 'coney')
        );

        $blog_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' => array('page'),
                'title' => esc_html__('Blog', 'coney'),
                'name' => 'blog_meta'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        => 'qodef_blog_category_meta',
                'type'        => 'selectblank',
                'label'       => esc_html__('Blog Category', 'coney'),
                'description' => esc_html__('Choose category of posts to display (leave empty to display all categories)', 'coney'),
                'parent'      => $blog_meta_box,
                'options'     => $qode_blog_categories
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        => 'qodef_show_posts_per_page_meta',
                'type'        => 'text',
                'label'       => esc_html__('Number of Posts', 'coney'),
                'description' => esc_html__('Enter the number of posts to display', 'coney'),
                'parent'      => $blog_meta_box,
                'args'        => array("col_width" => 3)
            )
        );

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_blog_masonry_layout_meta',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Layout', 'coney'),
            'description' => esc_html__('Set masonry layout. Default is in grid.', 'coney'),
            'parent'      => $blog_meta_box,
            'options'     => array(
                ''      => esc_html__('Default', 'coney'),
                'in-grid'   => esc_html__('In Grid', 'coney'),
                'full-width' => esc_html__('Full Width', 'coney')
            )
        ));

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_blog_masonry_number_of_columns_meta',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Number of Columns', 'coney'),
            'description' => esc_html__('Set number of columns for your masonry blog lists', 'coney'),
            'parent'      => $blog_meta_box,
            'options'     => array(
                ''      => esc_html__('Default', 'coney'),
                'two'   => esc_html__('2 Columns', 'coney'),
                'three' => esc_html__('3 Columns', 'coney'),
                'four'  => esc_html__('4 Columns', 'coney'),
                'five'  => esc_html__('5 Columns', 'coney')
            )
        ));

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_blog_masonry_space_between_items_meta',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Space Between Items', 'coney'),
            'description' => esc_html__('Set space size between posts for your masonry blog lists', 'coney'),
            'parent'      => $blog_meta_box,
            'options'     => array(
                ''        => esc_html__('Default', 'coney'),
                'normal'  => esc_html__('Normal', 'coney'),
                'small'   => esc_html__('Small', 'coney'),
                'tiny'    => esc_html__('Tiny', 'coney'),
                'no'      => esc_html__('No Space', 'coney')
            )
        ));

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_blog_list_featured_image_proportion_meta',
            'type'        => 'select',
            'label'       => esc_html__('Featured Image Proportion', 'coney'),
            'description' => esc_html__('Choose type of proportions you want to use for featured images on metro blog template.', 'coney'),
            'parent'      => $blog_meta_box,
            'default_value' => '',
            'options'     => array(
                ''		   => esc_html__('Default', 'coney'),
                'fixed'    => esc_html__('Fixed', 'coney'),
                'original' => esc_html__('Original', 'coney')
            )
        ));

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_blog_pagination_type_meta',
            'type'        => 'select',
            'label'       => esc_html__('Pagination Type', 'coney'),
            'description' => esc_html__('Choose a pagination layout for Blog Lists', 'coney'),
            'parent'      => $blog_meta_box,
            'default_value' => '',
            'options'     => array(
                ''                => esc_html__('Default', 'coney'),
                'standard'		  => esc_html__('Standard', 'coney'),
                'load-more'		  => esc_html__('Load More', 'coney'),
                'infinite-scroll' => esc_html__('Infinite Scroll', 'coney'),
                'no-pagination'   => esc_html__('No Pagination', 'coney')
            )
        ));

        coney_qodef_create_meta_box_field(
            array(
                'type' => 'text',
                'name' => 'qodef_number_of_chars_meta',
                'default_value' => '',
                'label' => esc_html__('Number of Words in Excerpt', 'coney'),
                'description' => esc_html__('Enter a number of words in excerpt (article summary). Default value is 40', 'coney'),
                'parent' => $blog_meta_box,
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_enable_blog_widget_area_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Enable Blog Widget Area', 'coney'),
                'description' => esc_html__('This option will enable Blog Widget Area on blog lists.', 'coney'),
                'parent' => $blog_meta_box,
                'options' => coney_qodef_get_yes_no_select_array(),
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_enable_blog_list_animation_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Enable Blog List Animation', 'coney'),
                'description' => esc_html__('This option will enable animated loading for Blog List', 'coney'),
                'parent' => $blog_meta_box,
                'options' => coney_qodef_get_yes_no_select_array(),
            )
        );

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_blog_quote_behavior_meta',
            'type'        => 'select',
            'label'       => esc_html__('Quote posts behavior', 'coney'),
            'description' => esc_html__('Choose where Quote posts will lead to when clicked on. If you choose "Default Behavior" then Quote posts will not be clickable. If you set "Custom Behavior" then they will lead to the blog single pages.', 'coney'),
            'parent'      => $blog_meta_box,
            'default_value' => '',
            'options'     => array(
                ''                 => esc_html__('Default', 'coney'),
                'default_behavior' => esc_html__('Default Behavior', 'coney'),
                'custom_behavior'  => esc_html__('Custom Behavior', 'coney'),
            )
        ));

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_blog_link_behavior_meta',
            'type'        => 'select',
            'label'       => esc_html__('Link posts behavior', 'coney'),
            'description' => esc_html__('Choose where Link posts will lead to when clicked on. If you choose "Default Behavior" then Link Posts will lead to the external link you set for that post. If you set "Custom Behavior" then they will lead to the blog single pages.', 'coney'),
            'parent'      => $blog_meta_box,
            'default_value' => '',
            'options'     => array(
                ''                  => esc_html__('Default', 'coney'),
                'default_behavior'  => esc_html__('Default Behavior', 'coney'),
                'custom_behavior'   => esc_html__('Custom Behavior', 'coney'),
            )
        ));
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_blog_meta', 30);
}