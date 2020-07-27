<?php

if(!function_exists('coney_qodef_map_sidebar_meta')) {
    function coney_qodef_map_sidebar_meta() {
        $qodef_sidebar_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'team-member'),
                'title' => esc_html__('Sidebar', 'coney'),
                'name' => 'sidebar_meta'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        => 'qodef_sidebar_layout_meta',
                'type'        => 'select',
                'label'       => esc_html__('Layout', 'coney'),
                'description' => esc_html__('Choose the sidebar layout', 'coney'),
                'parent'      => $qodef_sidebar_meta_box,
                'options'     => array(
                    ''			        => esc_html__('Default', 'coney'),
                    'no-sidebar'		=> esc_html__('No Sidebar', 'coney'),
                    'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'coney'),
                    'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'coney'),
                    'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'coney'),
                    'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'coney')
                )
            )
        );

        $qodef_custom_sidebars = coney_qodef_get_custom_sidebars();
        if(count($qodef_custom_sidebars) > 0) {
            coney_qodef_create_meta_box_field(array(
                'name' => 'qodef_custom_sidebar_area_meta',
                'type' => 'selectblank',
                'label' => esc_html__('Choose Widget Area in Sidebar', 'coney'),
                'description' => esc_html__('Choose Custom Widget area to display in Sidebar"', 'coney'),
                'parent' => $qodef_sidebar_meta_box,
                'options' => $qodef_custom_sidebars
            ));
        }
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_sidebar_meta', 31);
}