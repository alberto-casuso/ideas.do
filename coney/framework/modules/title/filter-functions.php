<?php

if(!function_exists('coney_qodef_title_classes')) {
    /**
     * Function that adds classes to title div.
     * All other functions are tied to it with add_filter function
     * @param array $classes array of classes
     * @param string $module name of module calling title
     */
    function coney_qodef_title_classes($classes = array()) {
        $classes = array();
        $classes = apply_filters('coney_qodef_title_classes', $classes);

        if(is_array($classes) && count($classes)) {
            echo implode(' ', $classes);
        }
    }
}

if(!function_exists('coney_qodef_title_type_class')) {
    /**
     * Function that adds class on title based on title type option
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function coney_qodef_title_type_class($classes) {
        $title_type = coney_qodef_get_meta_field_intersect('title_area_type', coney_qodef_get_page_id());

	    if(!empty($title_type)) {
		    $classes[] = 'qodef-'.$title_type.'-type';
	    }

        return $classes;
    }

    add_filter('coney_qodef_title_classes', 'coney_qodef_title_type_class');
}

if(!function_exists('coney_qodef_title_content_alignment_class')) {
	/**
	 * Function that adds class on title based on title content alignmnt option
	 * Could be left, centered or right
	 * @param $classes original array of classes
	 * @return array changed array of classes
	 */
	function coney_qodef_title_content_alignment_class($classes) {
		$title_content_alignment = coney_qodef_get_meta_field_intersect('title_area_content_alignment', coney_qodef_get_page_id());
		
		if(!empty($title_content_alignment)) {
			$classes[] = 'qodef-content-'.$title_content_alignment.'-alignment';
		}
		
		return $classes;
	}
	
	add_filter('coney_qodef_title_classes', 'coney_qodef_title_content_alignment_class');
}

if(!function_exists('coney_qodef_title_background_image_classes')) {
    function coney_qodef_title_background_image_classes($classes) {
        //init variables
        $id                      = coney_qodef_get_page_id();
	    $title_img				 = coney_qodef_get_meta_field_intersect('title_area_background_image', $id);
	    $is_img_responsive 		 = coney_qodef_get_meta_field_intersect('title_area_background_image_responsive', $id);
	    $is_image_parallax		 = coney_qodef_get_meta_field_intersect('title_area_background_image_parallax', $id);
	    $is_image_parallax_array = array('yes', 'yes_zoom');
	    $show_title_img			 = get_post_meta($id, "qodef_hide_background_image_meta", true) == 'yes' ? false : true;

        //is title image set and visible?
        if($title_img !== '' && $show_title_img == true) {
            //is image not responsive and parallax title is set?
            $classes[] = 'qodef-preload-background';
            $classes[] = 'qodef-has-background';

            if($is_img_responsive == 'no' && in_array($is_image_parallax, $is_image_parallax_array)) {
                $classes[] = 'qodef-has-parallax-background';

                if($is_image_parallax == 'yes_zoom') {
                    $classes[] = 'qodef-zoom-out';
                }
            }

            //is image not responsive
            elseif($is_img_responsive == 'yes'){
                $classes[] = 'qodef-has-responsive-background';
            }
        }

        return $classes;
    }

    add_filter('coney_qodef_title_classes', 'coney_qodef_title_background_image_classes');
}

if(!function_exists('coney_qodef_title_background_image_div_classes')) {
	function coney_qodef_title_background_image_div_classes($classes) {
		//init variables
		$id                 = coney_qodef_get_page_id();
		$title_img			= coney_qodef_get_meta_field_intersect('title_area_background_image', $id);
		$is_img_responsive 	= coney_qodef_get_meta_field_intersect('title_area_background_image_responsive', $id);
		$show_title_img		= get_post_meta($id, "qodef_hide_background_image_meta", true) == 'yes' ? false : true;
		
		//is title image set, visible and responsive?
		if($title_img !== '' && $show_title_img == true) {
			
			//is image responsive?
			if($is_img_responsive == 'yes') {
				$classes[] = 'qodef-title-image-responsive';
			}
			//is image not responsive?
			elseif($is_img_responsive == 'no') {
				$classes[] = 'qodef-title-image-not-responsive';
			}
		}
		
		return $classes;
	}
	
	add_filter('coney_qodef_title_classes', 'coney_qodef_title_background_image_div_classes');
}