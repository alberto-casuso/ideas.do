<?php

if(!function_exists('coney_qodef_map_masonry_gallery_meta')) {
    function coney_qodef_map_masonry_gallery_meta() {
        $masonry_gallery_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' => array('masonry-gallery'),
                'title' => esc_html__('Masonry Gallery General', 'coney'),
                'name' => 'masonry_gallery_meta'
            )
        );


        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_masonry_gallery_item_title_tag',
                'type' => 'select',
                'default_value' => 'h4',
                'label' => esc_html__('Title Tag', 'coney'),
                'parent' => $masonry_gallery_meta_box,
                'options' => coney_qodef_get_title_tag()
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_masonry_gallery_item_text',
                'type' => 'text',
                'label' => esc_html__('Text', 'coney'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_masonry_gallery_item_image',
                'type' => 'image',
                'label' => esc_html__('Custom Item Icon', 'coney'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_masonry_gallery_item_link',
                'type' => 'text',
                'label' => esc_html__('Link', 'coney'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_masonry_gallery_item_link_target',
                'type' => 'select',
                'default_value' => '_self',
                'label' => esc_html__('Link Target', 'coney'),
                'parent' => $masonry_gallery_meta_box,
                'options' => array(
                    '_self' => esc_html__('Same Window', 'coney'),
                    '_blank' => esc_html__('New Window', 'coney')
                )
            )
        );

        coney_qodef_add_admin_section_title(array(
            'name'   => 'qodef_section_style_title',
            'parent' => $masonry_gallery_meta_box,
            'title'  => esc_html__('Masonry Gallery Item Style', 'coney')
        ));

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_masonry_gallery_item_size',
                'type' => 'select',
                'default_value' => 'square-small',
                'label' => esc_html__('Size', 'coney'),
                'parent' => $masonry_gallery_meta_box,
                'options' => array(
                    'square-small'			=> esc_html__('Square Small', 'coney'),
                    'square-big'			=> esc_html__('Square Big', 'coney'),
                    'rectangle-portrait'	=> esc_html__('Rectangle Portrait', 'coney'),
                    'rectangle-landscape'	=> esc_html__('Rectangle Landscape', 'coney')
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_masonry_gallery_item_type',
                'type' => 'select',
                'default_value' => 'standard',
                'label' => esc_html__('Type', 'coney'),
                'parent' => $masonry_gallery_meta_box,
                'options' => array(
                    'standard'		=> esc_html__('Standard', 'coney'),
                    'with-button'	=> esc_html__('With Button', 'coney'),
                    'simple'		=> esc_html__('Simple', 'coney')
                ),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        'with-button' => '#qodef_masonry_gallery_item_simple_type_container',
                        'simple' => '#qodef_masonry_gallery_item_button_type_container',
                        'standard' => '#qodef_masonry_gallery_item_button_type_container, #qodef_masonry_gallery_item_simple_type_container'
                    ),
                    'show' => array(
                        'with-button' => '#qodef_masonry_gallery_item_button_type_container',
                        'simple' => '#qodef_masonry_gallery_item_simple_type_container',
                        'standard' => ''
                    )
                )
            )
        );

        $masonry_gallery_item_button_type_container = coney_qodef_add_admin_container_no_style(array(
            'name'				=> 'masonry_gallery_item_button_type_container',
            'parent'			=> $masonry_gallery_meta_box,
            'hidden_property'	=> 'qodef_masonry_gallery_item_type',
            'hidden_values'		=> array('standard', 'simple')
        ));

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_masonry_gallery_button_label',
                'type' => 'text',
                'label' => esc_html__('Button Label', 'coney'),
                'parent' => $masonry_gallery_item_button_type_container
            )
        );

        $masonry_gallery_item_simple_type_container = coney_qodef_add_admin_container_no_style(array(
            'name'				=> 'masonry_gallery_item_simple_type_container',
            'parent'			=> $masonry_gallery_meta_box,
            'hidden_property'	=> 'qodef_masonry_gallery_item_type',
            'hidden_values'		=> array('standard', 'with-button')
        ));

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_masonry_gallery_simple_content_background_skin',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Content Background Skin', 'coney'),
                'parent' => $masonry_gallery_item_simple_type_container,
                'options' => array(
                    'default' => esc_html__('Default', 'coney'),
                    'light'	=> esc_html__('Light', 'coney'),
                    'dark'	=> esc_html__('Dark', 'coney')
                )
            )
        );
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_masonry_gallery_meta', 45);
}