<?php

if(!function_exists('coney_qodef_map_testimonials_meta')) {
    function coney_qodef_map_testimonials_meta() {
        $testimonial_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' => array('testimonials'),
                'title' => esc_html__('Testimonial', 'coney'),
                'name' => 'testimonial_meta'
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        	=> 'qodef_testimonial_title',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Title', 'coney'),
                'description' 	=> esc_html__('Enter testimonial title', 'coney'),
                'parent'      	=> $testimonial_meta_box,
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        	=> 'qodef_testimonial_text',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Text', 'coney'),
                'description' 	=> esc_html__('Enter testimonial text', 'coney'),
                'parent'      	=> $testimonial_meta_box,
            )
        );

        coney_qodef_create_meta_box_field(
            array(
                'name'        	=> 'qodef_testimonial_author',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Author', 'coney'),
                'description' 	=> esc_html__('Enter author name', 'coney'),
                'parent'      	=> $testimonial_meta_box,
            )
        );
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_testimonials_meta', 95);
}