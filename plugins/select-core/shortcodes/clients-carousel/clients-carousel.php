<?php
namespace ConeyQodef\Modules\Shortcodes\ClientsCarousel;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

class ClientsCarousel implements ShortcodeInterface{

	private $base;

	/**
	 * Clients Carousel constructor.
	 */
	public function __construct() {
		$this->base = 'qodef_clients_carousel';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		vc_map(array(
			'name' => esc_html__('Select Clients Carousel', 'select-core'),
			'base' => $this->getBase(),
			'category' => esc_html__('by SELECT', 'select-core'),
			'icon' => 'icon-wpb-clients-carousel extended-custom-icon',
			'as_parent' => array('only' => 'qodef_clients_carousel_item'),
			'content_element' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'        => 'textfield',
					'param_name'  => 'carousel_number_of_items',
					'heading'     => esc_html__('Carousel Number Of Visisble Items', 'select-core'),
					'description' => esc_html__('Set number of visible items for clients carousel. Default value is 4', 'select-core')
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'carousel_autoplay',
					'heading'     => esc_html__('Enable Carousel Autoplay', 'select-core'),
					'value'       => array_flip(coney_qodef_get_yes_no_select_array(false, true))
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'carousel_autoplay_timeout',
					'heading'     => esc_html__('Carousel Slide Duration (ms)', 'select-core'),
					'description' => esc_html__('Autoplay interval timeout. Default value is 5000', 'select-core'),
					'dependency'  => array('element' => 'carousel_autoplay', 'value' => array('yes'))
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'carousel_loop',
					'heading'     => esc_html__('Enable Carousel Loop', 'select-core'),
					'value'       => array_flip(coney_qodef_get_yes_no_select_array(false, true))
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'carousel_speed',
					'heading'     => esc_html__('Carousel Animation Speed (ms)', 'select-core'),
					'description' => esc_html__('Carousel Speed interval. Default value is 650', 'select-core'),
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'items_hover_animation',
					'heading'    => esc_html__('Items Hover Animation', 'select-core'),
					'value'      => array(
						esc_html__('Switch Images', 'select-core') => 'switch-images',
						esc_html__('Roll Over', 'select-core') => 'roll-over'
					)
				)
			)
		));
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'carousel_number_of_items'  => '4',
			'carousel_autoplay'	 	  	=> 'yes',
			'carousel_autoplay_timeout' => '5000',
			'carousel_loop'	 		 	=> 'yes',
			'carousel_speed' 		 	=> '650',
			'items_hover_animation'     => 'switch-images'
		);
		
		$params = shortcode_atts($args, $atts);
		
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['carousel_data'] = $this->getCarouselData($params);
		$params['content'] = $content;
		
		$html = select_core_get_shortcode_template_part('templates/clients-carousel', 'clients-carousel', '', $params);
		
		return $html;
	}
	
	/**
	 * Generates holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getHolderClasses($params){
		$holderClasses = '';
		
		$holderClasses .= !empty($params['items_hover_animation']) ? ' qodef-cc-hover-'.$params['items_hover_animation'] : ' qodef-cc-hover-switch-images';
		
		return $holderClasses;
	}
	
	/**
	 * Return all configuration data for carousel
	 *
	 * @param $params
	 * @return array
	 */
	private function getCarouselData($params) {
		
		$carousel_data = array();
		
		$carousel_data['data-number-of-items'] = (!empty($params['carousel_number_of_items'])) ? $params['carousel_number_of_items'] : '4';
		$carousel_data['data-autoplay'] = (!empty($params['autoplay'])) ? $params['carousel_autoplay'] : 'yes';
		$carousel_data['data-autoplay-timeout'] = (!empty($params['carousel_autoplay_timeout'])) ? $params['carousel_autoplay_timeout'] : '5000';
		$carousel_data['data-loop'] = (!empty($params['carousel_loop'])) ? $params['carousel_loop'] : 'yes';
		$carousel_data['data-speed'] = (!empty($params['carousel_speed'])) ? $params['carousel_speed'] : '650';
		
		return $carousel_data;
	}
}