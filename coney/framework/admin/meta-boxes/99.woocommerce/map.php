<?php

if(coney_qodef_is_woocommerce_installed()){

    if(!function_exists('coney_qodef_map_woocommerce_meta')) {
        function coney_qodef_map_woocommerce_meta() {
            $woocommerce_meta_box = coney_qodef_create_meta_box(
                array(
                    'scope' => array('product'),
                    'title' => esc_html__('Product Meta', 'coney'),
                    'name' => 'woo_product_meta'
                )
            );

            coney_qodef_create_meta_box_field(
                array(
                    'name' => 'qodef_show_title_area_woo_meta',
                    'type' => 'select',
                    'default_value' => '',
                    'label' => esc_html__('Show Title Area', 'coney'),
                    'description' => esc_html__('Disabling this option will turn off page title area', 'coney'),
                    'parent' => $woocommerce_meta_box,
                    'options' => coney_qodef_get_yes_no_select_array()
                )
            );

            coney_qodef_create_meta_box_field(
                array(
                    'name'        => 'qodef_disable_page_content_top_padding_meta',
                    'type'        => 'select',
                    'label'       => esc_html__('Disable Content Top Padding', 'coney'),
                    'description' => esc_html__('Enabling this option will disable content top padding', 'coney'),
                    'parent'      => $woocommerce_meta_box,
                    'options' => coney_qodef_get_yes_no_select_array()
                )
            );
        }

        add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_woocommerce_meta', 99);
    }
}

