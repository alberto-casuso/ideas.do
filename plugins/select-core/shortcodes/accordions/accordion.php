<?php
namespace ConeyQodef\Modules\Shortcodes\Accordion;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
* class Accordions
*/
class Accordion implements ShortcodeInterface{
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'qodef_accordion';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return	$this->base;
	}

	public function vcMap() {
		vc_map( array(
			'name' =>  esc_html__('Select Accordion', 'select-core'),
			'base' => $this->base,
			'as_parent' => array('only' => 'qodef_accordion_tab'),
			'content_element' => true,
			'category' => esc_html__('by SELECT', 'select-core'),
			'icon' => 'icon-wpb-accordion extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'       => 'textfield',
					'param_name' => 'el_class',
					'heading'    => esc_html__('Custom CSS Class', 'select-core')
				),
                array(
					'type'       => 'dropdown',
					'param_name' => 'style',
					'heading'    => esc_html__('Style', 'select-core'),
					'value'      => array(
						esc_html__('Accordion', 'select-core') => 'accordion',
						esc_html__('Toggle', 'select-core') => 'toggle'
					)
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'background_skin',
					'heading'    => esc_html__('Background Skin', 'select-core'),
					'value' => array(
						esc_html__('Default', 'select-core') => '',
						esc_html__('White', 'select-core') => 'white'
					)
				)
			)
		) );
	}
	
	public function render($atts, $content = null) {
		$default_atts=(array(
			'el_class'        => '',
			'title'           => '',
			'style'           => 'accordion',
			'background_skin' => ''
		));
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);

		$params['acc_class'] = $this->getAccordionClasses($params);
		$params['content'] = $content;

		$output = '';

		$output .= select_core_get_shortcode_template_part('templates/accordion-holder-template','accordions', '', $params);

		return $output;
	}

	/**
	   * Generates accordion classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getAccordionClasses($params){

		$acc_class = 'qodef-ac-default';

		switch($params['style']) {
            case 'toggle':
                $acc_class .= ' qodef-toggle';
                break;
            default:
                $acc_class .= ' qodef-accordion';
                break;
        }

        $acc_class .= ' qodef-ac-boxed';

		if (!empty($params['background_skin'])) {
			$acc_class .= ' qodef-'.esc_attr($params['background_skin']).'-skin';
		}

		if (!empty($params['el_class'])) {
			$acc_class .= ' '.esc_attr($params['el_class']);
		}

        return $acc_class;
	}
}
