<?php
namespace ConeyQodef\Modules\Shortcodes\ElementsHolder;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

class ElementsHolder implements ShortcodeInterface{
	private $base;
	
	function __construct() {
		$this->base = 'qodef_elements_holder';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Select Elements Holder', 'select-core'),
			'base' => $this->base,
			'icon' => 'icon-wpb-elements-holder extended-custom-icon',
			'category' => esc_html__('by SELECT', 'select-core'),
			'as_parent' => array('only' => 'qodef_elements_holder_item'),
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'       => 'colorpicker',
					'param_name' => 'background_color',
					'heading'    => esc_html__('Background Color', 'select-core')
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'number_of_columns',
					'heading'    => esc_html__('Columns', 'select-core'),
					'value'      => array(
						esc_html__('1 Column', 'select-core')  => 'one-column',
						esc_html__('2 Columns', 'select-core') => 'two-columns',
						esc_html__('3 Columns', 'select-core') => 'three-columns',
						esc_html__('4 Columns', 'select-core') => 'four-columns',
						esc_html__('5 Columns', 'select-core') => 'five-columns',
						esc_html__('6 Columns', 'select-core') => 'six-columns'
					)
				),
				array(
					'type'       => 'checkbox',
					'param_name' => 'items_float_left',
					'heading'    => esc_html__('Items Float Left', 'select-core'),
					'value'      => array('Make Items Float Left?' => 'yes')
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'switch_to_one_column',
					'heading'    => esc_html__('Switch to One Column', 'select-core'),
					'value'      => array(
						esc_html__('Default', 'select-core')   	=> '',
						esc_html__('Below 1280px', 'select-core') 	=> '1280',
						esc_html__('Below 1024px', 'select-core')  => '1024',
						esc_html__('Below 768px', 'select-core')   => '768',
						esc_html__('Below 600px', 'select-core')   => '600',
						esc_html__('Below 480px', 'select-core')   => '480',
						esc_html__('Never', 'select-core')    		=> 'never'
					),
					'description' => esc_html__('Choose on which stage item will be in one column', 'select-core'),
					'save_always' => true
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'alignment_one_column',
					'heading'    => esc_html__('Choose Alignment In Responsive Mode', 'select-core'),
					'value'      => array(
						esc_html__('Default', 'select-core') => '',
						esc_html__('Left', 'select-core') 	  => 'left',
						esc_html__('Center', 'select-core')  => 'center',
						esc_html__('Right', 'select-core')   => 'right'
					),
					'description' => esc_html__('Alignment When Items are in One Column', 'select-core'),
					'save_always' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'number_of_columns' 	=> '',
			'switch_to_one_column'	=> '',
			'alignment_one_column' 	=> '',
			'items_float_left' 		=> '',
			'background_color' 		=> ''
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);

		$html = '';

		$elements_holder_classes = array();
		$elements_holder_classes[] = 'qodef-elements-holder';
		$elements_holder_style = '';

		if($number_of_columns != ''){
			$elements_holder_classes[] .= 'qodef-'.$number_of_columns ;
		}

		if($switch_to_one_column != ''){
			$elements_holder_classes[] = 'qodef-responsive-mode-' . $switch_to_one_column ;
		} else {
			$elements_holder_classes[] = 'qodef-responsive-mode-768' ;
		}

		if($alignment_one_column != ''){
			$elements_holder_classes[] = 'qodef-one-column-alignment-' . $alignment_one_column ;
		}

		if($items_float_left !== ''){
			$elements_holder_classes[] = 'qodef-ehi-float';
		}

		if($background_color != ''){
			$elements_holder_style .= 'background-color:'. $background_color . ';';
		}

		$elements_holder_class = implode(' ', $elements_holder_classes);

		$html .= '<div ' . coney_qodef_get_class_attribute($elements_holder_class) . ' ' . coney_qodef_get_inline_attr($elements_holder_style, 'style'). '>';
			$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;
	}
}
