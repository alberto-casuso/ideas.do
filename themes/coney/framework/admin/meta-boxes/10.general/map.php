<?php

if(!function_exists('coney_qodef_map_general_meta')) {

    function coney_qodef_map_general_meta() {

        $general_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('General', 'coney'),
                'name' => 'general_meta'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_page_background_color_meta',
                'type' => 'color',
                'label' => esc_html__('Page Background Color', 'coney'),
                'description' => esc_html__('Choose background color for page content', 'coney'),
                'parent' => $general_meta_box
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_page_slider_meta',
                'type' => 'text',
                'default_value' => '',
                'label' => esc_html__('Slider Shortcode', 'coney'),
                'description' => esc_html__('Paste your slider shortcode here', 'coney'),
                'parent' => $general_meta_box
            )
        );

        $qodef_content_padding_group = coney_qodef_add_admin_group(array(
            'name' => 'content_padding_group',
            'title' => esc_html__('Content Style', 'coney'),
            'description' => esc_html__('Define styles for Content area', 'coney'),
            'parent' => $general_meta_box
        ));

        $qodef_content_padding_row = coney_qodef_add_admin_row(array(
            'name' => 'qodef_content_padding_row',
            'next' => true,
            'parent' => $qodef_content_padding_group
        ));

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_page_content_top_padding',
                'type' => 'textsimple',
                'default_value' => '',
                'label' => esc_html__('Content Top Padding', 'coney'),
                'parent' => $qodef_content_padding_row,
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_page_content_bottom_padding',
                'type' => 'textsimple',
                'default_value' => '',
                'label' => esc_html__('Content Bottom Padding', 'coney'),
                'parent' => $qodef_content_padding_row,
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_page_content_padding_mobile',
                'type' => 'selectsimple',
                'label' => esc_html__('Set this padding for mobile header', 'coney'),
                'parent' => $qodef_content_padding_row,
                'options' => coney_qodef_get_yes_no_select_array(false)
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_page_comments_meta',
                'type' => 'select',
                'label' => esc_html__('Show Comments', 'coney'),
                'description' => esc_html__('Enabling this option will show comments on your page', 'coney'),
                'parent' => $general_meta_box,
                'options' => coney_qodef_get_yes_no_select_array()
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_boxed_meta',
                'type' => 'select',
                'label' => esc_html__('Boxed Layout', 'coney'),
                'description' => esc_html__('Enabling this option will show boxed layout', 'coney'),
                'parent' => $general_meta_box,
                'default_value' => '',
                'options' => array(
                    '' => esc_html__( 'Default', 'coney'),
                    'yes' => esc_html__('Yes', 'coney'),
                    'no' => esc_html__('No', 'coney')
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_search_type_meta',
                'type' => 'select',
                'label' => esc_html__('Select Search Type', 'coney'),
                'description' => esc_html__('Choose a type of Select search bar - Note: Slide From Header Bottom search type does not work with Vertical Header', 'coney'),
                'parent' => $general_meta_box,
                'default_value' => '',
                'options' => array(
                    '' => esc_html__( 'Default', 'coney'),
                    'fullscreen' => esc_html__('Fullscreen Search', 'coney'),
                    'slide-from-header-bottom' => esc_html__('Slide From Header Bottom', 'coney'),
                    'slide-from-icon' => esc_html__('Slide From Icon' , 'coney')
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'          => 'qodef_smooth_page_transitions_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__( 'Smooth Page Transitions', 'coney' ),
                'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'coney' ),
                'parent'        => $general_meta_box,
                'options'     => coney_qodef_get_yes_no_select_array(),
                'args'          => array(
                    "dependence"             => true,
                    "hide"       => array(
                        ""    => "#qodef_page_transitions_container_meta",
                        "no"  => "#qodef_page_transitions_container_meta",
                        "yes" => ""
                    ),
                    "show"       => array(
                        ""    => "",
                        "no"  => "",
                        "yes" => "#qodef_page_transitions_container_meta"
                    )
                )
            )
        );

        $page_transitions_container_meta = coney_qodef_add_admin_container(
            array(
                'parent'          => $general_meta_box,
                'name'            => 'page_transitions_container_meta',
                'hidden_property' => 'qodef_smooth_page_transitions_meta',
                'hidden_values'   => array('','no')
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'          => 'qodef_page_transition_preloader_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__( 'Enable Preloading Animation', 'coney' ),
                'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'coney' ),
                'parent'        => $page_transitions_container_meta,
                'options'     => coney_qodef_get_yes_no_select_array(),
                'args'          => array(
                    "dependence"             => true,
                    "hide"       => array(
                        ""    => "#qodef_page_transition_preloader_container_meta",
                        "no"  => "#qodef_page_transition_preloader_container_meta",
                        "yes" => ""
                    ),
                    "show"       => array(
                        ""    => "",
                        "no"  => "",
                        "yes" => "#qodef_page_transition_preloader_container_meta"
                    )
                )
            )
        );

        $page_transition_preloader_container_meta = coney_qodef_add_admin_container(
            array(
                'parent'          => $page_transitions_container_meta,
                'name'            => 'page_transition_preloader_container_meta',
                'hidden_property' => 'qodef_page_transition_preloader_meta',
                'hidden_values'   => array('','no')
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'   => 'qodef_smooth_pt_bgnd_color_meta',
                'type'   => 'color',
                'label'  => esc_html__( 'Page Loader Background Color', 'coney' ),
                'parent' => $page_transition_preloader_container_meta
            )
        );

        $group_pt_spinner_animation_meta = coney_qodef_add_admin_group(
            array(
                'name'        => 'group_pt_spinner_animation_meta',
                'title'       => esc_html__( 'Loader Style', 'coney' ),
                'description' => esc_html__( 'Define styles for loader spinner animation', 'coney' ),
                'parent'      => $page_transition_preloader_container_meta
            )
        );

        $row_pt_spinner_animation_meta = coney_qodef_add_admin_row(
            array(
                'name'   => 'row_pt_spinner_animation_meta',
                'parent' => $group_pt_spinner_animation_meta
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'type'          => 'selectsimple',
                'name'          => 'qodef_smooth_pt_spinner_type_meta',
                'default_value' => '',
                'label'         => esc_html__( 'Spinner Type', 'coney' ),
                'parent'        => $row_pt_spinner_animation_meta,
                'options'       => array(
                    'rotate_circles'        => esc_html__( 'Rotate Circles', 'coney' ),
                    'pulse'                 => esc_html__( 'Pulse', 'coney' ),
                    'double_pulse'          => esc_html__( 'Double Pulse', 'coney' ),
                    'cube'                  => esc_html__( 'Cube', 'coney' ),
                    'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'coney' ),
                    'stripes'               => esc_html__( 'Stripes', 'coney' ),
                    'wave'                  => esc_html__( 'Wave', 'coney' ),
                    'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'coney' ),
                    'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'coney' ),
                    'atom'                  => esc_html__( 'Atom', 'coney' ),
                    'clock'                 => esc_html__( 'Clock', 'coney' ),
                    'mitosis'               => esc_html__( 'Mitosis', 'coney' ),
                    'lines'                 => esc_html__( 'Lines', 'coney' ),
                    'fussion'               => esc_html__( 'Fussion', 'coney' ),
                    'wave_circles'          => esc_html__( 'Wave Circles', 'coney' ),
                    'pulse_circles'         => esc_html__( 'Pulse Circles', 'coney' ),
                    'progress_loader'       => esc_html__('Progress Loader', 'coney')
                )
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'type'          => 'colorsimple',
                'name'          => 'qodef_smooth_pt_spinner_color_meta',
                'default_value' => '',
                'label'         => esc_html__( 'Spinner Color', 'coney' ),
                'parent'        => $row_pt_spinner_animation_meta
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'          => 'qodef_page_transition_fadeout_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__( 'Enable Fade Out Animation', 'coney' ),
                'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'coney' ),
                'options'     => coney_qodef_get_yes_no_select_array(),
                'parent'        => $page_transitions_container_meta

            )
        );
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_general_meta', 10);
}