<?php

if(!function_exists('coney_qodef_footer_top_general_styles')) {
    /**
     * Generates general custom styles for footer top area
     */
    function coney_qodef_footer_top_general_styles() {
        $item_styles = array();
        $background_color = coney_qodef_options()->getOptionValue('footer_top_background_color');

        if(!empty($background_color)) {
            $item_styles['background-color'] = $background_color;
        }

        echo coney_qodef_dynamic_css('footer .qodef-footer-top-holder', $item_styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_footer_top_general_styles');
}

if(!function_exists('coney_qodef_footer_top_simple_general_styles')) {
    /**
     * Generates general custom styles for footer top area
     */
    function coney_qodef_footer_top_simple_general_styles() {
        $item_styles = array();
        $background_color = coney_qodef_options()->getOptionValue('footer_top_background_color');

        if(!empty($background_color)) {
            $item_styles['background-color'] = $background_color;
        }

        echo coney_qodef_dynamic_css('footer .qodef-footer-top-simple-holder', $item_styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_footer_top_simple_general_styles');
}

if(!function_exists('coney_qodef_footer_bottom_general_styles')) {
    /**
     * Generates general custom styles for footer bottom area
     */
    function coney_qodef_footer_bottom_general_styles() {
        $item_styles = array();
	    $background_color = coney_qodef_options()->getOptionValue('footer_bottom_background_color');
	
	    if(!empty($background_color)) {
		    $item_styles['background-color'] = $background_color;
	    }

        echo coney_qodef_dynamic_css('footer .qodef-footer-bottom-holder', $item_styles);

        $border_styles = array();
        $enable_footer_bottom_border_top = coney_qodef_options()->getOptionValue('enable_footer_bottom_border_top');
    
        if($enable_footer_bottom_border_top == 'yes') {
            $border_styles['border-top'] = '1px solid #414141';
        }

        echo coney_qodef_dynamic_css('footer .qodef-footer-bottom-holder .qodef-footer-bottom-inner', $border_styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_footer_bottom_general_styles');
}