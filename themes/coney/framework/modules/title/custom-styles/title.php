<?php

if (!function_exists('coney_qodef_title_area_typography_style')) {

    function coney_qodef_title_area_typography_style(){

        // title default/small style
	    
	    $item_styles = coney_qodef_get_typography_styles('page_title');
	
	    $item_selector = array(
		    '.qodef-title .qodef-title-holder .qodef-page-title'
	    );
	
	    echo coney_qodef_dynamic_css($item_selector, $item_styles);
	
	    // subtitle style
	
	    $item_styles = coney_qodef_get_typography_styles('page_subtitle');
	
	    $item_selector = array(
		    '.qodef-title .qodef-title-holder .qodef-subtitle'
	    );
	
	    echo coney_qodef_dynamic_css($item_selector, $item_styles);
	
	    // breadcrumb style
	
	    $item_styles = coney_qodef_get_typography_styles('page_breadcrumb');
	
	    $item_selector = array(
		    '.qodef-title .qodef-title-holder .qodef-breadcrumbs a', 
		    '.qodef-title .qodef-title-holder .qodef-breadcrumbs span'
	    );
	
	    echo coney_qodef_dynamic_css($item_selector, $item_styles);
	    

	    $breadcrumb_hover_color = coney_qodef_options()->getOptionValue('page_breadcrumb_hovercolor');
	    
        $breadcrumb_hover_styles = array();
        if(!empty($breadcrumb_hover_color)) {
            $breadcrumb_hover_styles['color'] = $breadcrumb_hover_color;
        }

        $breadcrumb_hover_selector = array(
            '.qodef-title .qodef-title-holder .qodef-breadcrumbs a:hover'
        );

        echo coney_qodef_dynamic_css($breadcrumb_hover_selector, $breadcrumb_hover_styles);

        $responsive_height = coney_qodef_options()->getOptionValue('title_area_mobile_height');
        echo coney_qodef_dynamic_css('.qodef-title', array('height' => coney_qodef_filter_px($responsive_height).'px !important'));
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_title_area_typography_style');
}