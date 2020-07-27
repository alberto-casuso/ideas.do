<?php

if(!function_exists('coney_qodef_map_post_image_meta')) {
    function coney_qodef_map_post_image_meta() {
        $image_post_format_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' => array('post'),
                'title' => esc_html__('Image Post Format', 'coney'),
                'name' => 'post_format_image_meta'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        => 'qodef_post_image_link_meta',
                'type'        => 'text',
                'label'       => esc_html__('Link', 'coney'),
                'description' => esc_html__('Enter link', 'coney'),
                'parent'      => $image_post_format_meta_box,

            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'          => 'qodef_post_image_link_target_meta',
                'type'          => 'select',
                'default_value' => '_self',
                'label'         => esc_html__('Target', 'coney'),
                'description'   => esc_html__('Link Target', 'coney'),
                'parent'        => $image_post_format_meta_box,
                'options'       => array(
                    '_self'  => esc_html__('Same Window', 'coney'),
                    '_blank' => esc_html__('New Window', 'coney')
                )

            )
        );
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_post_image_meta', 26);
}