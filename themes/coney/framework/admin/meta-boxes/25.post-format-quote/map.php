<?php

if(!function_exists('coney_qodef_map_post_quote_meta')) {
    function coney_qodef_map_post_quote_meta() {
        $quote_post_format_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' =>	array('post'),
                'title' => esc_html__('Quote Post Format', 'coney'),
                'name' 	=> 'post_format_quote_meta'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        => 'qodef_post_quote_text_meta',
                'type'        => 'text',
                'label'       => esc_html__('Quote Text', 'coney'),
                'description' => esc_html__('Enter Quote text', 'coney'),
                'parent'      => $quote_post_format_meta_box,

            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        => 'qodef_post_quote_author_meta',
                'type'        => 'text',
                'label'       => esc_html__('Quote Author', 'coney'),
                'description' => esc_html__('Enter Quote author', 'coney'),
                'parent'      => $quote_post_format_meta_box,
            )
        );
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_post_quote_meta', 25);
}