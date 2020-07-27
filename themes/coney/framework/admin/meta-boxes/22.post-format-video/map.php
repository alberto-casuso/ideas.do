<?php

if(!function_exists('coney_qodef_map_post_video_meta')) {
    function coney_qodef_map_post_video_meta() {
        $video_post_format_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' =>	array('post'),
                'title' => esc_html__('Video Post Format', 'coney'),
                'name' 	=> 'post_format_video_meta'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        => 'qodef_video_type_meta',
                'type'        => 'select',
                'label'       => esc_html__('Video Type', 'coney'),
                'description' => esc_html__('Choose video type', 'coney'),
                'parent'      => $video_post_format_meta_box,
                'default_value' => 'social_networks',
                'options'     => array(
                    'social_networks' => esc_html__('Video Service', 'coney'),
                    'self' => esc_html__('Self Hosted', 'coney')
                ),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        'social_networks' => '#qodef_qodef_video_self_hosted_container',
                        'self' => '#qodef_qodef_video_embedded_container'
                    ),
                    'show' => array(
                        'social_networks' => '#qodef_qodef_video_embedded_container',
                        'self' => '#qodef_qodef_video_self_hosted_container')
                )
            )
        );

        $qodef_video_embedded_container = coney_qodef_add_admin_container(
            array(
                'parent' => $video_post_format_meta_box,
                'name' => 'qodef_video_embedded_container',
                'hidden_property' => 'qodef_video_type_meta',
                'hidden_value' => 'self'
            )
        );

        $qodef_video_self_hosted_container = coney_qodef_add_admin_container(
            array(
                'parent' => $video_post_format_meta_box,
                'name' => 'qodef_video_self_hosted_container',
                'hidden_property' => 'qodef_video_type_meta',
                'hidden_value' => 'social_networks'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        => 'qodef_post_video_link_meta',
                'type'        => 'text',
                'label'       => esc_html__('Video URL', 'coney'),
                'description' => esc_html__('Enter Video URL', 'coney'),
                'parent'      => $qodef_video_embedded_container,
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        => 'qodef_post_video_custom_meta',
                'type'        => 'text',
                'label'       => esc_html__('Video MP4', 'coney'),
                'description' => esc_html__('Enter video URL for MP4 format', 'coney'),
                'parent'      => $qodef_video_self_hosted_container,
            )
        );
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_post_video_meta', 22);
}