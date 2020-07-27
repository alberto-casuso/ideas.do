<?php

add_action('after_setup_theme', 'coney_qodef_admin_map_init', 0);

function coney_qodef_admin_map_init() {

    do_action('coney_qodef_before_options_map');

    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/fonts/map.php';
    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/general/map.php';
    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/page/map.php';
    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/social/map.php';
    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/reset/map.php';


    do_action('coney_qodef_options_map');

    do_action('coney_qodef_after_options_map');
}