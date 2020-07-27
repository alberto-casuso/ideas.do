<?php

if( !function_exists('coney_qodef_search_body_class') ) {
    /**
     * Function that adds body classes for different search types
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function coney_qodef_search_body_class($classes) {

        $classes[] = 'qodef-fullscreen-search';
        $classes[] = 'qodef-search-fade';

        return $classes;

    }

    add_filter('body_class', 'coney_qodef_search_body_class');
}

if ( ! function_exists('coney_qodef_get_search') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function coney_qodef_get_search() {
        coney_qodef_load_search_template();
    }

    add_action('coney_qodef_before_page_header', 'coney_qodef_get_search', 9);
}

if ( ! function_exists('coney_qodef_load_search_template') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function coney_qodef_load_search_template() {
        coney_qodef_get_module_template_part('templates/types/fullscreen', 'search');
    }
}