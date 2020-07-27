<?php

if(!function_exists('coney_qodef_map_header_meta')) {
    function coney_qodef_map_header_meta() {
        $header_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Header', 'coney'),
                'name' => 'header_meta'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_header_type_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Choose Header Type', 'coney'),
                'description' => esc_html__('Select header type layout', 'coney'),
                'parent' => $header_meta_box,
                'options' => array(
                    '' => 'Default',
                    'header-standard' => esc_html__('Standard Header Layout', 'coney'),
                    'header-classic' => esc_html__('Centered Header Layout', 'coney'),
                    'header-divided' => esc_html__('Divided Header Layout', 'coney'),
                    'header-full-screen' => esc_html__('Full Screen Header Layout', 'coney'),
                    'header-vertical' => esc_html__('Vertical Header Layout', 'coney')
                ),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        '' => '#qodef_qodef_header_standard_type_meta_container, #qodef_qodef_header_divided_type_meta_container, #qodef_qodef_header_full_screen_type_meta_container, #qodef_qodef_header_vertical_type_meta_container',
                        'header-standard' => '#qodef_qodef_header_divided_type_meta_container, #qodef_qodef_header_full_screen_type_meta_container, #qodef_qodef_header_vertical_type_meta_container',
                        'header-classic' => '#qodef_qodef_header_standard_type_meta_container, #qodef_qodef_header_divided_type_meta_container, #qodef_qodef_header_full_screen_type_meta_container, #qodef_qodef_header_vertical_type_meta_container',
                        'header-divided' => '#qodef_qodef_header_standard_type_meta_container, #qodef_qodef_header_full_screen_type_meta_container, #qodef_qodef_header_vertical_type_meta_container',
                        'header-full-screen' => '#qodef_qodef_header_standard_type_meta_container, #qodef_qodef_header_divided_type_meta_container, #qodef_qodef_header_vertical_type_meta_container',
                        'header-vertical' => '#qodef_qodef_header_standard_type_meta_container, #qodef_qodef_header_divided_type_meta_container, #qodef_qodef_header_full_screen_type_meta_container'
                    ),
                    'show' => array(
                        '' => '',
                        'header-standard' => '#qodef_qodef_header_standard_type_meta_container',
                        'header-classic' => '',
                        'header-divided' => '#qodef_qodef_header_divided_type_meta_container',
                        'header-full-screen' => '#qodef_qodef_header_full_screen_type_meta_container',
                        'header-vertical' => '#qodef_qodef_header_vertical_type_meta_container'
                    )
                )
            )
        );

        $header_standard_type_meta_container = coney_qodef_add_admin_container(
            array(
                'parent' => $header_meta_box,
                'name' => 'qodef_header_standard_type_meta_container',
                'hidden_property' => 'qodef_header_type_meta',
                'hidden_values' => array(
                    'header-classic',
                    'header-divided',
                    'header-full-screen',
                    'header-vertical'
                ),
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_set_menu_area_position_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Choose Menu Area Position', 'coney'),
                'description' => esc_html__('Select menu area position in your header', 'coney'),
                'parent' => $header_standard_type_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'coney'),
                    'center' => esc_html__('Center', 'coney'),
                    'left' => esc_html__('Left', 'coney'),
                    'right' => esc_html__('Right', 'coney')
                )
            )
        );

        $header_vertical_type_meta_container = coney_qodef_add_admin_container(
            array(
                'parent' => $header_meta_box,
                'name' => 'qodef_header_vertical_type_meta_container',
                'hidden_property' => 'qodef_header_type_meta',
                'hidden_values' => array(
                    'header-standard',
                    'header-classic',
                    'header-divided',
                    'header-full-screen'
                ),
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'          => 'qodef_vertical_header_background_image_meta',
                'type'          => 'image',
                'default_value' => '',
                'label'         => esc_html__('Background Image', 'coney'),
                'description'   => esc_html__('Set background image for vertical menu', 'coney'),
                'parent'        => $header_vertical_type_meta_container
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_disable_vertical_header_background_image_meta',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Disable Background Image', 'coney'),
                'description' => esc_html__('Enabling this option will hide background image in header area', 'coney'),
                'parent' => $header_vertical_type_meta_container
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_vertical_header_text_align_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Choose Text Alignment', 'coney'),
                'description' => esc_html__('Choose text alignment for header area elements (logo, menu and widgets)', 'coney'),
                'parent' => $header_vertical_type_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'coney'),
                    'left' => esc_html__('Left', 'coney'),
                    'center' => esc_html__('Center', 'coney')
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_disable_header_widget_area_meta',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Disable Header Widget Area', 'coney'),
                'description' => esc_html__('Enabling this option will hide widget area from the right hand side of main menu', 'coney'),
                'parent' => $header_meta_box
            )
        );

        $coney_custom_sidebars = coney_qodef_get_custom_sidebars();
        if(count($coney_custom_sidebars) > 0) {
            coney_qodef_create_meta_box_field(array(
                'name' => 'qodef_custom_header_sidebar_meta',
                'type' => 'selectblank',
                'label' => esc_html__('Choose Custom Widget Area in Header', 'coney'),
                'description' => esc_html__('Choose custom widget area to display in header area from the right hand side of main menu"', 'coney'),
                'parent' => $header_meta_box,
                'options' => $coney_custom_sidebars
            ));
        }

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_top_bar_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Header Top Bar', 'coney'),
                'description' => esc_html__('Enabling this option will show header top bar area', 'coney'),
                'parent' => $header_meta_box,
                'options' => coney_qodef_get_yes_no_select_array(),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "" => "#qodef_qodef_show_top_bar_meta_container",
                        "no" => "#qodef_qodef_show_top_bar_meta_container",
                        "yes" => ""
                    ),
                    "show" => array(
                        "" => "",
                        "no" => "",
                        "yes" => "#qodef_qodef_show_top_bar_meta_container"
                    )
                )
            )
        );

        $show_top_bar_meta_container = coney_qodef_add_admin_container(
            array(
                'parent' => $header_meta_box,
                'name' => 'qodef_show_top_bar_meta_container',
                'hidden_property' => 'qodef_top_bar_meta',
                'hidden_values' => array(
                    "",
                    'no'
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_top_bar_color_skin_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Choose Top Bar Color Skin', 'coney'),
                'parent' => $show_top_bar_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'coney'),
                    'top-dark' => esc_html__('Dark', 'coney'),
                    'top-light' => esc_html__('Light', 'coney')
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_top_bar_in_grid_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Enable Grid Layout', 'coney'),
                'description' => esc_html__('Set top bar content to be in grid', 'coney'),
                'parent' => $show_top_bar_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'coney'),
                    'yes' => esc_html__('Yes', 'coney'),
                    'no' => esc_html__('No', 'coney')
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_header_style_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Header Skin', 'coney'),
                'description' => esc_html__('Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'coney'),
                'parent' => $header_meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'coney'),
                    'light-header' => esc_html__('Light', 'coney'),
                    'dark-header' => esc_html__('Dark', 'coney')
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_enable_grid_layout_header_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Enable Grid Layout', 'coney'),
                'description' => esc_html__('Enabling this option you will set header area to be in grid', 'coney'),
                'parent' => $header_meta_box,
                'options' => coney_qodef_get_yes_no_select_array()
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_header_area_background_color_meta',
                'type' => 'color',
                'label' => esc_html__('Background Color', 'coney'),
                'description' => esc_html__('Choose a background color for header area', 'coney'),
                'parent' => $header_meta_box
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_header_area_background_transparency_meta',
                'type' => 'text',
                'label' => esc_html__('Background Transparency', 'coney'),
                'description' => esc_html__('Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'coney'),
                'parent' => $header_meta_box,
                'args' => array(
                    'col_width' => 2
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_header_area_border_top_color_meta',
                'type' => 'color',
                'label' => esc_html__('Border Top Color', 'coney'),
                'description' => esc_html__('Choose a border top color for header area. This option doesn\'t work for Vertical header layout', 'coney'),
                'parent' => $header_meta_box
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_header_area_border_color_meta',
                'type' => 'color',
                'label' => esc_html__('Border Bottom Color', 'coney'),
                'description' => esc_html__('Choose a border bottom color for header area. This option doesn\'t work for Vertical header layout', 'coney'),
                'parent' => $header_meta_box
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'            => 'qodef_scroll_amount_for_sticky_meta',
                'type'            => 'text',
                'label'           => esc_html__('Scroll amount for sticky header appearance', 'coney'),
                'description'     => esc_html__('Define scroll amount for sticky header appearance', 'coney'),
                'parent'          => $header_meta_box,
                'args'            => array(
                    'col_width' => 2,
                    'suffix'    => 'px'
                ),
                'hidden_property' => 'header_behaviour',
                'hidden_values'   => array("sticky-header-on-scroll-up", "fixed-on-scroll")
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_sticky_header_in_grid_meta',
                'type' => 'select',
                'default_value' => '',
                'options' => array(
                    '' =>esc_html__( 'Default', 'coney'),
                    'yes' => esc_html__('Yes', 'coney'),
                    'no' => esc_html__('No', 'coney')
                ),
                'label' => esc_html__('Sticky Header in Grid', 'coney'),
                'description' => esc_html__('Enabling this option will put sticky header in grid', 'coney'),
                'parent' => $header_meta_box
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_set_sticky_menu_area_position_meta',
                'type' => 'select',
                'default_value' => '',
                'options' => array(
                    '' =>esc_html__( 'Default', 'coney'),
                    'center' => esc_html__('Center', 'coney'),
                    'left' => esc_html__('Left', 'coney'),
                    'right' => esc_html__('Right', 'coney')
                ),
                'label' => esc_html__('Choose Menu Area Position', 'coney'),
                'description' => esc_html__('Select menu area position in your sticky header', 'coney'),
                'parent' => $header_meta_box
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_enable_wide_menu_background_meta',
                'type' => 'select',
                'default_value' => '',
                'options' => array(
                    '' =>esc_html__( 'Default', 'coney'),
                    'yes' => esc_html__('Yes', 'coney'),
                    'no' => esc_html__('No', 'coney')
                ),
                'label' => esc_html__('Enable Full Width Background for Wide Dropdown Type', 'coney'),
                'description' => esc_html__('Enabling this option will show full width background  for wide dropdown type', 'coney'),
                'parent' => $header_meta_box
            )
        );
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_header_meta', 50);
}