<?php

if(!function_exists('coney_qodef_map_post_gallery_meta')) {

    function coney_qodef_map_post_gallery_meta() {
        $gallery_post_format_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' =>	array('post'),
                'title' => esc_html__('Gallery Post Format', 'coney'),
                'name' 	=> 'post_format_gallery_meta'
            )
        );

        coney_qodef_add_multiple_images_field(
            array(
                'name'        => 'qodef_post_gallery_images_meta',
                'label'       => esc_html__('Gallery Images', 'coney'),
                'description' => esc_html__('Choose your gallery images', 'coney'),
                'parent'      => $gallery_post_format_meta_box,
            )
        );
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_post_gallery_meta', 21);
}
