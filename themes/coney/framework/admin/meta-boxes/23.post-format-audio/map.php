<?php

if(!function_exists('coney_qodef_map_post_audio_meta')) {
    function coney_qodef_map_post_audio_meta() {
        $audio_post_format_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' =>	array('post'),
                'title' => esc_html__('Audio Post Format', 'coney'),
                'name' 	=> 'post_format_audio_meta'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        => 'qodef_audio_type_meta',
                'type'        => 'select',
                'label'       => esc_html__('Audio Type', 'coney'),
                'description' => esc_html__('Choose audio type', 'coney'),
                'parent'      => $audio_post_format_meta_box,
                'default_value' => 'social_networks',
                'options'     => array(
                    'social_networks' => esc_html__('Audio Service', 'coney'),
                    'self' => esc_html__('Self Hosted', 'coney')
                ),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        'social_networks' => '#qodef_qodef_audio_self_hosted_container',
                        'self' => '#qodef_qodef_audio_embedded_container'
                    ),
                    'show' => array(
                        'social_networks' => '#qodef_qodef_audio_embedded_container',
                        'self' => '#qodef_qodef_audio_self_hosted_container')
                )
            )
        );

        $qodef_audio_embedded_container = coney_qodef_add_admin_container(
            array(
                'parent' => $audio_post_format_meta_box,
                'name' => 'qodef_audio_embedded_container',
                'hidden_property' => 'qodef_audio_type_meta',
                'hidden_value' => 'self'
            )
        );

        $qodef_audio_self_hosted_container = coney_qodef_add_admin_container(
            array(
                'parent' => $audio_post_format_meta_box,
                'name' => 'qodef_audio_self_hosted_container',
                'hidden_property' => 'qodef_audio_type_meta',
                'hidden_value' => 'social_networks'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        => 'qodef_post_audio_link_meta',
                'type'        => 'text',
                'label'       => esc_html__('Audio URL', 'coney'),
                'description' => esc_html__('Enter audio URL', 'coney'),
                'parent'      => $qodef_audio_embedded_container,
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        => 'qodef_post_audio_custom_meta',
                'type'        => 'text',
                'label'       => esc_html__('Audio Link', 'coney'),
                'description' => esc_html__('Enter audio link', 'coney'),
                'parent'      => $qodef_audio_self_hosted_container,
            )
        );
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_post_audio_meta', 23);
}