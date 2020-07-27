<?php
namespace ConeyQodef\Modules\Shortcodes\AccordionTab;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
* class Accordions
*/
class AccordionTab implements ShortcodeInterface{
	/**
	 * @var string
	 */
	private $base;
	
	function __construct() {
		$this->base = 'qodef_accordion_tab';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			"name" => esc_html__('Select Accordion Tab', 'select-core'),
			"base" => $this->base,
			"as_child" => array('only' => 'qodef_accordion'),
			'is_container' => true,
			"category" => esc_html__('by SELECT', 'select-core'),
			"icon" => "icon-wpb-accordion-tab extended-custom-icon",
			"show_settings_on_create" => true,
			"js_view" => 'VcColumnView',
			"params" => array(
				array(
					'type'        => 'textfield',
					'param_name'  => 'title',
					'heading'     => esc_html__('Title', 'select-core'),
					'description' => esc_html__('Enter accordion section title', 'select-core')
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'title_tag',
					'heading'    => esc_html__('Title Tag', 'select-core'),
					'value'      => array_flip(coney_qodef_get_title_tag(true, array('p' => 'p', 'span' => 'span'))),
				)
			)
		));
	}
	
	public function render($atts, $content = null) {
		$default_atts = (array(
			'title'	    => 'Section',
			'title_tag' => 'h6'
		));
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		$params['content'] = $content;
		
		$params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $default_atts['title_tag'];
		
		$output = '';
		
		$output .= select_core_get_shortcode_template_part('templates/accordion-template','accordions', '',$params);

		return $output;
	}
}