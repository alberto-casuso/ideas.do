<?php

if (!function_exists('coney_qodef_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function coney_qodef_register_sidebars() {

        register_sidebar(array(
            'name' => esc_html__('Sidebar', 'coney'),
            'id' => 'sidebar',
            'description' => esc_html__('Default Sidebar', 'coney'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="qodef-widget-title-holder"><h6 class="qodef-widget-title">',
            'after_title' => '</h6></div>'
        ));
    }

    add_action('widgets_init', 'coney_qodef_register_sidebars', 1);
}

if (!function_exists('coney_qodef_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates ConeyQodefSidebar object
     */
    function coney_qodef_add_support_custom_sidebar() {
        add_theme_support('ConeyQodefSidebar');
        if (get_theme_support('ConeyQodefSidebar')) new ConeyQodefSidebar();
    }

    add_action('after_setup_theme', 'coney_qodef_add_support_custom_sidebar');
}