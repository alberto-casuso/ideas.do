<?php

if(!function_exists('coney_qodef_map_title_meta')) {
    function coney_qodef_map_title_meta() {
        $title_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Title', 'coney'),
                'name' => 'title_meta'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_show_title_area_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Title Area', 'coney'),
                'description' => esc_html__('Disabling this option will turn off page title area', 'coney'),
                'parent' => $title_meta_box,
                'options' => coney_qodef_get_yes_no_select_array(),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "" => "",
                        "no" => "#qodef_qodef_show_title_area_meta_container",
                        "yes" => ""
                    ),
                    "show" => array(
                        "" => "#qodef_qodef_show_title_area_meta_container",
                        "no" => "",
                        "yes" => "#qodef_qodef_show_title_area_meta_container"
                    )
                )
            )
        );

        $show_title_area_meta_container = coney_qodef_add_admin_container(
            array(
                'parent' => $title_meta_box,
                'name' => 'qodef_show_title_area_meta_container',
                'hidden_property' => 'qodef_show_title_area_meta',
                'hidden_value' => 'no'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_title_area_type_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Title Area Type', 'coney'),
                'description' => esc_html__('Choose title type', 'coney'),
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'coney'),
                    'standard' => esc_html__('Standard', 'coney'),
                    'breadcrumb' => esc_html__('Breadcrumb', 'coney')
                ),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "standard" => "",
                        "breadcrumb" => "#qodef_qodef_title_area_type_meta_container"
                    ),
                    "show" => array(
                        "" => "#qodef_qodef_title_area_type_meta_container",
                        "standard" => "#qodef_qodef_title_area_type_meta_container",
                        "breadcrumb" => ""
                    )
                )
            )
        );

        $title_area_type_meta_container = coney_qodef_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'qodef_title_area_type_meta_container',
                'hidden_property' => 'qodef_title_area_type_meta',
                'hidden_value' => 'breadcrumb'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_title_area_enable_breadcrumbs_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Enable Breadcrumbs', 'coney'),
                'description' => esc_html__('This option will display Breadcrumbs in Title Area', 'coney'),
                'parent' => $title_area_type_meta_container,
                'options' => coney_qodef_get_yes_no_select_array()
            )
        );



        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_title_area_vertical_alignment_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Vertical Alignment', 'coney'),
                'description' => esc_html__('Specify title vertical alignment', 'coney'),
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'coney'),
                    'header_bottom' => esc_html__('From Bottom of Header', 'coney'),
                    'window_top' => esc_html__('From Window Top', 'coney')
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_title_area_content_alignment_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Horizontal Alignment', 'coney'),
                'description' => esc_html__('Specify title horizontal alignment', 'coney'),
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'coney'),
                    'left' => esc_html__('Left', 'coney'),
                    'center' => esc_html__('Center', 'coney'),
                    'right' => esc_html__('Right', 'coney')
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_title_area_title_tag_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Title Tag', 'coney'),
                'parent' => $title_area_type_meta_container,
                'options' => coney_qodef_get_title_tag(true)
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_title_text_color_meta',
                'type' => 'color',
                'label' => esc_html__('Title Color', 'coney'),
                'description' => esc_html__('Choose a color for title text', 'coney'),
                'parent' => $show_title_area_meta_container
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_title_area_background_color_meta',
                'type' => 'color',
                'label' => esc_html__('Background Color', 'coney'),
                'description' => esc_html__('Choose a background color for title area', 'coney'),
                'parent' => $show_title_area_meta_container
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_hide_background_image_meta',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Hide Background Image', 'coney'),
                'description' => esc_html__('Enable this option to hide background image in title area', 'coney'),
                'parent' => $show_title_area_meta_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "#qodef_qodef_hide_background_image_meta_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $hide_background_image_meta_container = coney_qodef_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'qodef_hide_background_image_meta_container',
                'hidden_property' => 'qodef_hide_background_image_meta',
                'hidden_value' => 'yes'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_title_area_background_image_meta',
                'type' => 'image',
                'label' => esc_html__('Background Image', 'coney'),
                'description' => esc_html__('Choose an Image for title area', 'coney'),
                'parent' => $hide_background_image_meta_container
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_title_area_background_image_responsive_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Background Responsive Image', 'coney'),
                'description' => esc_html__('Enabling this option will make Title background image responsive', 'coney'),
                'parent' => $hide_background_image_meta_container,
                'options' => coney_qodef_get_yes_no_select_array(),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "" => "",
                        "no" => "",
                        "yes" => "#qodef_qodef_title_area_background_image_responsive_meta_container, #qodef_qodef_title_area_height_meta"
                    ),
                    "show" => array(
                        "" => "#qodef_qodef_title_area_background_image_responsive_meta_container, #qodef_qodef_title_area_height_meta",
                        "no" => "#qodef_qodef_title_area_background_image_responsive_meta_container, #qodef_qodef_title_area_height_meta",
                        "yes" => ""
                    )
                )
            )
        );

        $title_area_background_image_responsive_meta_container = coney_qodef_add_admin_container(
            array(
                'parent' => $hide_background_image_meta_container,
                'name' => 'qodef_title_area_background_image_responsive_meta_container',
                'hidden_property' => 'qodef_title_area_background_image_responsive_meta',
                'hidden_value' => 'yes'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_title_area_background_image_parallax_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Background Image in Parallax', 'coney'),
                'description' => esc_html__('Enabling this option will make Title background image parallax', 'coney'),
                'parent' => $title_area_background_image_responsive_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'coney'),
                    'no' => esc_html__('No', 'coney'),
                    'yes' => esc_html__('Yes', 'coney'),
                    'yes_zoom' => esc_html__('Yes, with zoom out', 'coney')
                )
            )
        );

        coney_qodef_create_meta_box_field(array(
            'name' => 'qodef_title_area_height_meta',
            'type' => 'text',
            'label' => esc_html__('Height', 'coney'),
            'description' => esc_html__('Set a height for Title Area', 'coney'),
            'parent' => $show_title_area_meta_container,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        ));

        coney_qodef_create_meta_box_field(array(
            'name' => 'qodef_title_area_subtitle_meta',
            'type' => 'text',
            'default_value' => '',
            'label' => esc_html__('Subtitle Text', 'coney'),
            'description' => esc_html__('Enter your subtitle text', 'coney'),
            'parent' => $show_title_area_meta_container,
            'args' => array(
                'col_width' => 6
            )
        ));

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_subtitle_color_meta',
                'type' => 'color',
                'label' => esc_html__('Subtitle Color', 'coney'),
                'description' => esc_html__('Choose a color for subtitle text', 'coney'),
                'parent' => $show_title_area_meta_container
            )
        );
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_title_meta', 60);
}