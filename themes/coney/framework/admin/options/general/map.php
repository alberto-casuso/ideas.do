<?php

if ( ! function_exists('coney_qodef_general_options_map') ) {
    /**
     * General options page
     */
    function coney_qodef_general_options_map() {

        coney_qodef_add_admin_page(
            array(
                'slug'  => '',
                'title' => esc_html__('General', 'coney'),
                'icon'  => 'fa fa-institution'
            )
        );

        $panel_design_style = coney_qodef_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_design_style',
                'title' => esc_html__('Design Style', 'coney')
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'google_fonts',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Google Font Family', 'coney'),
                'description'   => esc_html__('Choose a default Google font for your site', 'coney'),
                'parent' => $panel_design_style
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'additional_google_fonts',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Additional Google Fonts', 'coney'),
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#qodef_additional_google_fonts_container"
                )
            )
        );

        $additional_google_fonts_container = coney_qodef_add_admin_container(
            array(
                'parent'            => $panel_design_style,
                'name'              => 'additional_google_fonts_container',
                'hidden_property'   => 'additional_google_fonts',
                'hidden_value'      => 'no'
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'additional_google_font1',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'coney'),
                'description'   => esc_html__('Choose additional Google font for your site', 'coney'),
                'parent'        => $additional_google_fonts_container
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'additional_google_font2',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'coney'),
                'description'   => esc_html__('Choose additional Google font for your site', 'coney'),
                'parent'        => $additional_google_fonts_container
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'additional_google_font3',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'coney'),
                'description'   => esc_html__('Choose additional Google font for your site', 'coney'),
                'parent'        => $additional_google_fonts_container
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'additional_google_font4',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'coney'),
                'description'   => esc_html__('Choose additional Google font for your site', 'coney'),
                'parent'        => $additional_google_fonts_container
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'additional_google_font5',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'coney'),
                'description'   => esc_html__('Choose additional Google font for your site', 'coney'),
                'parent'        => $additional_google_fonts_container
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name' => 'google_font_weight',
                'type' => 'checkboxgroup',
                'default_value' => '',
                'label' => esc_html__('Google Fonts Style & Weight', 'coney'),
                'description' => esc_html__('Choose a default Google font weights for your site. Impact on page load time', 'coney'),
                'parent' => $panel_design_style,
                'options' => array(
                    '100'       => esc_html__('100 Thin', 'coney'),
                    '100italic' => esc_html__('100 Thin Italic', 'coney'),
                    '200'       => esc_html__('200 Extra-Light', 'coney'),
                    '200italic' => esc_html__('200 Extra-Light Italic', 'coney'),
                    '300'       => esc_html__('300 Light', 'coney'),
                    '300italic' => esc_html__('300 Light Italic', 'coney'),
                    '400'       => esc_html__('400 Regular', 'coney'),
                    '400italic' => esc_html__('400 Regular Italic', 'coney'),
                    '500'       => esc_html__('500 Medium', 'coney'),
                    '500italic' => esc_html__('500 Medium Italic', 'coney'),
                    '600'       => esc_html__('600 Semi-Bold', 'coney'),
                    '600italic' => esc_html__('600 Semi-Bold Italic', 'coney'),
                    '700'       => esc_html__('700 Bold', 'coney'),
                    '700italic' => esc_html__('700 Bold Italic', 'coney'),
                    '800'       => esc_html__('800 Extra-Bold', 'coney'),
                    '800italic' => esc_html__('800 Extra-Bold Italic', 'coney'),
                    '900'       => esc_html__('900 Ultra-Bold', 'coney'),
                    '900italic' => esc_html__('900 Ultra-Bold Italic', 'coney')
                )
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name' => 'google_font_subset',
                'type' => 'checkboxgroup',
                'default_value' => '',
                'label' => esc_html__('Google Fonts Subset', 'coney'),
                'description' => esc_html__('Choose a default Google font subsets for your site', 'coney'),
                'parent' => $panel_design_style,
                'options' => array(
                    'latin' => esc_html__('Latin', 'coney'),
                    'latin-ext' => esc_html__('Latin Extended', 'coney'),
                    'cyrillic' => esc_html__('Cyrillic', 'coney'),
                    'cyrillic-ext' => esc_html__('Cyrillic Extended', 'coney'),
                    'greek' => esc_html__('Greek', 'coney'),
                    'greek-ext' => esc_html__('Greek Extended', 'coney'),
                    'vietnamese' => esc_html__('Vietnamese', 'coney')
                )
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'first_color',
                'type'          => 'color',
                'label'         => esc_html__('First Main Color', 'coney'),
                'description'   => esc_html__('Choose the most dominant theme color. Default color is #00bbb3', 'coney'),
                'parent'        => $panel_design_style
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'page_background_color',
                'type'          => 'color',
                'label'         => esc_html__('Page Background Color', 'coney'),
                'description'   => esc_html__('Choose the background color for page content. Default color is #ffffff', 'coney'),
                'parent'        => $panel_design_style
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'selection_color',
                'type'          => 'color',
                'label'         => esc_html__('Text Selection Color', 'coney'),
                'description'   => esc_html__('Choose the color users see when selecting text', 'coney'),
                'parent'        => $panel_design_style
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'boxed',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Boxed Layout', 'coney'),
                'description'   => '',
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#qodef_boxed_container"
                )
            )
        );

        $boxed_container = coney_qodef_add_admin_container(
            array(
                'parent'            => $panel_design_style,
                'name'              => 'boxed_container',
                'hidden_property'   => 'boxed',
                'hidden_value'      => 'no'
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'page_background_color_in_box',
                'type'          => 'color',
                'label'         => esc_html__('Page Background Color', 'coney'),
                'description'   => esc_html__('Choose the page background color outside box', 'coney'),
                'parent'        => $boxed_container
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'boxed_background_image',
                'type'          => 'image',
                'label'         => esc_html__('Background Image', 'coney'),
                'description'   => esc_html__('Choose an image to be displayed in background', 'coney'),
                'parent'        => $boxed_container
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'boxed_pattern_background_image',
                'type'          => 'image',
                'label'         => esc_html__('Background Pattern', 'coney'),
                'description'   => esc_html__('Choose an image to be used as background pattern', 'coney'),
                'parent'        => $boxed_container
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'boxed_background_image_attachment',
                'type'          => 'select',
                'default_value' => 'fixed',
                'label'         => esc_html__('Background Image Attachment', 'coney'),
                'description'   => esc_html__('Choose background image attachment', 'coney'),
                'parent'        => $boxed_container,
                'options'       => array(
                    'fixed'     => esc_html__('Fixed', 'coney'),
                    'scroll'    => esc_html__('Scroll', 'coney')
                )
            )
        );
        
        coney_qodef_add_admin_field(
            array(
                'name'          => 'paspartu',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Passepartout', 'coney'),
                'description'   => esc_html__('Enabling this option will display passepartout around site content', 'coney'),
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#qodef_paspartu_container"
                )
            )
        );

        $paspartu_container = coney_qodef_add_admin_container(
            array(
                'parent'            => $panel_design_style,
                'name'              => 'paspartu_container',
                'hidden_property'   => 'paspartu',
                'hidden_value'      => 'no'
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'paspartu_color',
                'type'          => 'color',
                'label'         => esc_html__('Passepartout Color', 'coney'),
                'description'   => esc_html__('Choose passepartout color, default value is #ffffff', 'coney'),
                'parent'        => $paspartu_container
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name' => 'paspartu_width',
                'type' => 'text',
                'label' => esc_html__('Passepartout Size', 'coney'),
                'description' => esc_html__('Enter size amount for passepartout', 'coney'),
                'parent' => $paspartu_container,
                'args' => array(
                    'col_width' => 2,
                    'suffix' => '%'
                )
            )
        );

        coney_qodef_add_admin_field(
            array(
                'parent' => $paspartu_container,
                'type' => 'yesno',
                'default_value' => 'no',
                'name' => 'disable_top_paspartu',
                'label' => esc_html__('Disable Top Passepartout', 'coney')
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'initial_content_width',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Initial Width of Content', 'coney'),
                'description'   => esc_html__('Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'coney'),
                'parent'        => $panel_design_style,
                'options'       => array(
                    'qodef-grid-1100' => esc_html__('1100px - default', 'coney'),
                    'qodef-grid-1300' => esc_html__('1300px', 'coney'),
                    'qodef-grid-1200' => esc_html__('1200px', 'coney'),
                    'qodef-grid-1000' => esc_html__('1000px', 'coney'),
                    'qodef-grid-800'  => esc_html__('800px', 'coney')
                )
            )
        );

        $panel_settings = coney_qodef_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_settings',
                'title' => esc_html__('Settings', 'coney')
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'smooth_page_transitions',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Smooth Page Transitions', 'coney'),
                'description'   => esc_html__('Enabling this option will perform a smooth transition between pages when clicking on links', 'coney'),
                'parent'        => $panel_settings,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#qodef_page_transitions_container"
                )
            )
        );

        $page_transitions_container = coney_qodef_add_admin_container(
            array(
                'parent'          => $panel_settings,
                'name'            => 'page_transitions_container',
                'hidden_property' => 'smooth_page_transitions',
                'hidden_value'    => 'no'
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'page_transition_preloader',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__( 'Enable Preloading Animation', 'coney' ),
                'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'coney' ),
                'parent'        => $page_transitions_container,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#qodef_page_transition_preloader_container"
                )
            )
        );

        $page_transition_preloader_container = coney_qodef_add_admin_container(
            array(
                'parent'          => $page_transitions_container,
                'name'            => 'page_transition_preloader_container',
                'hidden_property' => 'page_transition_preloader',
                'hidden_value'    => 'no'
            )
        );


        coney_qodef_add_admin_field(
            array(
                'name'   => 'smooth_pt_bgnd_color',
                'type'   => 'color',
                'label'  => esc_html__( 'Page Loader Background Color', 'coney' ),
                'parent' => $page_transition_preloader_container
            )
        );

        $group_pt_spinner_animation = coney_qodef_add_admin_group(
            array(
                'name'        => 'group_pt_spinner_animation',
                'title'       => esc_html__( 'Loader Style', 'coney' ),
                'description' => esc_html__( 'Define styles for loader spinner animation', 'coney' ),
                'parent'      => $page_transition_preloader_container
            )
        );

        $row_pt_spinner_animation = coney_qodef_add_admin_row(
            array(
                'name'   => 'row_pt_spinner_animation',
                'parent' => $group_pt_spinner_animation
            )
        );

        coney_qodef_add_admin_field(
            array(
                'type'          => 'selectsimple',
                'name'          => 'smooth_pt_spinner_type',
                'default_value' => '',
                'label'         => esc_html__( 'Spinner Type', 'coney' ),
                'parent'        => $row_pt_spinner_animation,
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

        coney_qodef_add_admin_field(
            array(
                'type'          => 'colorsimple',
                'name'          => 'smooth_pt_spinner_color',
                'default_value' => '',
                'label'         => esc_html__( 'Spinner Color', 'coney' ),
                'parent'        => $row_pt_spinner_animation
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'page_transition_fadeout',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__( 'Enable Fade Out Animation', 'coney' ),
                'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'coney' ),
                'parent'        => $page_transitions_container
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'show_back_button',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Show "Back To Top Button"', 'coney'),
                'description'   => esc_html__('Enabling this option will display a Back to Top button on every page', 'coney'),
                'parent'        => $panel_settings
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'responsiveness',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Responsiveness', 'coney'),
                'description'   => esc_html__('Enabling this option will make all pages responsive', 'coney'),
                'parent'        => $panel_settings
            )
        );

        $panel_custom_code = coney_qodef_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_custom_code',
                'title' => esc_html__('Custom Code', 'coney')
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'custom_css',
                'type'          => 'textarea',
                'label'         => esc_html__('Custom CSS', 'coney'),
                'description'   => esc_html__('Enter your custom CSS here', 'coney'),
                'parent'        => $panel_custom_code
            )
        );

        coney_qodef_add_admin_field(
            array(
                'name'          => 'custom_js',
                'type'          => 'textarea',
                'label'         => esc_html__('Custom JS', 'coney'),
                'description'   => esc_html__('Enter your custom Javascript here', 'coney'),
                'parent'        => $panel_custom_code
            )
        );
	
	    $panel_google_api = coney_qodef_add_admin_panel(
		    array(
			    'page'  => '',
			    'name'  => 'panel_google_api',
			    'title' => esc_html__('Google API', 'coney')
		    )
	    );
	
	    coney_qodef_add_admin_field(
		    array(
			    'name'        => 'google_maps_api_key',
			    'type'        => 'text',
			    'label'       => esc_html__('Google Maps Api Key', 'coney'),
			    'description' => esc_html__('Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'coney'),
			    'parent'      => $panel_google_api
		    )
	    );
    }

    add_action( 'coney_qodef_options_map', 'coney_qodef_general_options_map', 1);
}