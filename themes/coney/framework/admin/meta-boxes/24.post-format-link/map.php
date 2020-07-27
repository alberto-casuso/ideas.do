<?php

if(!function_exists('coney_qodef_map_post_link_meta')) {
    function coney_qodef_map_post_link_meta() {
        $link_post_format_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' => array('post'),
                'title' => esc_html__('Link Post Format', 'coney'),
                'name' => 'post_format_link_meta'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        => 'qodef_post_link_link_meta',
                'type'        => 'text',
                'label'       => esc_html__('Link', 'coney'),
                'description' => esc_html__('Enter link', 'coney'),
                'parent'      => $link_post_format_meta_box,

            )
        );


    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_post_link_meta', 24);
}