<?php

if( !function_exists('coney_qodef_get_blog_holder_params') ) {
    /**
     * Function that generates params for holders on blog templates
     */
    function coney_qodef_get_blog_holder_params($params) {
        $params_list = array();

        $params_list['holder'] = 'qodef-full-width';
        $params_list['inner'] = 'qodef-full-width-inner';

        return $params_list;
    }

    add_filter( 'coney_qodef_blog_holder_params', 'coney_qodef_get_blog_holder_params' );
}

if( !function_exists('coney_qodef_blog_part_params') ) {
    function coney_qodef_blog_part_params($params) {

        $part_params = array();
        $part_params['title_tag'] = 'h2';
        $part_params['link_tag'] = 'h2';
        $part_params['quote_tag'] = 'h2';
        $part_params['share_square'] = 'yes';

        return array_merge($params, $part_params);
    }

    add_filter( 'coney_qodef_blog_part_params', 'coney_qodef_blog_part_params' );
}

if( !function_exists('coney_qodef_blog_read_more_params') ) {
    function coney_qodef_blog_read_more_params($params) {

        $part_params = array();
        $part_params['text'] = esc_html__('Leer más', 'coney');

        return array_merge($params, $part_params);
    }

    add_filter( 'coney_qodef_blog_template_read_more_button', 'coney_qodef_blog_read_more_params' );
}