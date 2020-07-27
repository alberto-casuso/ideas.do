<?php

/**
 * Loads more function for portfolio.
 *
 */
if(!function_exists('qodef_core_portfolio_ajax_load_more')) {
	function qodef_core_portfolio_ajax_load_more() {
		$shortcode_params = array();
		
		if(!empty($_POST)) {
			foreach ($_POST as $key => $value) {
				if($key !== '') {
					$addUnderscoreBeforeCapitalLetter = preg_replace('/([A-Z])/', '_$1', $key);
					$setAllLettersToLowercase = strtolower($addUnderscoreBeforeCapitalLetter);
					
					$shortcode_params[$setAllLettersToLowercase] = $value;
				}
			}
		}
		
		$html = '';
		
		$port_list = new \QodeCore\CPT\Portfolio\Shortcodes\PortfolioList();
		
		$query_array = $port_list->getQueryArray($shortcode_params);
		$query_results = new \WP_Query($query_array);
		$shortcode_params['this_object'] = $port_list;
		
		if($query_results->have_posts()):
			while ( $query_results->have_posts() ) : $query_results->the_post();
				$shortcode_params['current_id'] = get_the_ID();
				$article_classes = $port_list->getArticleClasses($shortcode_params);
				$article_class = get_post_class(array($article_classes));
				$shortcode_params['article_class'] = implode(' ', $article_class);
				
				$shortcode_params['item_link'] = $port_list->getItemLink($shortcode_params);
				
				$html .= qodef_core_get_shortcode_module_template_part('portfolio', 'portfolio-item', $shortcode_params['item_style'], $shortcode_params);
			endwhile;
		else:
			$html .= qodef_core_get_shortcode_module_template_part('portfolio', 'parts/posts-not-found', '', $shortcode_params);
		endif;
		
		wp_reset_postdata();
		
		$return_obj = array(
			'html' => $html,
		);
		
		echo json_encode($return_obj); exit;
	}
}

add_action('wp_ajax_nopriv_qodef_core_portfolio_ajax_load_more', 'qodef_core_portfolio_ajax_load_more');
add_action( 'wp_ajax_qodef_core_portfolio_ajax_load_more', 'qodef_core_portfolio_ajax_load_more' );