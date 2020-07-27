<?php
/**
 * Woocommerce helper functions
 */

if(!function_exists('coney_qodef_get_woo_shortcode_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $module name of the module folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 * @see coney_qodef_get_template_part()
	 */
	function coney_qodef_get_woo_shortcode_module_template_part($template, $module, $slug = '', $params = array()) {
		
		//HTML Content from template
		$html          = '';
		$template_path = 'framework/modules/woocommerce/shortcodes/'.$module;
		
		$temp = $template_path.'/'.$template;
		
		if(is_array($params) && count($params)) {
			extract($params);
		}
		
		$templates = array();
		
		if($temp !== '') {
			if($slug !== '') {
				$templates[] = "{$temp}-{$slug}.php";
			}
			
			$templates[] = $temp.'.php';
		}
		$located = coney_qodef_find_template_path($templates);
		if($located) {
			ob_start();
			include($located);
			$html = ob_get_clean();
		}
		
		return $html;
	}
}


if (!function_exists('coney_qodef_woocommerce_body_class')) {
	/**
	 * Function that adds class on body for Woocommerce
	 *
	 * @param $classes
	 * @return array
	 */
	function coney_qodef_woocommerce_body_class( $classes ) {
		if(coney_qodef_is_woocommerce_page()) {
			$classes[] = 'qodef-woocommerce-page';

			if(function_exists('is_shop') && is_shop()) {
				$classes[] = 'qodef-woo-main-page';
			}

			if (is_singular('product')) {
				$classes[] = 'qodef-woo-single-page';
			}
		}
		
		return $classes;
	}

	add_filter('body_class', 'coney_qodef_woocommerce_body_class');
}

if(!function_exists('coney_qodef_woocommerce_columns_class')) {
	/**
	 * Function that adds number of columns class to header tag
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added woocommerce class
	 */
	function coney_qodef_woocommerce_columns_class($classes) {
		if(coney_qodef_is_woocommerce_installed()) {
			$products_list_number = coney_qodef_options()->getOptionValue('qodef_woo_product_list_columns');
			
			
			
			$classes[] = $products_list_number;
		}

		return $classes;
	}

	add_filter('body_class', 'coney_qodef_woocommerce_columns_class');
}

if(!function_exists('coney_qodef_woocommerce_columns_space_class')) {
	/**
	 * Function that adds space between columns class to header tag
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added woocommerce class
	 */
	function coney_qodef_woocommerce_columns_space_class($classes) {
		if(coney_qodef_is_woocommerce_installed()) {
			$columns_space = coney_qodef_options()->getOptionValue('qodef_woo_product_list_columns_space');
			$classes[] = $columns_space;
		}
		
		return $classes;
	}
	
	add_filter('body_class', 'coney_qodef_woocommerce_columns_space_class');
}

if(!function_exists('coney_qodef_woocommerce_pl_info_position_class')) {
	/**
	 * Function that adds product list info position class to header tag
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added woocommerce class
	 */
	function coney_qodef_woocommerce_pl_info_position_class($classes) {
		if(coney_qodef_is_woocommerce_installed()) {
			$classes[] = 'qodef-woo-pl-info-below-image';
		}
		
		return $classes;
	}
	
	add_filter('body_class', 'coney_qodef_woocommerce_pl_info_position_class');
}

if(!function_exists('coney_qodef_is_woocommerce_page')) {
	/**
	 * Function that checks if current page is woocommerce shop, product or product taxonomy
	 * @return bool
	 *
	 * @see is_woocommerce()
	 */
	function coney_qodef_is_woocommerce_page() {
		if (function_exists('is_woocommerce') && is_woocommerce()) {
			return is_woocommerce();
		} elseif (function_exists('is_cart') && is_cart()) {
			return is_cart();
		} elseif (function_exists('is_checkout') && is_checkout()) {
			return is_checkout();
		} elseif (function_exists('is_account_page') && is_account_page()) {
			return is_account_page();
		}
	}
}

if(!function_exists('coney_qodef_is_woocommerce_shop')) {
	/**
	 * Function that checks if current page is shop or product page
	 * @return bool
	 *
	 * @see is_shop()
	 */
	function coney_qodef_is_woocommerce_shop() {
		return function_exists('is_shop') && (is_shop() || is_product());
	}
}

if(!function_exists('coney_qodef_get_woo_shop_page_id')) {
	/**
	 * Function that returns shop page id that is set in WooCommerce settings page
	 * @return int id of shop page
	 */
	function coney_qodef_get_woo_shop_page_id() {
		if(coney_qodef_is_woocommerce_installed()) {
			return get_option('woocommerce_shop_page_id');
		}
	}
}

if(!function_exists('coney_qodef_is_product_category')) {
	function coney_qodef_is_product_category() {
		return function_exists('is_product_category') && is_product_category();
	}
}

if(!function_exists('coney_qodef_is_product_tag')) {
	function coney_qodef_is_product_tag() {
		return function_exists('is_product_tag') && is_product_tag();
	}
}

if(!function_exists('coney_qodef_load_woo_assets')) {
	/**
	 * Function that checks whether WooCommerce assets needs to be loaded.
	 *
	 * @see coney_qodef_is_woocommerce_page()
	 * @see coney_qodef_has_woocommerce_shortcode()
	 * @see coney_qodef_has_woocommerce_widgets()
	 * @return bool
	 */

	function coney_qodef_load_woo_assets() {
		return coney_qodef_is_woocommerce_installed() && (coney_qodef_is_woocommerce_page() || coney_qodef_has_woocommerce_shortcode() || coney_qodef_has_woocommerce_widgets());
	}
}

if(!function_exists('coney_qodef_return_woocommerce_global_variable')) {
	function coney_qodef_return_woocommerce_global_variable() {
		if(coney_qodef_is_woocommerce_installed()) {
			global $product;

			return $product;
		}
	}
}

if(!function_exists('coney_qodef_has_woocommerce_shortcode')) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return bool
	 */
	function coney_qodef_has_woocommerce_shortcode() {
		$woocommerce_shortcodes = array(
			'add_to_cart',
			'add_to_cart_url',
			'product_page',
			'product',
			'products',
			'product_categories',
			'product_category',
			'recent_products',
			'featured_products',
			'sale_products',
			'best_selling_products',
			'top_rated_products',
			'product_attribute',
			'related_products',
			'woocommerce_messages',
			'woocommerce_cart',
			'woocommerce_checkout',
			'woocommerce_order_tracking',
			'woocommerce_my_account',
			'woocommerce_edit_address',
			'woocommerce_change_password',
			'woocommerce_view_order',
			'woocommerce_pay',
			'woocommerce_thankyou'
		);

		foreach($woocommerce_shortcodes as $woocommerce_shortcode) {
			$has_shortcode = coney_qodef_has_shortcode($woocommerce_shortcode);

			if($has_shortcode) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('coney_qodef_has_woocommerce_widgets')) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return bool
	 */
	function coney_qodef_has_woocommerce_widgets() {
		$widgets_array = array(
			'qodef_woocommerce_dropdown_cart',
			'woocommerce_widget_cart',
			'woocommerce_layered_nav',
			'woocommerce_layered_nav_filters',
			'woocommerce_price_filter',
			'woocommerce_product_categories',
			'woocommerce_product_search',
			'woocommerce_product_tag_cloud',
			'woocommerce_products',
			'woocommerce_recent_reviews',
			'woocommerce_recently_viewed_products',
			'woocommerce_top_rated_products'
		);

		foreach($widgets_array as $widget) {
			$active_widget = is_active_widget(false, false, $widget);

			if($active_widget) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('coney_qodef_add_woocommerce_shortcode_class')) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return string
	 */
	function coney_qodef_add_woocommerce_shortcode_class($classes){
		$woocommerce_shortcodes = array(
			'woocommerce_order_tracking'
		);

		foreach($woocommerce_shortcodes as $woocommerce_shortcode) {
			$has_shortcode = coney_qodef_has_shortcode($woocommerce_shortcode);

			if($has_shortcode) {
				$classes[] = 'qodef-woocommerce-page woocommerce-account qodef-'.str_replace('_', '-', $woocommerce_shortcode);
			}
		}

		return $classes;
	}

	add_filter('body_class', 'coney_qodef_add_woocommerce_shortcode_class');
}

if(!function_exists('coney_qodef_woocommerce_product_single_class')) {
	function coney_qodef_woocommerce_product_single_class($classes) {
		if(in_array('woocommerce', $classes)) {
			$product_thumbnail_position = coney_qodef_get_meta_field_intersect('woo_set_thumb_images_position');
			
			if(coney_qodef_get_meta_field_intersect('woo_enable_single_thumb_featured_switch') === 'yes') {
				$classes[] = 'qodef-woo-single-switch-image';
			}
			
			if(!empty($product_thumbnail_position)) {
				$classes[] = 'qodef-woo-single-thumb-'.$product_thumbnail_position;
			}
		}
		
		return $classes;
	}
	
	add_filter('body_class', 'coney_qodef_woocommerce_product_single_class');
}