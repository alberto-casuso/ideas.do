<?php

/*** Post Settings ***/

if(!function_exists('coney_qodef_map_post_meta')) {
    function coney_qodef_map_post_meta() {

        $post_meta_box = coney_qodef_create_meta_box(
            array(
                'scope' => array('post'),
                'title' => esc_html__('Post', 'coney'),
                'name' => 'post-meta'
            )
        );

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_blog_single_type_meta',
            'type'        => 'select',
            'label'       => esc_html__('Blog Layout for Single Post Pages', 'coney'),
            'description' => esc_html__('Choose a default blog layout for single post pages', 'coney'),
            'default_value' => 'standard',
            'parent'      => $post_meta_box,
            'options'     => array(
                ''		                => esc_html__('Default', 'coney'),
                'standard'              => esc_html__('Standard', 'coney'),
                'full-width-image'		=> esc_html__('Full width Image', 'coney'),
                'narrow' 		        => esc_html__('Narrow', 'coney')
            )
        ));
	
	    coney_qodef_create_meta_box_field(array(
		    'name'        => 'qodef_blog_single_sidebar_layout_meta',
		    'type'        => 'select',
		    'label'       => esc_html__('Sidebar Layout', 'coney'),
		    'description' => esc_html__('Choose a sidebar layout for Blog single page', 'coney'),
		    'default_value'	=> '',
		    'parent'      => $post_meta_box,
		    'options'     => array(
			    ''		            => esc_html__('Default', 'coney'),
			    'no-sidebar'		=> esc_html__('No Sidebar', 'coney'),
			    'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'coney'),
			    'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'coney'),
			    'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'coney'),
			    'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'coney')
		    )
	    ));
	
	    $coney_custom_sidebars = coney_qodef_get_custom_sidebars();
	    if(count($coney_custom_sidebars) > 0) {
		    coney_qodef_create_meta_box_field(array(
			    'name' => 'qodef_blog_single_custom_sidebar_area_meta',
			    'type' => 'selectblank',
			    'label' => esc_html__('Sidebar to Display', 'coney'),
			    'description' => esc_html__('Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'coney'),
			    'parent' => $post_meta_box,
			    'options' => coney_qodef_get_custom_sidebars()
		    ));
	    }

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_blog_list_featured_image_meta',
                'type' => 'image',
                'label' => esc_html__('Blog List Image', 'coney'),
                'description' => esc_html__('Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'coney'),
                'parent' => $post_meta_box
            )
        );

        coney_qodef_create_meta_box_field(array(
            'name' => 'qodef_blog_masonry_gallery_fixed_dimensions_meta',
            'type' => 'select',
            'label' => esc_html__('Dimensions for Fixed Proportion', 'coney'),
            'description' => esc_html__('Choose image layout when it appears in Blog Metro list in fixed proportion', 'coney'),
            'default_value' => 'default',
            'parent' => $post_meta_box,
            'options' => array(
                'default' => esc_html__('Default', 'coney'),
                'large-width' => esc_html__('Large Width', 'coney'),
                'large-height' => esc_html__('Large Height', 'coney'),
                'large-width-height' => esc_html__('Large Width/Height', 'coney')
            )
        ));

        coney_qodef_create_meta_box_field(array(
            'name' => 'qodef_blog_masonry_gallery_original_dimensions_meta',
            'type' => 'select',
            'label' => esc_html__('Dimensions for Original Proportion', 'coney'),
            'description' => esc_html__('Choose image layout when it appears in Blog Metro list in original proportion', 'coney'),
            'default_value' => 'default',
            'parent' => $post_meta_box,
            'options' => array(
                'default' => esc_html__('Default', 'coney'),
                'large-width' => esc_html__('Large Width', 'coney')
            )
        ));

        coney_qodef_create_meta_box_field(
            array(
                'name' => 'qodef_show_title_area_blog_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Show Title Area', 'coney'),
                'description' => esc_html__('Enabling this option will show title area on your single post page', 'coney'),
                'parent'      => $post_meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'coney'),
                    'yes' => esc_html__('Yes', 'coney'),
                    'no' => esc_html__('No', 'coney')
                )
            )
        );
    }
    
    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_post_meta', 20);
}
