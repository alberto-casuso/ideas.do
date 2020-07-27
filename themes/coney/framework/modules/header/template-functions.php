<?php

use ConeyQodef\Modules\Header\Lib\HeaderFactory;

if(!function_exists('coney_qodef_get_header')) {
    /**
     * Loads header HTML based on header type option. Sets all necessary parameters for header
     * and defines coney_qodef_header_type_parameters filter
     */
    function coney_qodef_get_header() {
        //will be read from options
        $header_type = coney_qodef_get_meta_field_intersect('header_type');

        $header_in_grid = coney_qodef_get_meta_field_intersect('enable_grid_layout_header');

	    $set_menu_area_position = coney_qodef_get_meta_field_intersect('set_menu_area_position');
	
	    $vertical_header_text_align = coney_qodef_get_meta_field_intersect('vertical_header_text_align');

		$logo_text_header_classic = coney_qodef_options()->getOptionValue('logo_text_header_classic');
	    
	    $header_behavior = coney_qodef_options()->getOptionValue('header_behaviour');
	
	    if(HeaderFactory::getInstance()->validHeaderObject()) {
            $parameters = array(
                'hide_logo' => coney_qodef_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
                'header_in_grid' => $header_in_grid == 'yes' ? true : false,
	            'standard_menu_area_class' => !empty($set_menu_area_position) ? 'qodef-menu-'.$set_menu_area_position : 'qodef-menu-center',
	            'set_menu_area_position' => $set_menu_area_position,
                'vertical_text_align_class' => !empty($vertical_header_text_align) ? $vertical_header_text_align : '',
                'logo_text' => !empty($logo_text_header_classic) ? $logo_text_header_classic : '',
                'show_sticky' => in_array($header_behavior, array(
                    'sticky-header-on-scroll-up',
                    'sticky-header-on-scroll-down-up'
                )) ? true : false,
                'show_fixed_wrapper' => in_array($header_behavior, array('fixed-on-scroll')) ? true : false
            );

            $parameters = apply_filters('coney_qodef_header_type_parameters', $parameters, $header_type);

            HeaderFactory::getInstance()->getHeaderObject()->loadTemplate($parameters);
        }
    }
}

if(!function_exists('coney_qodef_get_header_top')) {
    /**
     * Loads header top HTML and sets parameters for it
     */
    function coney_qodef_get_header_top() {

        //generate column width class
        switch(coney_qodef_options()->getOptionValue('top_bar_layout')) {
            case ('two-columns'):
                $column_widht_class = '50-50';
                break;
            case ('three-columns'):
                $column_widht_class = coney_qodef_options()->getOptionValue('top_bar_column_widths');
                break;
        }

        $params = array(
            'column_widths'      => $column_widht_class,
            'show_widget_center' => coney_qodef_options()->getOptionValue('top_bar_layout') === 'three-columns' ? true : false,
            'show_header_top'    => coney_qodef_get_meta_field_intersect('top_bar') === 'yes' ? true : false,
            'top_bar_in_grid'    => coney_qodef_get_meta_field_intersect('top_bar_in_grid') === 'yes' ? true : false
        );

        $params = apply_filters('coney_qodef_header_top_params', $params);

        coney_qodef_get_module_template_part('templates/parts/header-top', 'header', '', $params);
    }
}

if(!function_exists('coney_qodef_get_logo')) {
    /**
     * Loads logo HTML
     *
     * @param $slug
     */
    function coney_qodef_get_logo($slug = '') {

        $slug = $slug !== '' ? $slug : coney_qodef_options()->getOptionValue('header_type');

        if ($slug == 'sticky'){
            $logo_image = coney_qodef_options()->getOptionValue('logo_image_sticky');
        } else if ($slug == 'classic'){
			$logo_image = coney_qodef_options()->getOptionValue('logo_image_classic_header');
		} else if ($slug == 'divided'){
            $logo_image = coney_qodef_options()->getOptionValue('logo_image_divided_header');
        } else if ($slug == 'vertical'){
	        $logo_image = coney_qodef_options()->getOptionValue('logo_image_vertical_header');
        } else {
            $logo_image = coney_qodef_options()->getOptionValue('logo_image');
        }

        $logo_image_dark = coney_qodef_options()->getOptionValue('logo_image_dark');
        $logo_image_light = coney_qodef_options()->getOptionValue('logo_image_light');
		$logo_image_fullscreen = coney_qodef_options()->getOptionValue('fullscreen_logo');

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = coney_qodef_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px;'; //divided with 2 because of retina screens
        }

        $params = array(
            'logo_image'  => $logo_image,
            'logo_image_dark' => $logo_image_dark,
            'logo_image_light' => $logo_image_light,
			'logo_image_fullscreen' => $logo_image_fullscreen,
            'logo_styles' => $logo_styles
        );

        coney_qodef_get_module_template_part('templates/parts/logo', 'header', $slug, $params);
    }
}

if(!function_exists('coney_qodef_get_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function coney_qodef_get_main_menu($additional_class = 'qodef-default-nav') {
        coney_qodef_get_module_template_part('templates/parts/navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('coney_qodef_get_full_screen_opener')) {
	/**
	 * Loads main menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function coney_qodef_get_full_screen_opener() {
		coney_qodef_get_module_template_part('templates/parts/full-screen-opener', 'header', '');
	}
}

if(!function_exists('coney_qodef_get_header_widget_area')) {
	/**
	 * Loads header widgets area HTML
	 */
	function coney_qodef_get_header_widget_area() {
		$page_id = coney_qodef_get_page_id();
		if(coney_qodef_is_woocommerce_installed() && coney_qodef_is_woocommerce_shop()) {
			//get shop page id from options table
			$shop_id = get_option('woocommerce_shop_page_id');
			
			if(!empty($shop_id)) {
				$page_id = $shop_id;
			} else {
				$page_id = '-1';
			}
		}
		
        if(get_post_meta($page_id, 'qodef_disable_header_widget_area_meta', 'true') !== 'yes') {
            if(is_active_sidebar('qodef-header-widget-area') && get_post_meta($page_id, 'qodef_custom_header_sidebar_meta', true) === '') {
                dynamic_sidebar('qodef-header-widget-area');
            } else if (get_post_meta($page_id, 'qodef_custom_header_sidebar_meta', true) !== '') {
                $sidebar = get_post_meta($page_id, 'qodef_custom_header_sidebar_meta', true);
                if (is_active_sidebar($sidebar)) {
                    dynamic_sidebar($sidebar);
                }
            }
        }
	}
}

if(!function_exists('coney_qodef_get_divided_left_main_menu')) {
	/**
	 * Loads main menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function coney_qodef_get_divided_left_main_menu($additional_class = 'qodef-default-nav') {
		coney_qodef_get_module_template_part('templates/parts/divided-left-navigation', 'header', '', array('additional_class' => $additional_class));
	}
}

if(!function_exists('coney_qodef_get_divided_right_main_menu')) {
	/**
	 * Loads main menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function coney_qodef_get_divided_right_main_menu($additional_class = 'qodef-default-nav') {
		coney_qodef_get_module_template_part('templates/parts/divided-right-navigation', 'header', '', array('additional_class' => $additional_class));
	}
}

if(!function_exists('coney_qodef_get_vertical_main_menu')) {
	/**
	 * Loads vertical menu HTML
	 */
	function coney_qodef_get_vertical_main_menu() {
		coney_qodef_get_module_template_part('templates/parts/vertical-navigation', 'header', '');
	}
}

if(!function_exists('coney_qodef_get_sticky_menu')) {
	/**
	 * Loads sticky menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function coney_qodef_get_sticky_menu($additional_class = 'qodef-default-nav') {
		coney_qodef_get_module_template_part('templates/parts/sticky-navigation', 'header', '', array('additional_class' => $additional_class));
	}
}

if(!function_exists('coney_qodef_get_sticky_header')) {
    /**
     * Loads sticky header behavior HTML
     */
    function coney_qodef_get_sticky_header() {

        $set_menu_area_position = coney_qodef_get_meta_field_intersect('set_sticky_menu_area_position');

        $parameters = array(
            'hide_logo'                 => coney_qodef_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
            'standard_menu_area_class'  => !empty($set_menu_area_position) ? 'qodef-menu-'.$set_menu_area_position : 'qodef-menu-center',
            'sticky_header_in_grid'     => coney_qodef_get_meta_field_intersect('sticky_header_in_grid') == 'yes' ? true : false,
            'set_menu_area_position'    => $set_menu_area_position
        );

        coney_qodef_get_module_template_part('templates/behaviors/sticky-header', 'header', '', $parameters);
    }
}

if(!function_exists('coney_qodef_get_mobile_header')) {
    /**
     * Loads mobile header HTML only if responsiveness is enabled
     */
    function coney_qodef_get_mobile_header() {
        if(coney_qodef_is_responsive_on()) {

            $mobile_menu_title = coney_qodef_options()->getOptionValue('mobile_menu_title');

            $has_navigation = false;
            if(has_nav_menu('main-navigation') || has_nav_menu('mobile-navigation')) {
                $has_navigation = true;
            }

            $parameters = array(
                'show_logo'              => coney_qodef_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
                'show_navigation_opener' => $has_navigation,
                'mobile_menu_title'      => $mobile_menu_title
            );

            coney_qodef_get_module_template_part('templates/types/mobile-header', 'header', '', $parameters);
        }
    }
}

if(!function_exists('coney_qodef_get_mobile_logo')) {
    /**
     * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
     *
     * @param string $slug
     */
    function coney_qodef_get_mobile_logo($slug = '') {

        $slug = $slug !== '' ? $slug : coney_qodef_options()->getOptionValue('header_type');

        //check if mobile logo has been set and use that, else use normal logo
        if(coney_qodef_options()->getOptionValue('logo_image_mobile') !== '') {
            $logo_image = coney_qodef_options()->getOptionValue('logo_image_mobile');
        } else {
            $logo_image = coney_qodef_options()->getOptionValue('logo_image');
        }

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = coney_qodef_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px'; //divided with 2 because of retina screens
        }

        //set parameters for logo
        $parameters = array(
            'logo_image'      => $logo_image,
            'logo_dimensions' => $logo_dimensions,
            'logo_height'     => $logo_height,
            'logo_styles'     => $logo_styles
        );

        coney_qodef_get_module_template_part('templates/parts/mobile-logo', 'header', $slug, $parameters);
    }
}

if(!function_exists('coney_qodef_get_mobile_nav')) {
    /**
     * Loads mobile navigation HTML
     */
    function coney_qodef_get_mobile_nav() {

        coney_qodef_get_module_template_part('templates/parts/mobile-navigation', 'header', '');
    }
}

if( !function_exists('coney_qodef_header_area_style') ) {
	/**
	 * Function that return styles for header area
	 */
	function coney_qodef_header_area_style($style) {
		$id = coney_qodef_get_page_id();
		$class_id = coney_qodef_get_page_id();
		if(coney_qodef_is_woocommerce_installed() && is_product()) {
			$class_id = get_the_ID();
		}
		
		$class_prefix = coney_qodef_get_unique_page_class($class_id);
		
		$current_styles = '';
		
		$header_styles = array();
		$header_selector = array(
			$class_prefix . ' .qodef-page-header'
		);
		
		$menu_styles = array();
		$menu_selector = array(
			$class_prefix . ' .qodef-page-header .qodef-menu-area'
		);
		$vertical_header_styles = array();
		$vertical_header_selector = array(
			$class_prefix . '.qodef-header-vertical .qodef-vertical-area-background'
		);
		
		$header_background_color                 = '';
		$header_border_color                     = '';
		$header_border_top_color                 = '';
		$vertical_header_background_color        = '';
		$vertical_header_background_transparency = '';
		$vertical_header_background_image        = '';
		
		$background_color = get_post_meta($id, 'qodef_header_area_background_color_meta', true);
		$background_transparency = get_post_meta($id, 'qodef_header_area_background_transparency_meta', true);
		$border_top_color = get_post_meta($id, 'qodef_header_area_border_top_color_meta', true);
		$border_bottom_color = get_post_meta($id, 'qodef_header_area_border_color_meta', true);
		$background_image = get_post_meta($id, 'qodef_vertical_header_background_image_meta', true);
		$disable_background_image = get_post_meta($id, 'qodef_disable_vertical_header_background_image_meta', true);


		if(!empty($background_color)) {
			$header_background_color = $background_color;
			$vertical_header_background_color = $background_color;
				
			if($background_transparency !== '') {
				$header_background_transparency = $background_transparency;
				$vertical_header_background_transparency = $background_transparency;
				
				$header_background_color = coney_qodef_rgba_color($header_background_color, $header_background_transparency);
			}
		}
		
		if(!empty($border_bottom_color)) {
			$header_border_color = $border_bottom_color;
		}

		if(!empty($border_top_color)) {
			$header_border_top_color = $border_top_color;
		}
		
		if($disable_background_image === 'yes') {
			$vertical_header_background_image = 'none';
		} else if (!empty($background_image)) {
			$vertical_header_background_image = 'url('.$background_image.')';
		}
		
		if(!empty($header_background_color)) {
			$header_styles['background-color'] = $header_background_color;
			$current_styles .= coney_qodef_dynamic_css($header_selector, $header_styles);
		}

		if(!empty($header_border_color)) {
			$menu_styles['border-bottom-color'] = $header_border_color;
			$current_styles .= coney_qodef_dynamic_css($menu_selector, $menu_styles);
		}

		if(!empty($header_border_top_color)) {
			$menu_styles['border-top-color'] = $header_border_top_color;
			$current_styles .= coney_qodef_dynamic_css($menu_selector, $menu_styles);
		}
		
		if(!empty($vertical_header_background_color)) {
			$vertical_header_styles['background-color'] = $vertical_header_background_color;
		}
		
		if($vertical_header_background_transparency !== '') {
			$vertical_header_styles['opacity'] = $vertical_header_background_transparency;
		}
		
		if(!empty($vertical_header_background_image)) {
			$vertical_header_styles['background-image'] = $vertical_header_background_image;
		}
		
		if(!empty($vertical_header_background_color) || $vertical_header_background_transparency !== '' || !empty($vertical_header_background_image)) {
			$current_styles .= coney_qodef_dynamic_css($vertical_header_selector, $vertical_header_styles);
		}
		
		$current_style = $current_styles . $style;
		
		return $current_style;
	}
	
	add_filter('coney_qodef_add_page_custom_style', 'coney_qodef_header_area_style');
}