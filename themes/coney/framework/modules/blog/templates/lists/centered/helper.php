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

if( !function_exists('coney_qodef_blog_part_params') ) {
    function coney_qodef_blog_part_params($params) {

        $part_params = array();
        $part_params['title_tag'] = 'h3';
        $part_params['link_tag'] = 'h3';
        $part_params['quote_tag'] = 'h3';

        return array_merge($params, $part_params);
    }

    add_filter( 'coney_qodef_blog_part_params', 'coney_qodef_blog_part_params' );
}