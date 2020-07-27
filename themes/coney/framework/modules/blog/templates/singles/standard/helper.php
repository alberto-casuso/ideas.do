<?php

if( !function_exists('coney_qodef_get_blog_holder_params') ) {
    /**
     * Function that generates params for holders on blog templates
     */
    function coney_qodef_get_blog_holder_params($params) {
        $params_list = array();

        $params_list['holder'] = 'qodef-container';
        $params_list['inner'] = 'qodef-container-inner clearfix';

        return $params_list;
    }

    add_filter( 'coney_qodef_blog_holder_params', 'coney_qodef_get_blog_holder_params' );
}

if( !function_exists('coney_qodef_get_blog_single_holder_classes') ) {
    /**
     * Function that generates blog wrapper classes for single blog page
     */
    function coney_qodef_get_blog_single_holder_classes($classes) {
        $sidebar_classes   = array();
        $sidebar_classes[] = 'qodef-columns-normal-space';

        return $sidebar_classes;
    }

    add_filter( 'coney_qodef_sidebar_columns_space_classes', 'coney_qodef_get_blog_single_holder_classes' );
}

if( !function_exists('coney_qodef_blog_part_params') ) {
    function coney_qodef_blog_part_params($params) {

        $part_params = array();
        $part_params['title_tag'] = 'h4';
        $part_params['link_tag'] = 'h4';
        $part_params['quote_tag'] = 'h4';
        $part_params['share_circle'] = 'yes';
        $part_params['share_text'] = 'yes';

        return array_merge($params, $part_params);
    }

    add_filter( 'coney_qodef_blog_part_params', 'coney_qodef_blog_part_params' );
}