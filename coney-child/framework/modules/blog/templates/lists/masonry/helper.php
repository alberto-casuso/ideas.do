<?php

if( !function_exists('coney_qodef_get_blog_holder_params') ) {
    /**
     * Function that generates params for holders on blog templates
     */
    function coney_qodef_get_blog_holder_params($params) {
        $params_list = array();

        $masonry_layout = coney_qodef_get_meta_field_intersect('blog_masonry_layout');
        if($masonry_layout === 'in-grid') {
            $params_list['holder'] = 'qodef-container';
            $params_list['inner'] = 'qodef-container-inner clearfix';
        }
        else {
            $params_list['holder'] = 'qodef-full-width';
            $params_list['inner'] = 'qodef-full-width-inner';
        }

        return $params_list;
    }

    add_filter( 'coney_qodef_blog_holder_params', 'coney_qodef_get_blog_holder_params' );
}

if( !function_exists('coney_qodef_get_blog_list_classes') ) {
	/**
	 * Function that generates blog list holder classes for blog list templates
	 */
	function coney_qodef_get_blog_list_classes($classes) {
		$list_classes   = array();
		$list_classes[] = 'qodef-blog-type-masonry';
		
		$number_of_columns = coney_qodef_get_meta_field_intersect('blog_masonry_number_of_columns');
		if(!empty($number_of_columns)) {
			$list_classes[] = 'qodef-blog-' . $number_of_columns . '-columns';
		}
		
		$space_between_items = coney_qodef_get_meta_field_intersect('blog_masonry_space_between_items');
		if(!empty($space_between_items)) {
			$list_classes[] = 'qodef-blog-' . $space_between_items . '-space';
		}

        $masonry_layout = coney_qodef_get_meta_field_intersect('blog_masonry_layout');
        $list_classes[] = 'qodef-blog-masonry-' . $masonry_layout;

        //Class that defines type of animation
        $list_classes[] = 'qodef-blog-animate-cycle';
		
		$classes = array_merge($classes, $list_classes);
		
		return $classes;
	}
	
	add_filter( 'coney_qodef_blog_list_classes', 'coney_qodef_get_blog_list_classes' );
}

if( !function_exists('coney_qodef_blog_part_params') ) {
    function coney_qodef_blog_part_params($params) {

        $part_params = array();
        $part_params['title_tag'] = 'h5';
        $part_params['link_tag'] = 'h4';
        $part_params['quote_tag'] = 'h4';
        $part_params['share_font'] = 'font-awesome';

        return array_merge($params, $part_params);
    }

    add_filter( 'coney_qodef_blog_part_params', 'coney_qodef_blog_part_params' );
}

if( !function_exists('coney_qodef_blog_read_more_params') ) {
    function coney_qodef_blog_read_more_params($params) {

        $part_params = array();
        $part_params['type'] = 'transparent';
        $part_params['link'] = get_the_permalink();
        $part_params['text'] = esc_html__('Leer más', 'coney');

        return array_merge($params, $part_params);
    }

    add_filter( 'coney_qodef_blog_template_read_more_button', 'coney_qodef_blog_read_more_params' );
}