<?php

if(!function_exists('coney_qodef_map_footer_meta')) {
    function coney_qodef_map_footer_meta() {
        $footer_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Footer', 'coney'),
                'name' => 'footer_meta'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_disable_footer_meta',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Disable Footer for this Page', 'coney'),
                'description' => esc_html__('Enabling this option will hide footer on this page', 'coney'),
                'parent' => $footer_meta_box
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_show_footer_top_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Footer Top', 'coney'),
                'description' => esc_html__('Enabling this option will show Footer Top area', 'coney'),
                'parent' => $footer_meta_box,
                'options' => coney_qodef_get_yes_no_select_array(),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "" => "",
                        "no" => "#qodef_qodef_show_footer_top_container",
                        "yes" => ""
                    ),
                    "show" => array(
                        "" => "#qodef_qodef_show_footer_top_container",
                        "no" => "",
                        "yes" => "#qodef_qodef_show_footer_top_container"
                    )
                )
            )
        );

        $show_footer_top_container = coney_qodef_add_admin_container(
            array(
                'parent' => $footer_meta_box,
                'name' => 'qodef_show_footer_top_container',
                'hidden_property' => 'qodef_show_footer_top_meta',
                'hidden_value' => 'no'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_footer_top_type_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Footer Top Type', 'coney'),
                'description' => esc_html__('Choose a Footer Top type', 'coney'),
                'parent' => $show_footer_top_container,
                'options' => array(
                    '' => esc_html__('Default', 'coney'),
                    'standard'   => esc_html__('Footer Top Standard', 'coney'),
                    'simple'     => esc_html__('Footer Top Simple', 'coney')
                ),
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_show_footer_bottom_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Footer Bottom', 'coney'),
                'description' => esc_html__('Enabling this option will show Footer Bottom area', 'coney'),
                'parent' => $footer_meta_box,
                'options' => coney_qodef_get_yes_no_select_array()
            )
        );
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_footer_meta', 70);
}