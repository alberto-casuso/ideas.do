<?php

if (!function_exists('coney_qodef_register_footer_sidebar')) {

    function coney_qodef_register_footer_sidebar() {

        register_sidebar(array(
            'name' => esc_html__('Footer Top Column 1', 'coney'),
            'description'   => esc_html__('Widgets added here will appear in the first column of top footer area', 'coney'),
            'id' => 'footer_top_column_1',
            'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-1 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="qodef-widget-title-holder"><h6 class="qodef-widget-title">',
            'after_title' => '</h6></div>'
        ));

        register_sidebar(array(
            'name' => esc_html__('Footer Top Column 2', 'coney'),
            'description'   => esc_html__('Widgets added here will appear in the second column of top footer area', 'coney'),
            'id' => 'footer_top_column_2',
            'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-2 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="qodef-widget-title-holder"><h6 class="qodef-widget-title">',
            'after_title' => '</h6></div>'
        ));

        register_sidebar(array(
            'name' => esc_html__('Footer Top Column 3', 'coney'),
            'description'   => esc_html__('Widgets added here will appear in the third column of top footer area', 'coney'),
            'id' => 'footer_top_column_3',
            'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-3 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="qodef-widget-title-holder"><h6 class="qodef-widget-title">',
            'after_title' => '</h6></div>'
        ));

        register_sidebar(array(
            'name' => esc_html__('Footer Top Column 4', 'coney'),
            'description'   => esc_html__('Widgets added here will appear in the fourth column of top footer area', 'coney'),
            'id' => 'footer_top_column_4',
            'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-4 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="qodef-widget-title-holder"><h6 class="qodef-widget-title">',
            'after_title' => '</h6></div>'
        ));

        register_sidebar(array(
            'name' => esc_html__('Footer Top Simple', 'coney'),
            'description'   => esc_html__('Widgets added here will appear in top footer area', 'coney'),
            'id' => 'footer_top_simple',
            'before_widget' => '<div id="%1$s" class="widget qodef-footer-top-simple %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="qodef-widget-title-holder"><h6 class="qodef-widget-title">',
            'after_title' => '</h6></div>'
        ));

        register_sidebar(array(
            'name' => esc_html__('Footer Bottom Left Column', 'coney'),
            'description'   => esc_html__('Widgets added here will appear in the left column of bottom footer area', 'coney'),
            'id' => 'footer_bottom_column_1',
            'before_widget' => '<div id="%1$s" class="widget qodef-footer-bottom-column-1 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="qodef-widget-title-holder"><h6 class="qodef-widget-title">',
            'after_title' => '</h6></div>'
        ));

        register_sidebar(array(
            'name' => esc_html__('Footer Bottom Middle Column', 'coney'),
            'description'   => esc_html__('Widgets added here will appear in the middle column of bottom footer area', 'coney'),
            'id' => 'footer_bottom_column_2',
            'before_widget' => '<div id="%1$s" class="widget qodef-footer-bottom-column-2 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="qodef-widget-title-holder"><h6 class="qodef-widget-title">',
            'after_title' => '</h6></div>'
        ));

        register_sidebar(array(
            'name' => esc_html__('Footer Bottom Right Column', 'coney'),
            'description'   => esc_html__('Widgets added here will appear in the right column of bottom footer area', 'coney'),
            'id' => 'footer_bottom_column_3',
            'before_widget' => '<div id="%1$s" class="widget qodef-footer-bottom-column-3 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="qodef-widget-title-holder"><h6 class="qodef-widget-title">',
            'after_title' => '</h6></div>'
        ));
    }

    add_action('widgets_init', 'coney_qodef_register_footer_sidebar');
}

if (!function_exists('coney_qodef_get_footer')) {
    /**
     * Loads footer HTML
     */
    function coney_qodef_get_footer() {
        $parameters = array();
	    $page_id = coney_qodef_get_page_id();
	
	    if(get_post_meta($page_id, 'qodef_disable_footer_meta', true) == 'yes'){
		    $parameters['display_footer'] = false;
	    } else {
		    $parameters['display_footer'] = true;
	    }

        $parameters['display_footer_top'] = coney_qodef_show_footer_top();

        $parameters['display_footer_bottom'] = coney_qodef_show_footer_bottom();

        coney_qodef_get_module_template_part('templates/footer', 'footer', '', $parameters);
    }

    add_action('coney_qodef_get_footer_template', 'coney_qodef_get_footer');
}

if(!function_exists('coney_qodef_show_footer_top')){
    /**
     * Check footer top showing
     * Function check value from options and checks if footer columns are empty.
     * return bool
     */
    function coney_qodef_show_footer_top(){
        $footer_top_flag = false;
	    
        //check value from options and meta field on current page
        $option_flag = (coney_qodef_get_meta_field_intersect('show_footer_top') === 'yes') ? true : false;
        $footer_type = coney_qodef_get_meta_field_intersect('footer_top_type');

        $columns_flag = false;
        //check footer columns.If they are empty, disable footer top
        if($footer_type == 'simple') {
            if (is_active_sidebar('footer_top_simple')) {
                $columns_flag = true;
            }
        }
        else {
            for ($i = 1; $i <= 4; $i++) {
                $footer_columns_id = 'footer_top_column_' . $i;
                if (is_active_sidebar($footer_columns_id)) {
                    $columns_flag = true;
                    break;
                }
            }
        }
       
        if($option_flag && $columns_flag){
            $footer_top_flag = true;
        }

        return $footer_top_flag;
    }
}

if(!function_exists('coney_qodef_show_footer_bottom')){
    /**
     * Check footer bottom showing
     * Function check value from options and checks if footer columns are empty.
     * return bool
     */
    function coney_qodef_show_footer_bottom(){
        $footer_bottom_flag = false;
	    
        //check value from options and meta field on current page
        $option_flag = (coney_qodef_get_meta_field_intersect('show_footer_bottom') === 'yes') ? true : false;

        //check footer columns.If they are empty, disable footer bottom
	    $columns_flag = false;
	    for($i = 1; $i <= 3; $i++){
		    $footer_columns_id = 'footer_bottom_column_'.$i;
		    if(is_active_sidebar($footer_columns_id)) {
			    $columns_flag = true;
			    break;
		    }
	    }
	    
        if($option_flag && $columns_flag){
	        $footer_bottom_flag = true;
        }

        return $footer_bottom_flag;
    }
}

if (!function_exists('coney_qodef_get_content_bottom_area')) {
    /**
     * Loads content bottom area HTML with all needed parameters
     */
    function coney_qodef_get_content_bottom_area() {

        $parameters = array();

        //Current page id
        $id = coney_qodef_get_page_id();

        //is content bottom area enabled for current page?
        $parameters['content_bottom_area'] = coney_qodef_get_meta_field_intersect('enable_content_bottom_area', $id);

        if ($parameters['content_bottom_area'] === 'yes') {

            //Sidebar for content bottom area
            $parameters['content_bottom_area_sidebar'] = coney_qodef_get_meta_field_intersect('content_bottom_sidebar_custom_display', $id);
            //Content bottom area in grid
            $parameters['grid_class'] = (coney_qodef_get_meta_field_intersect('content_bottom_in_grid', $id)) === 'yes' ? 'qodef-grid' : 'qodef-full-width';

            $parameters['content_bottom_style'] = array();

            //Content bottom area background color
            $background_color = coney_qodef_get_meta_field_intersect('content_bottom_background_color', $id);
            if ($background_color !== '') {
                $parameters['content_bottom_style'][] = 'background-color: ' . $background_color . ';';
            }

            if(is_active_sidebar($parameters['content_bottom_area_sidebar'])){
                coney_qodef_get_module_template_part('templates/parts/content-bottom-area', 'footer', '', $parameters);
            }
        }
    }
}

if (!function_exists('coney_qodef_get_footer_top')) {
    /**
     * Return footer top HTML
     */
    function coney_qodef_get_footer_top() {
        $parameters = array();

        $parameters['footer_top_columns'] = coney_qodef_options()->getOptionValue('footer_top_columns');
        //get footer top classes
        $footer_classes = coney_qodef_footer_top_classes();
        //get footer top grid/full width class
        $parameters['footer_top_grid_class'] = $footer_classes['grid_class'];
        //get footer top other classes
        $parameters['footer_top_classes'] = $footer_classes['classes'];

        $type = coney_qodef_get_meta_field_intersect('footer_top_type');

        coney_qodef_get_module_template_part('templates/parts/footer-top', 'footer', $type, $parameters);
    }
}

if (!function_exists('coney_qodef_get_footer_bottom')) {
    /**
     * Return footer bottom HTML
     */
    function coney_qodef_get_footer_bottom() {
        $parameters = array();

        $parameters['footer_bottom_columns'] = coney_qodef_options()->getOptionValue('footer_bottom_columns');

        //get footer top classes
        $footer_classes = coney_qodef_footer_bottom_classes();
        //get footer top grid/full width class
        $parameters['footer_bottom_grid_class'] = $footer_classes['grid_class'];
        //get footer top other classes
        $parameters['footer_bottom_classes'] = $footer_classes['classes'];

        coney_qodef_get_module_template_part('templates/parts/footer-bottom', 'footer', '', $parameters);
    }
}