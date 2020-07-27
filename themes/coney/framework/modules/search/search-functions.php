<?php

if( !function_exists('coney_qodef_load_search') ) {
    function coney_qodef_load_search() {

        $search_type = 'fullscreen';
        $search_type = coney_qodef_get_meta_field_intersect('search_type', coney_qodef_get_page_id());

        if ( coney_qodef_active_widget( false, false, 'qodef_search_opener' ) ) {
            include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/search/types/' . $search_type . '.php';
        }
    }

    add_action('wp_head', 'coney_qodef_load_search');
}