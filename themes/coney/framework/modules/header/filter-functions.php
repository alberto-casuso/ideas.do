<?php

if(!function_exists('coney_qodef_header_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function coney_qodef_header_class($classes) {
        $header_type = coney_qodef_get_meta_field_intersect('header_type', coney_qodef_get_page_id());

        $classes[] = 'qodef-'.$header_type;

        return $classes;
    }

    add_filter('body_class', 'coney_qodef_header_class');
}

if(!function_exists('coney_qodef_header_behaviour_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function coney_qodef_header_behaviour_class($classes) {

        $classes[] = 'qodef-'.coney_qodef_options()->getOptionValue('header_behaviour');

        return $classes;
    }

    add_filter('body_class', 'coney_qodef_header_behaviour_class');
}

if(!function_exists('coney_qodef_mobile_header_class')) {
    function coney_qodef_mobile_header_class($classes) {
        $classes[] = 'qodef-default-mobile-header';

        $classes[] = 'qodef-sticky-up-mobile-header';

        return $classes;
    }

    add_filter('body_class', 'coney_qodef_mobile_header_class');
}

if(!function_exists('coney_qodef_menu_dropdown_appearance')) {
    /**
     * Function that adds menu dropdown appearance class to body tag
     * @param array array of classes from main filter
     * @return array array of classes with added menu dropdown appearance class
     */
    function coney_qodef_menu_dropdown_appearance($classes) {

        if(coney_qodef_options()->getOptionValue('menu_dropdown_appearance') !== 'default'){
            $classes[] = 'qodef-'.coney_qodef_options()->getOptionValue('menu_dropdown_appearance');
        }

        return $classes;
    }

    add_filter('body_class', 'coney_qodef_menu_dropdown_appearance');
}

if (!function_exists('coney_qodef_header_skin_class')) {

    function coney_qodef_header_skin_class( $classes ) {

        $id = coney_qodef_get_page_id();

		if(($meta_temp = get_post_meta($id, 'qodef_header_style_meta', true)) !== ''){
			$classes[] = 'qodef-' . $meta_temp;
		}
        else if ( is_404() && coney_qodef_options()->getOptionValue('404_header_style') !== '' ) {
            $classes[] = 'qodef-' . coney_qodef_options()->getOptionValue('404_header_style');
        }
        else if ( coney_qodef_options()->getOptionValue('header_style') !== '' ) {
            $classes[] = 'qodef-' . coney_qodef_options()->getOptionValue('header_style');
        }

        return $classes;
    }

    add_filter('body_class', 'coney_qodef_header_skin_class');
}

if (!function_exists('coney_qodef_header_top_skin_class')) {

    function coney_qodef_header_top_skin_class( $classes ) {

        $id = coney_qodef_get_page_id();

        if(($meta_temp = get_post_meta($id, 'qodef_top_bar_color_skin_meta', true)) !== ''){
            $classes[] = 'qodef-' . $meta_temp;
        }
        else if ( coney_qodef_options()->getOptionValue('top_bar_color_skin') !== '' ) {
            $classes[] = 'qodef-' . coney_qodef_options()->getOptionValue('top_bar_color_skin');
        }

        return $classes;
    }

    add_filter('body_class', 'coney_qodef_header_top_skin_class');
}


if(!function_exists('coney_qodef_header_global_js_var')) {
    function coney_qodef_header_global_js_var($global_variables) {

        $global_variables['qodefTopBarHeight'] = coney_qodef_get_top_bar_height();
        $global_variables['qodefStickyHeaderHeight'] = coney_qodef_get_sticky_header_height();
        $global_variables['qodefStickyHeaderTransparencyHeight'] = coney_qodef_get_sticky_header_height_of_complete_transparency();
        $global_variables['qodefStickyScrollAmount'] = coney_qodef_get_sticky_scroll_amount();

        return $global_variables;
    }

    add_filter('coney_qodef_js_global_variables', 'coney_qodef_header_global_js_var');
}

if(!function_exists('coney_qodef_header_per_page_js_var')) {
    function coney_qodef_header_per_page_js_var($perPageVars) {

        $perPageVars['qodefStickyScrollAmount'] = coney_qodef_get_sticky_scroll_amount_per_page();

        return $perPageVars;
    }

    add_filter('coney_qodef_per_page_js_vars', 'coney_qodef_header_per_page_js_var');
}