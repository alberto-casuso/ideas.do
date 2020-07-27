<?php

if(!function_exists('coney_qodef_header_top_bar_styles')) {
    /**
     * Generates styles for header top bar
     */
    function coney_qodef_header_top_bar_styles() {
    	$top_header_height = coney_qodef_options()->getOptionValue('top_bar_height');
        if(!empty($top_header_height)) {
            echo coney_qodef_dynamic_css('.qodef-top-bar', array('height' => coney_qodef_filter_px($top_header_height).'px'));
            echo coney_qodef_dynamic_css('.qodef-top-bar .qodef-logo-wrapper a', array('max-height' => coney_qodef_filter_px($top_header_height).'px'));
        }

        $background_color = coney_qodef_options()->getOptionValue('top_bar_background_color');
        $top_bar_styles = array();
        if($background_color !== '') {
            $background_transparency = 1;
            if(coney_qodef_options()->getOptionValue('top_bar_background_transparency') !== '') {
               $background_transparency = coney_qodef_options()->getOptionValue('top_bar_background_transparency');
            }

            $background_color = coney_qodef_rgba_color($background_color, $background_transparency);
            $top_bar_styles['background-color'] = $background_color;
        }

		$top_bar_classes = array('.qodef-top-bar','.qodef-top-dark .qodef-top-bar','.qodef-top-light .qodef-top-bar');

        echo coney_qodef_dynamic_css($top_bar_classes, $top_bar_styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_header_top_bar_styles');
}

if(!function_exists('coney_qodef_header_area_styles')) {
    /**
     * Generates styles for header area
     */
    function coney_qodef_header_area_styles() {
        $header_styles = array();
		$background_color = coney_qodef_options()->getOptionValue('header_area_background_color');
	    $background_transparency = coney_qodef_options()->getOptionValue('header_area_background_transparency');
	    $border_color = coney_qodef_options()->getOptionValue('header_area_border_color');
		$border_top_color = coney_qodef_options()->getOptionValue('header_area_border_top_color');

	    if(!empty($background_color)) {
		    $header_background_color        = $background_color;
		    $header_background_transparency = 1;
		
		    if($background_transparency !== '') {
			    $header_background_transparency = $background_transparency;
            }
            
            $header_styles['background-color'] = coney_qodef_rgba_color($header_background_color, $header_background_transparency);
        }
        
        if(empty($background_color) && $background_transparency !== '') {
	        $header_background_color        = '#fff';
	        $header_background_transparency = $background_transparency;
            
            $header_styles['background-color'] = coney_qodef_rgba_color($header_background_color, $header_background_transparency);
        }

        $header_selectors = array(
            '.qodef-page-header'
        );
        
        echo coney_qodef_dynamic_css($header_selectors, $header_styles);
        
        $menu_styles = array();
		$menu_selectors = array(
			'.qodef-page-header .qodef-menu-area'
		);

	
	    if(!empty($border_color)) {
	        $menu_styles['border-bottom-color'] = $border_color;
        }

		if(!empty($border_top_color)) {
			$menu_styles['border-top-color'] = $border_top_color;
		}
        
        echo coney_qodef_dynamic_css($menu_selectors, $menu_styles);
    }
    
    add_action('coney_qodef_style_dynamic', 'coney_qodef_header_area_styles');
}

if(!function_exists('coney_qodef_header_standard_menu_area_styles')) {
    /**
     * Generates styles for header standard menu
     */
    function coney_qodef_header_standard_menu_area_styles() {
        $styles = array();
	
	    $selectors = array(
		    '.qodef-header-standard .qodef-page-header .qodef-menu-area'
	    );
	    
	    $header_height = coney_qodef_options()->getOptionValue('menu_area_height_header_standard');
	
	    if(!empty($header_height)) {
            $max_height = intval(coney_qodef_filter_px($header_height)).'px';
            echo coney_qodef_dynamic_css('.qodef-header-standard .qodef-page-header .qodef-logo-wrapper a', array('max-height' => $max_height));

            $styles['height'] = coney_qodef_filter_px($header_height).'px';
        }

        echo coney_qodef_dynamic_css($selectors, $styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_header_standard_menu_area_styles');
}

if(!function_exists('coney_qodef_header_classic_menu_area_styles')) {
    /**
     * Generates styles for header classic menu
     */
    function coney_qodef_header_classic_menu_area_styles() {
        $logo_styles = array();
	
	    $logo_selectors = array(
		    '.qodef-header-classic .qodef-page-header .qodef-logo-area'
	    );
	
	    $logo_height = coney_qodef_options()->getOptionValue('logo_area_height_header_classic');
	
	    if(!empty($logo_height)) {
            $max_height = intval(coney_qodef_filter_px($logo_height)).'px';
            echo coney_qodef_dynamic_css('.qodef-header-classic .qodef-page-header .qodef-logo-wrapper a', array('max-height' => $max_height));
	
	        $logo_styles['height'] = coney_qodef_filter_px($logo_height).'px';
        }
        
        echo coney_qodef_dynamic_css($logo_selectors, $logo_styles);
        
        $menu_styles = array();
	
	    $menu_selectors = array(
		    '.qodef-header-classic .qodef-page-header .qodef-menu-area'
	    );
	
	    $menu_height = coney_qodef_options()->getOptionValue('menu_area_height_header_classic');
	
	    if(!empty($menu_height)) {
	        $menu_styles['height'] = coney_qodef_filter_px($menu_height).'px';
        }
        
        echo coney_qodef_dynamic_css($menu_selectors, $menu_styles);
    }
    
    add_action('coney_qodef_style_dynamic', 'coney_qodef_header_classic_menu_area_styles');
}

if(!function_exists('coney_qodef_header_classic_logo_area_styles')) {
    /**
     * Generates styles for classic header type logo element
     */
    function coney_qodef_header_classic_logo_area_styles() {
        $styles = array();
	
	    $selectors = array(
		    '.qodef-header-classic .qodef-logo-area .qodef-logo-wrapper'
	    );
	
	    $logo_top_padding = coney_qodef_options()->getOptionValue('logo_area_top_padding_header_classic');
	
	    if(!empty($logo_top_padding)) {
            $styles['padding-top'] = coney_qodef_filter_px($logo_top_padding).'px';
        }
	    
        echo coney_qodef_dynamic_css($selectors, $styles);
    }
    
    add_action('coney_qodef_style_dynamic', 'coney_qodef_header_classic_logo_area_styles');
}

if(!function_exists('coney_qodef_divided_menu_area_styles')) {
    /**
     * Generates styles for header divided menu
     */
    function coney_qodef_divided_menu_area_styles() {
        $styles = array();
	
	    $selectors = array(
		    '.qodef-header-divided .qodef-page-header .qodef-menu-area'
	    );
	
	    $header_height = coney_qodef_options()->getOptionValue('menu_area_height_header_divided');
	
	    if(!empty($header_height)) {
            $max_height = intval(coney_qodef_filter_px($header_height)).'px';
            echo coney_qodef_dynamic_css('.qodef-header-divided .qodef-page-header .qodef-logo-wrapper a', array('max-height' => $max_height));
            
            $styles['height'] = coney_qodef_filter_px($header_height).'px';
        }
        
        echo coney_qodef_dynamic_css($selectors, $styles);
    }
    
    add_action('coney_qodef_style_dynamic', 'coney_qodef_divided_menu_area_styles');
}

if(!function_exists('coney_qodef_header_full_screen_menu_area_styles')) {
    /**
     * Generates styles for header full_screen menu
     */
    function coney_qodef_header_full_screen_menu_area_styles() {
        $styles = array();
	
	    $selectors = array(
		    '.qodef-header-full-screen .qodef-page-header .qodef-menu-area'
	    );
	
	    $header_height = coney_qodef_options()->getOptionValue('menu_area_height_header_full_screen');
	
	    if(!empty($header_height)) {
            $max_height = intval(coney_qodef_filter_px($header_height)).'px';
            echo coney_qodef_dynamic_css('.qodef-header-full-screen .qodef-page-header .qodef-logo-wrapper a', array('max-height' => $max_height));

            $styles['height'] = coney_qodef_filter_px($header_height).'px';

        }

        echo coney_qodef_dynamic_css($selectors, $styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_header_full_screen_menu_area_styles');
}

if(!function_exists('coney_qodef_vertical_menu_styles')) {
    function coney_qodef_vertical_menu_styles() {
        $styles = array();

        $selectors = array(
            '.qodef-header-vertical .qodef-vertical-area-background'
        );
	    
	    $background_color = coney_qodef_options()->getOptionValue('header_area_background_color');
	    $background_transparency = coney_qodef_options()->getOptionValue('header_area_background_transparency');
	    $background_image = coney_qodef_options()->getOptionValue('vertical_header_background_image');

        if(!empty($background_color)) {
            $styles['background-color'] = $background_color;
        }

        if($background_transparency !== '') {
            $styles['opacity'] = $background_transparency;
        }

        if(!empty($background_image)) {
            $styles['background-image'] = 'url('.$background_image.')';
        }

        echo coney_qodef_dynamic_css($selectors, $styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_vertical_menu_styles');
}

if(!function_exists('coney_qodef_vertical_holder_styles')) {
    function coney_qodef_vertical_holder_styles() {
        $styles = array();

        $selectors = array(
            '.qodef-header-vertical .qodef-vertical-menu-area-inner'
        );
	    
	    $text_alignment = coney_qodef_options()->getOptionValue('vertical_header_text_align');

        if(!empty($text_alignment)) {
            $styles['text-align'] = $text_alignment;
        }

        echo coney_qodef_dynamic_css($selectors, $styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_vertical_holder_styles');
}

if(!function_exists('coney_qodef_sticky_header_styles')) {
    /**
     * Generates styles for sticky haeder
     */
    function coney_qodef_sticky_header_styles() {
    	$background_color = coney_qodef_options()->getOptionValue('sticky_header_background_color');
	    $background_transparency = coney_qodef_options()->getOptionValue('sticky_header_transparency');
	    $border_color = coney_qodef_options()->getOptionValue('sticky_header_border_color');
	    $header_height = coney_qodef_options()->getOptionValue('sticky_header_height');
    	
        if(!empty($background_color)) {
            $header_background_color              = $background_color;
            $header_background_color_transparency = 1;
		
		    if($background_transparency !== '') {
                $header_background_color_transparency = $background_transparency;
            }

            echo coney_qodef_dynamic_css('.qodef-page-header .qodef-sticky-header .qodef-sticky-holder', array('background-color' => coney_qodef_rgba_color($header_background_color, $header_background_color_transparency)));
        }
	
	    if(!empty($border_color)) {
		    echo coney_qodef_dynamic_css('.qodef-page-header .qodef-sticky-header .qodef-sticky-holder', array('border-color' => $border_color));
        }
	
	    if(!empty($header_height)) {
            $height = coney_qodef_filter_px($header_height).'px';

            echo coney_qodef_dynamic_css('.qodef-page-header .qodef-sticky-header', array('height' => $height));
            echo coney_qodef_dynamic_css('.qodef-page-header .qodef-sticky-header .qodef-logo-wrapper a', array('max-height' => $height));
        }
	
	    // sticky menu style
	
	    $menu_item_styles = coney_qodef_get_typography_styles('sticky');

        $menu_item_selector = array(
            '.qodef-main-menu.qodef-sticky-nav > ul > li > a'
        );

        echo coney_qodef_dynamic_css($menu_item_selector, $menu_item_styles);
	    
	
	    $hover_color = coney_qodef_options()->getOptionValue('sticky_hovercolor');
	    
        $menu_item_hover_styles = array();
	    if(!empty($hover_color)) {
            $menu_item_hover_styles['color'] = $hover_color;
        }

        $menu_item_hover_selector = array(
            '.qodef-main-menu.qodef-sticky-nav > ul > li:hover > a',
            '.qodef-main-menu.qodef-sticky-nav > ul > li.qodef-active-item > a'
        );

        echo coney_qodef_dynamic_css($menu_item_hover_selector, $menu_item_hover_styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_sticky_header_styles');
}

if(!function_exists('coney_qodef_fixed_header_styles')) {
    /**
     * Generates styles for fixed haeder
     */
    function coney_qodef_fixed_header_styles() {
	    $background_color = coney_qodef_options()->getOptionValue('fixed_header_background_color');
	    $background_transparency = coney_qodef_options()->getOptionValue('fixed_header_transparency');
	    $border_color = coney_qodef_options()->getOptionValue('fixed_header_border_bottom_color');
    	
    	$fixed_area_styles = array();
	    if(!empty($background_color)) {
            $fixed_header_background_color        = $background_color;
            $fixed_header_background_color_transparency = 1;
		
		    if($background_transparency !== '') {
                $fixed_header_background_color_transparency = $background_transparency;
            }

            $fixed_area_styles['background-color'] = coney_qodef_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency) . '!important';
        }

        if(empty($background_color) && $background_transparency !== '') {
            $fixed_header_background_color        = '#fff';
            $fixed_header_background_color_transparency = $background_transparency;

            $fixed_area_styles['background-color'] = coney_qodef_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency) . '!important';
        }

        $selector = array(
            '.qodef-page-header .qodef-fixed-wrapper.fixed .qodef-menu-area'
        );

        echo coney_qodef_dynamic_css($selector, $fixed_area_styles);

        $fixed_area_holder_styles = array();
	
	    if(!empty($border_color)) {
            $fixed_area_holder_styles['border-bottom-color'] = $border_color;
        }

        $selector_holder = array(
            '.qodef-page-header .qodef-fixed-wrapper.fixed'
        );

        echo coney_qodef_dynamic_css($selector_holder, $fixed_area_holder_styles);
	
	    // fixed menu style
	    
	    $menu_item_styles = coney_qodef_get_typography_styles('fixed');
	
	    $menu_item_selector = array(
		    '.qodef-fixed-wrapper.fixed .qodef-main-menu > ul > li > a'
	    );
	
	    echo coney_qodef_dynamic_css($menu_item_selector, $menu_item_styles);
	
	    
	    $hover_color = coney_qodef_options()->getOptionValue('fixed_hovercolor');
	
	    $menu_item_hover_styles = array();
	    if(!empty($hover_color)) {
		    $menu_item_hover_styles['color'] = $hover_color;
	    }
	
	    $menu_item_hover_selector = array(
		    '.qodef-fixed-wrapper.fixed .qodef-main-menu > ul > li:hover > a',
		    '.qodef-fixed-wrapper.fixed .qodef-main-menu > ul > li.qodef-active-item > a'
	    );
	
	    echo coney_qodef_dynamic_css($menu_item_hover_selector, $menu_item_hover_styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_fixed_header_styles');
}

if(!function_exists('coney_qodef_main_menu_styles')) {
    /**
     * Generates styles for main menu
     */
    function coney_qodef_main_menu_styles() {
	
	    // main menu 1st level style
	    
	    $menu_item_styles = coney_qodef_get_typography_styles('menu');
	    $padding = coney_qodef_options()->getOptionValue('menu_padding_left_right');
	    $margin = coney_qodef_options()->getOptionValue('menu_margin_left_right');
	
	    if(!empty($padding)) {
		    $menu_item_styles['padding'] = '0 '.coney_qodef_filter_px($padding).'px';
	    }
	    if(!empty($margin)) {
		    $menu_item_styles['margin'] = '0 '.coney_qodef_filter_px($margin).'px';
	    }
	    
	    $menu_item_selector = array(
		    '.qodef-header-classic .qodef-main-menu > ul > li > a',
		    '.qodef-main-menu > ul > li > a'
	    );
	
	    echo coney_qodef_dynamic_css($menu_item_selector, $menu_item_styles);
	    
	    $hover_color = coney_qodef_options()->getOptionValue('menu_hovercolor');
	
	    $menu_item_hover_styles = array();
	    if(!empty($hover_color)) {
		    $menu_item_hover_styles['color'] = $hover_color;
	    }
	
	    $menu_item_hover_selector = array(
		    '.qodef-main-menu > ul > li > a:hover'
	    );
	
	    echo coney_qodef_dynamic_css($menu_item_hover_selector, $menu_item_hover_styles);
	    
	    $active_color = coney_qodef_options()->getOptionValue('menu_activecolor');
	
	    $menu_item_active_styles = array();
	    if(!empty($active_color)) {
		    $menu_item_active_styles['color'] = $active_color;
	    }
	
	    $menu_item_active_selector = array(
		    '.qodef-main-menu > ul > li.qodef-active-item > a'
	    );
	
	    echo coney_qodef_dynamic_css($menu_item_active_selector, $menu_item_active_styles);
	    
	    $light_hover_color = coney_qodef_options()->getOptionValue('menu_light_hovercolor');
	
	    $menu_item_light_hover_styles = array();
	    if(!empty($light_hover_color)) {
		    $menu_item_light_hover_styles['color'] = $light_hover_color;
	    }
	
	    $menu_item_light_hover_selector = array(
		    '.qodef-light-header .qodef-page-header > div:not(.qodef-sticky-header):not(.qodef-fixed-wrapper) .qodef-main-menu > ul > li > a:hover'
	    );
	
	    echo coney_qodef_dynamic_css($menu_item_light_hover_selector, $menu_item_light_hover_styles);
	    
	    $light_active_color = coney_qodef_options()->getOptionValue('menu_light_activecolor');
	
	    $menu_item_light_active_styles = array();
	    if(!empty($light_active_color)) {
		    $menu_item_light_active_styles['color'] = $light_active_color;
	    }
	
	    $menu_item_light_active_selector = array(
		    '.qodef-light-header .qodef-page-header > div:not(.qodef-sticky-header):not(.qodef-fixed-wrapper) .qodef-main-menu > ul > li.qodef-active-item > a'
	    );
	
	    echo coney_qodef_dynamic_css($menu_item_light_active_selector, $menu_item_light_active_styles);
	    
	    $dark_hover_color = coney_qodef_options()->getOptionValue('menu_dark_hovercolor');
	
	    $menu_item_dark_hover_styles = array();
	    if(!empty($dark_hover_color)) {
		    $menu_item_dark_hover_styles['color'] = $dark_hover_color;
	    }
	
	    $menu_item_dark_hover_selector = array(
		    '.qodef-dark-header .qodef-page-header > div:not(.qodef-sticky-header):not(.qodef-fixed-wrapper) .qodef-main-menu > ul > li > a:hover'
	    );
	
	    echo coney_qodef_dynamic_css($menu_item_dark_hover_selector, $menu_item_dark_hover_styles);
	    
	    $dark_active_color = coney_qodef_options()->getOptionValue('menu_dark_activecolor');
	
	    $menu_item_dark_active_styles = array();
	    if(!empty($dark_active_color)) {
		    $menu_item_dark_active_styles['color'] = $dark_active_color;
	    }
	
	    $menu_item_dark_active_selector = array(
		    '.qodef-dark-header .qodef-page-header > div:not(.qodef-sticky-header):not(.qodef-fixed-wrapper) .qodef-main-menu > ul > li.qodef-active-item > a'
	    );
	
	    echo coney_qodef_dynamic_css($menu_item_dark_active_selector, $menu_item_dark_active_styles);
	
	    // main menu 2nd level style
	    
	    $dropdown_menu_item_styles = coney_qodef_get_typography_styles('dropdown');
	
	    $dropdown_menu_item_selector = array(
		    '.qodef-drop-down .second .inner > ul > li > a'
	    );
	
	    echo coney_qodef_dynamic_css($dropdown_menu_item_selector, $dropdown_menu_item_styles);
	    
	    $dropdown_hover_color = coney_qodef_options()->getOptionValue('dropdown_hovercolor');
	
	    $dropdown_menu_item_hover_styles = array();
	    if(!empty($dropdown_hover_color)) {
		    $dropdown_menu_item_hover_styles['color'] = $dropdown_hover_color . ' !important';
	    }
	
	    $dropdown_menu_item_hover_selector = array(
		    '.qodef-drop-down .second .inner > ul > li > a:hover',
            '.qodef-drop-down .second .inner > ul > li.current-menu-ancestor > a',
            '.qodef-drop-down .second .inner > ul > li.current-menu-item > a'
	    );
	
	    echo coney_qodef_dynamic_css($dropdown_menu_item_hover_selector, $dropdown_menu_item_hover_styles);
	
	    // main menu 2nd level wide style
	    
	    $dropdown_wide_menu_item_styles = coney_qodef_get_typography_styles('dropdown_wide');
	
	    $dropdown_wide_menu_item_selector = array(
		    '.qodef-drop-down .wide .second .inner > ul > li > a'
	    );
	
	    echo coney_qodef_dynamic_css($dropdown_wide_menu_item_selector, $dropdown_wide_menu_item_styles);
	
	    $dropdown_wide_hover_color = coney_qodef_options()->getOptionValue('dropdown_wide_hovercolor');
	
	    $dropdown_wide_menu_item_hover_styles = array();
	    if(!empty($dropdown_wide_hover_color)) {
		    $dropdown_wide_menu_item_hover_styles['color'] = $dropdown_wide_hover_color . ' !important';
	    }
	
	    $dropdown_wide_menu_item_hover_selector = array(
		    '.qodef-drop-down .wide .second .inner > ul > li > a:hover',
		    '.qodef-drop-down .wide .second .inner > ul > li.current-menu-ancestor > a',
		    '.qodef-drop-down .wide .second .inner > ul > li.current-menu-item > a'
	    );
	
	    echo coney_qodef_dynamic_css($dropdown_wide_menu_item_hover_selector, $dropdown_wide_menu_item_hover_styles);
	
	    // main menu 3rd level style
	    
	    $dropdown_menu_item_styles_thirdlvl = coney_qodef_get_typography_styles('dropdown', '_thirdlvl');
	
	    $dropdown_menu_item_selector_thirdlvl = array(
		    '.qodef-drop-down .second .inner ul li ul li a'
	    );
	
	    echo coney_qodef_dynamic_css($dropdown_menu_item_selector_thirdlvl, $dropdown_menu_item_styles_thirdlvl);
	
	    $dropdown_hover_color_thirdlvl = coney_qodef_options()->getOptionValue('dropdown_hovercolor_thirdlvl');
	
	    $dropdown_menu_item_hover_styles_thirdlvl = array();
	    if(!empty($dropdown_hover_color_thirdlvl)) {
		    $dropdown_menu_item_hover_styles_thirdlvl['color'] = $dropdown_hover_color_thirdlvl . ' !important';
	    }
	
	    $dropdown_menu_item_hover_selector_thirdlvl = array(
		    '.qodef-drop-down .second .inner ul li ul li a:hover',
            '.qodef-drop-down .second .inner ul li ul li.current-menu-ancestor > a',
            '.qodef-drop-down .second .inner ul li ul li.current-menu-item > a'
	    );
	
	    echo coney_qodef_dynamic_css($dropdown_menu_item_hover_selector_thirdlvl, $dropdown_menu_item_hover_styles_thirdlvl);
	
	    // main menu 3rd level wide style
	    
	    $dropdown_wide_menu_item_styles_thirdlvl = coney_qodef_get_typography_styles('dropdown_wide', '_thirdlvl');
	
	    $dropdown_wide_menu_item_selector_thirdlvl = array(
		    '.qodef-drop-down .wide .second .inner ul li ul li a'
	    );
	
	    echo coney_qodef_dynamic_css($dropdown_wide_menu_item_selector_thirdlvl, $dropdown_wide_menu_item_styles_thirdlvl);
	    
	    $dropdown_wide_hover_color_thirdlvl = coney_qodef_options()->getOptionValue('dropdown_wide_hovercolor_thirdlvl');
	
	    $dropdown_wide_menu_item_hover_styles_thirdlvl = array();
	    if(!empty($dropdown_wide_hover_color_thirdlvl)) {
		    $dropdown_wide_menu_item_hover_styles_thirdlvl['color'] = $dropdown_wide_hover_color_thirdlvl . ' !important';
	    }
	
	    $dropdown_wide_menu_item_hover_selector_thirdlvl = array(
		    '.qodef-drop-down .wide .second .inner ul li ul li a:hover',
		    '.qodef-drop-down .wide .second .inner ul li ul li.current-menu-ancestor > a',
		    '.qodef-drop-down .wide .second .inner ul li ul li.current-menu-item > a'
	    );
	
	    echo coney_qodef_dynamic_css($dropdown_wide_menu_item_hover_selector_thirdlvl, $dropdown_wide_menu_item_hover_styles_thirdlvl);
	
	    // main menu dropdown holder style
	    
		$dropdown_top_position = coney_qodef_options()->getOptionValue('dropdown_top_position');
		
		$dropdown_styles = array();
		if($dropdown_top_position !== '') {
			$dropdown_styles['top'] = $dropdown_top_position.'%';
		}
		
		$dropdown_selector = array(
			'.qodef-page-header .qodef-drop-down .second'
		);
		
		echo coney_qodef_dynamic_css($dropdown_selector, $dropdown_styles);

		// main menu dropdown background color style

		if(coney_qodef_options()->getOptionValue('dropdown_background_color') !== '' || coney_qodef_options()->getOptionValue('dropdown_background_transparency') !== '') {

			$dropdown_bg_color_initial        = '#f7f7f7';
			$dropdown_bg_transparency_initial = 1;

			$dropdown_bg_color        = coney_qodef_options()->getOptionValue('dropdown_background_color') !== "" ? coney_qodef_options()->getOptionValue('dropdown_background_color') : $dropdown_bg_color_initial;
			$dropdown_bg_transparency = coney_qodef_options()->getOptionValue('dropdown_background_transparency') !== "" ? coney_qodef_options()->getOptionValue('dropdown_background_transparency') : $dropdown_bg_transparency_initial;

			$dropdown_bg_color = coney_qodef_rgba_color($dropdown_bg_color, $dropdown_bg_transparency);

			$dropdown_color_selector = array(
				'.qodef-page-header .qodef-drop-down .wide.wide_background .second',
				'.qodef-drop-down .narrow .second .inner ul',
				'.qodef-page-header .qodef-drop-down .wide .second .inner > ul'
			);

			echo coney_qodef_dynamic_css($dropdown_color_selector, array('background-color' => $dropdown_bg_color));
		}

    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_main_menu_styles');
}

if(!function_exists('coney_qodef_vertical_main_menu_styles')) {
	/**
	 * Generates styles for vertical main main menu
	 */
	function coney_qodef_vertical_main_menu_styles() {
		$menu_holder_styles = array();

		if(coney_qodef_options()->getOptionValue('vertical_menu_top_margin') !== '') {
			$menu_holder_styles['margin-top'] = coney_qodef_filter_px(coney_qodef_options()->getOptionValue('vertical_menu_top_margin')).'px';
		}
		if(coney_qodef_options()->getOptionValue('vertical_menu_bottom_margin') !== '') {
			$menu_holder_styles['margin-bottom'] = coney_qodef_filter_px(coney_qodef_options()->getOptionValue('vertical_menu_bottom_margin')).'px';
		}

		$menu_holder_selector = array(
			'.qodef-header-vertical .qodef-vertical-menu'
		);

		echo coney_qodef_dynamic_css($menu_holder_selector, $menu_holder_styles);
		
		// vertical menu 1st level style
		
		$first_level_styles = coney_qodef_get_typography_styles('vertical_menu_1st');
		
		$first_level_selector = array(
			'.qodef-header-vertical .qodef-vertical-menu > ul > li > a'
		);
		
		echo coney_qodef_dynamic_css($first_level_selector, $first_level_styles);
		
		$first_level_hover_styles = array();
		
		if(coney_qodef_options()->getOptionValue('vertical_menu_1st_hover_color') !== '') {
			$first_level_hover_styles['color'] = coney_qodef_options()->getOptionValue('vertical_menu_1st_hover_color');
		}
		
		$first_level_hover_selector = array(
			'.qodef-header-vertical .qodef-vertical-menu > ul > li > a:hover',
			'.qodef-header-vertical .qodef-vertical-menu > ul > li > a.qodef-active-item',
			'.qodef-header-vertical .qodef-vertical-menu > ul > li > a.current-menu-ancestor'
		);

		echo coney_qodef_dynamic_css($first_level_hover_selector, $first_level_hover_styles);
		
		// vertical menu 2nd level style
		
		$second_level_styles = coney_qodef_get_typography_styles('vertical_menu_2nd');
		
		$second_level_selector = array(
			'.qodef-header-vertical .qodef-vertical-menu .second .inner > ul > li > a'
		);
		
		echo coney_qodef_dynamic_css($second_level_selector, $second_level_styles);
		
		$second_level_hover_styles = array();

		if(coney_qodef_options()->getOptionValue('vertical_menu_2nd_hover_color') !== '') {
			$second_level_hover_styles['color'] = coney_qodef_options()->getOptionValue('vertical_menu_2nd_hover_color');
		}
		
		$second_level_hover_selector = array(
			'.qodef-header-vertical .qodef-vertical-menu .second .inner > ul > li > a:hover',
			'.qodef-header-vertical .qodef-vertical-menu .second .inner > ul > li.current_page_item > a',
			'.qodef-header-vertical .qodef-vertical-menu .second .inner > ul > li.current-menu-item > a',
			'.qodef-header-vertical .qodef-vertical-menu .second .inner > ul > li.current-menu-ancestor > a'
		);

		echo coney_qodef_dynamic_css($second_level_hover_selector, $second_level_hover_styles);
		
		// vertical menu 3rd level style
		
		$third_level_styles = coney_qodef_get_typography_styles('vertical_menu_3rd');
		
		$third_level_selector = array(
			'.qodef-header-vertical .qodef-vertical-menu .second .inner ul li ul li a'
		);
		
		echo coney_qodef_dynamic_css($third_level_selector, $third_level_styles);
		
		
		$third_level_hover_styles = array();

		if(coney_qodef_options()->getOptionValue('vertical_menu_3rd_hover_color') !== '') {
			$third_level_hover_styles['color'] = coney_qodef_options()->getOptionValue('vertical_menu_3rd_hover_color');
		}
		
		$third_level_hover_selector = array(
			'.qodef-header-vertical .qodef-vertical-menu .second .inner ul li ul li a:hover',
			'.qodef-header-vertical .qodef-vertical-menu .second .inner ul li ul li a.qodef-active-item',
			'.qodef-header-vertical .qodef-vertical-menu .second .inner ul li ul li.current_page_item a',
			'.qodef-header-vertical .qodef-vertical-menu .second .inner ul li ul li.current-menu-item a'
		);

		echo coney_qodef_dynamic_css($third_level_hover_selector, $third_level_hover_styles);
	}

	add_action('coney_qodef_style_dynamic', 'coney_qodef_vertical_main_menu_styles');
}