<?php

if(!function_exists('coney_qodef_blog_single_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function coney_qodef_blog_single_class($classes) {

        if(is_singular('post')) {
            $blog_type = coney_qodef_get_meta_field_intersect('blog_single_type', coney_qodef_get_page_id());
            $classes[] = 'qodef-blog-single-' . $blog_type;
        }

        return $classes;
    }

    add_filter('body_class', 'coney_qodef_blog_single_class');
}