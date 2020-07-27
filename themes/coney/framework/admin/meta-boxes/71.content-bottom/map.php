<?php

if(!function_exists('coney_qodef_map_content_bottom_meta')) {
    function coney_qodef_map_content_bottom_meta() {
        $content_bottom_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Content Bottom', 'coney'),
                'name' => 'content_bottom_meta'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_enable_content_bottom_area_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Enable Content Bottom Area', 'coney'),
                'description' => esc_html__('This option will enable Content Bottom area on pages', 'coney'),
                'parent' => $content_bottom_meta_box,
                'options' => coney_qodef_get_yes_no_select_array(),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        '' => '#qodef_qodef_show_content_bottom_meta_container',
                        'no' => '#qodef_qodef_show_content_bottom_meta_container'
                    ),
                    'show' => array(
                        'yes' => '#qodef_qodef_show_content_bottom_meta_container'
                    )
                )
            )
        );

        $show_content_bottom_meta_container = coney_qodef_add_admin_container(
            array(
                'parent' => $content_bottom_meta_box,
                'name' => 'qodef_show_content_bottom_meta_container',
                'hidden_property' => 'qodef_enable_content_bottom_area_meta',
                'hidden_values' => array('','no')
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_content_bottom_sidebar_custom_display_meta',
                'type' => 'selectblank',
                'default_value' => '',
                'label' => esc_html__('Sidebar to Display', 'coney'),
                'description' => esc_html__('Choose a content bottom sidebar to display', 'coney'),
                'options' => coney_qodef_get_custom_sidebars(),
                'parent' => $show_content_bottom_meta_container
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'type' => 'select',
                'name' => 'qodef_content_bottom_in_grid_meta',
                'default_value' => '',
                'label' => esc_html__('Display in Grid', 'coney'),
                'description' => esc_html__('Enabling this option will place content bottom in grid', 'coney'),
                'options' => coney_qodef_get_yes_no_select_array(),
                'parent' => $show_content_bottom_meta_container
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'type' => 'color',
                'name' => 'qodef_content_bottom_background_color_meta',
                'label' => esc_html__('Background Color', 'coney'),
                'description' => esc_html__('Choose a background color for content bottom area', 'coney'),
                'parent' => $show_content_bottom_meta_container
            )
        );
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_content_bottom_meta', 71);
}