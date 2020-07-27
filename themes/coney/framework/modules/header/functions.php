<?php

if(!function_exists('coney_qodef_header_register_main_navigation')) {
    /**
     * Registers main navigation
     */
    function coney_qodef_header_register_main_navigation() {
        register_nav_menus(
            array(
                'main-navigation' => esc_html__('Main Navigation', 'coney'),
                'vertical-navigation' => esc_html__('Vertical Navigation', 'coney'),
                'divided-left-navigation' => esc_html__('Divided Left Navigation', 'coney'),
                'divided-right-navigation' => esc_html__('Divided Right Navigation', 'coney'),
                'mobile-navigation' => esc_html__('Mobile Navigation', 'coney')
            )
        );
    }

    add_action('after_setup_theme', 'coney_qodef_header_register_main_navigation');
}

if(!function_exists('coney_qodef_is_top_bar_transparent')) {
    /**
     * Checks if top bar is transparent or not
     *
     * @return bool
     */
    function coney_qodef_is_top_bar_transparent() {
        $top_bar_enabled = coney_qodef_is_top_bar_enabled();

        $top_bar_bg_color = coney_qodef_options()->getOptionValue('top_bar_background_color');
        $top_bar_transparency = coney_qodef_options()->getOptionValue('top_bar_background_transparency');

        if($top_bar_enabled && $top_bar_bg_color !== '' && $top_bar_transparency !== '') {
            return $top_bar_transparency >= 0 && $top_bar_transparency < 1;
        }

        return false;
    }
}

if(!function_exists('coney_qodef_is_top_bar_completely_transparent')) {
    function coney_qodef_is_top_bar_completely_transparent() {
        $top_bar_enabled = coney_qodef_is_top_bar_enabled();

        $top_bar_bg_color = coney_qodef_options()->getOptionValue('top_bar_background_color');
        $top_bar_transparency = coney_qodef_options()->getOptionValue('top_bar_background_transparency');

        if($top_bar_enabled && $top_bar_bg_color !== '' && $top_bar_transparency !== '') {
            return $top_bar_transparency === '0';
        }

        return false;
    }
}

if(!function_exists('coney_qodef_is_top_bar_enabled')) {
    function coney_qodef_is_top_bar_enabled() {
        $top_bar_enabled = coney_qodef_get_meta_field_intersect('top_bar') === 'yes';

        return $top_bar_enabled;
    }
}

if(!function_exists('coney_qodef_get_top_bar_height')) {
    /**
     * Returns top bar height
     *
     * @return bool|int|void
     */
    function coney_qodef_get_top_bar_height() {
        if(coney_qodef_is_top_bar_enabled()) {
            $top_bar_height = coney_qodef_filter_px(coney_qodef_options()->getOptionValue('top_bar_height'));

            return $top_bar_height !== '' ? intval($top_bar_height) : 43;
        }

        return 0;
    }
}

if(!function_exists('coney_qodef_get_sticky_header_height')) {
    /**
     * Returns top sticky header height
     *
     * @return bool|int|void
     */
    function coney_qodef_get_sticky_header_height() {
        //sticky menu height, needed only for sticky header on scroll up
        if((coney_qodef_get_meta_field_intersect('header_type') === 'header-standard' || coney_qodef_get_meta_field_intersect('header_type') === 'header-divided') && in_array(coney_qodef_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up'))) {

            $sticky_header_height = coney_qodef_filter_px(coney_qodef_options()->getOptionValue('sticky_header_height'));

            return $sticky_header_height !== '' ? intval($sticky_header_height) : 60;
        }

        return 0;

    }
}

if(!function_exists('coney_qodef_get_sticky_header_height_of_complete_transparency')) {
    /**
     * Returns top sticky header height it is fully transparent. used in anchor logic
     *
     * @return bool|int|void
     */
    function coney_qodef_get_sticky_header_height_of_complete_transparency() {

        if((coney_qodef_get_meta_field_intersect('header_type') === 'header-standard' || coney_qodef_get_meta_field_intersect('header_type') === 'header-divided')) {
            $stickyHeaderTransparent = coney_qodef_options()->getOptionValue('sticky_header_background_color') !== '' && coney_qodef_options()->getOptionValue('sticky_header_transparency') === '0';

            if($stickyHeaderTransparent) {
                return 0;
            } else {
                $sticky_header_height = coney_qodef_filter_px(coney_qodef_options()->getOptionValue('sticky_header_height'));

                return $sticky_header_height !== '' ? intval($sticky_header_height) : 60;
            }
        }

        return 0;
    }
}

if(!function_exists('coney_qodef_get_sticky_scroll_amount')) {
    /**
     * Returns top sticky scroll amount
     *
     * @return bool|int|void
     */
    function coney_qodef_get_sticky_scroll_amount() {

        //sticky menu scroll amount
        if((coney_qodef_get_meta_field_intersect('header_type') === 'header-standard' || coney_qodef_get_meta_field_intersect('header_type') === 'header-divided') && in_array(coney_qodef_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {

            $sticky_scroll_amount = coney_qodef_filter_px(coney_qodef_options()->getOptionValue('scroll_amount_for_sticky'));

            return $sticky_scroll_amount !== '' ? intval($sticky_scroll_amount) : 0;
        }

        return 0;
    }
}

if(!function_exists('coney_qodef_get_sticky_scroll_amount_per_page')) {
    /**
     * Returns top sticky scroll amount
     *
     * @return bool|int|void
     */
    function coney_qodef_get_sticky_scroll_amount_per_page() {
        $post_id =  get_the_ID();
        //sticky menu scroll amount
        if((coney_qodef_get_meta_field_intersect('header_type') === 'header-standard' || coney_qodef_get_meta_field_intersect('header_type') === 'header-divided') && in_array(coney_qodef_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {

            $sticky_scroll_amount_per_page = coney_qodef_filter_px(get_post_meta($post_id, "qodef_scroll_amount_for_sticky_meta", true));

            return $sticky_scroll_amount_per_page !== '' ? intval($sticky_scroll_amount_per_page) : 0;
        }

        return 0;
    }
}