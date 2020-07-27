<?php

if (!function_exists('coney_qodef_footer_top_classes')) {
	/**
	 * Return classes for footer top
	 *
	 * @return string
	 */
	function coney_qodef_footer_top_classes() {

		$footer_top_classes = array();

		$grid_class = coney_qodef_options()->getOptionValue('footer_in_grid') == 'yes' ? 'qodef-grid' : 'qodef-full-width';

		//footer aligment
		$footer_top_alignment = coney_qodef_options()->getOptionValue('footer_top_columns_alignment');
		$footer_top_classes[] = $footer_top_alignment !== '' ? 'qodef-footer-top-alignment-'.esc_attr($footer_top_alignment) : '';

		$footer_top_columns =  coney_qodef_options()->getOptionValue('footer_top_columns');

		switch($footer_top_columns){
			case '1':
				$footer_top_classes[] = 'qodef-content-columns-100';
				break;
			case '2':
				$footer_top_classes[] = 'qodef-content-columns-50-50';
				break;
			case '3':
				$footer_top_classes[] = 'qodef-content-columns-three';
				break;
			case '4':
				$footer_top_classes[] = 'qodef-content-columns-four';
				break;
		}

		$footer_top_classes['three-cols-layout'] = '';
		if($footer_top_columns === '3' ){
			$footer_top_classes['three-cols-layout']  = 'qodef-'.coney_qodef_options()->getOptionValue('footer_top_three_columns_layout');
		}
		
		//set spacing between columns
		$footer_top_classes[] = 'qodef-columns-normal-space';

		$footer_top_classes_array = apply_filters('coney_qodef_footer_top_classes', $footer_top_classes);

		$classes = implode(' ', $footer_top_classes_array);

		$return_array = array(
			'grid_class' => $grid_class,
			'classes' => $classes
		);

		return $return_array;
	}
}

if (!function_exists('coney_qodef_footer_bottom_classes')) {
	/**
	 * Return classes for footer bottom
	 *
	 * @return string
	 */
	function coney_qodef_footer_bottom_classes() {

		$footer_bottom_classes = array();

		$grid_class = coney_qodef_options()->getOptionValue('footer_in_grid') == 'yes' ? 'qodef-grid' : 'qodef-full-width';

		$footer_bottom_columns =  coney_qodef_options()->getOptionValue('footer_bottom_columns');

		switch($footer_bottom_columns){
			case '1':
				$footer_bottom_classes[] = 'qodef-content-columns-100';
				break;
			case '2':
				$footer_bottom_classes[] = 'qodef-content-columns-50-50';
				break;
			case '3':
				$footer_bottom_classes[] = 'qodef-content-columns-three';
				break;
		}

		$footer_bottom_classes[] = 'qodef-columns-normal-space';

		$footer_bottom_classes_array = apply_filters('coney_qodef_footer_bottom_classes', $footer_bottom_classes);

		$classes = implode(' ', $footer_bottom_classes_array);

		$return_array = array(
			'grid_class' => $grid_class,
			'classes' => $classes
		);

		return $return_array;
	}
}