<?php
if (!function_exists('coney_qodef_register_side_area_sidebar')) {
    /**
     * Register side area sidebar
     */
    function coney_qodef_register_side_area_sidebar() {

        register_sidebar(array(
            'name' => esc_html__('Side Area', 'coney'),
            'id' => 'sidearea', //TODO Change name of sidebar
            'description' => esc_html__('Side Area', 'coney'),
            'before_widget' => '<div id="%1$s" class="widget qodef-sidearea %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="qodef-widget-title-holder"><h4 class="qodef-widget-title">',
            'after_title' => '</h4></div>'
        ));
    }

    add_action('widgets_init', 'coney_qodef_register_side_area_sidebar');
}

if (!function_exists('coney_qodef_side_menu_body_class')) {
    /**
     * Function that adds body classes for different side menu styles
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function coney_qodef_side_menu_body_class($classes) {

        if (is_active_widget(false, false, 'qodef_side_area_opener')) {

            $classes[] = 'qodef-side-menu-slide-from-right';
        }

        return $classes;
    }

    add_filter('body_class', 'coney_qodef_side_menu_body_class');
}

if (!function_exists('coney_qodef_get_side_area')) {
    /**
     * Loads side area HTML
     */
    function coney_qodef_get_side_area() {

        if (is_active_widget(false, false, 'qodef_side_area_opener')) {

            coney_qodef_get_module_template_part('templates/sidearea', 'sidearea');
        }
    }
	
	add_action('coney_qodef_after_body_tag', 'coney_qodef_get_side_area', 10);
}

