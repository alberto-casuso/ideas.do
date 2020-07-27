<?php
namespace ConeyQodef\Modules\Shortcodes\Separator;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

class Separator implements ShortcodeInterface{

	private $base;

	function __construct() {
		$this->base = 'qodef_separator';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map(
			array(
				'name' => esc_html__('Select Separator', 'select-core'),
				'base' => $this->base,
				'category' => esc_html__('by SELECT', 'select-core'),
				'icon' => 'icon-wpb-separator extended-custom-icon',
				'show_settings_on_create' => true,
				'class' => 'wpb_vc_separator',
				'custom_markup' => '<div></div>',
				'params' => array(
					array(
						'type'       => 'textfield',
						'param_name' => 'class_name',
						'heading'    => esc_html__('Custom CSS Class', 'select-core')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'type',
						'heading'    => esc_html__('Type', 'select-core'),
						'value'      => array(
							esc_html__('Normal', 'select-core')	=>	'normal',
							esc_html__('Full Width', 'select-core') =>	'full-width'
						)
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'position',
						'heading'    => esc_html__('Position', 'select-core'),
						'value'      => array(
							esc_html__('Center', 'select-core') => 'center',
							esc_html__('Left', 'select-core')	=> 'left',
							esc_html__('Right', 'select-core')	=> 'right'
						),
						'dependency'  => array('element' => 'type', 'value' => array('normal'))
					),
					array(
						'type'       => 'colorpicker',
						'param_name' => 'color',
						'heading'    => esc_html__('Color', 'select-core')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'border_style',
						'heading'    => esc_html__('Style', 'select-core'),
						'value'      => array(
							esc_html__('Default', 'select-core') => '',
							esc_html__('Dashed', 'select-core') => 'dashed',
							esc_html__('Solid', 'select-core') => 'solid',
							esc_html__('Dotted', 'select-core') => 'dotted'
						),
						'save_always' => true
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'width',
						'heading'    => esc_html__('Width (px or %)', 'select-core'),
						'dependency' => array('element' => 'type', 'value' => array('normal'))
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'thickness',
						'heading'    => esc_html__('Thickness (px)', 'select-core')
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'top_margin',
						'heading'    => esc_html__('Top Margin', 'select-core')
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'bottom_margin',
						'heading'    => esc_html__('Bottom Margin', 'select-core')
					)
				)
			)
		);
	}

	public function render($atts, $content = null) {
		$args = array(
			'class_name'	=>	'',
			'type'			=>	'',
			'position'		=>	'center',
			'color'			=>	'',
			'border_style'	=>	'',
			'width'			=>	'',
			'thickness'		=>	'',
			'top_margin'	=>	'',
			'bottom_margin'	=>	''
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		$params['separator_class'] = $this->getSeparatorClass($params);
		$params['separator_style'] = $this->getSeparatorStyles($params);
		
		$html = select_core_get_shortcode_template_part('templates/separator-template', 'separator', '', $params);

		return $html;
	}
	
	/**
	 * Return Separator classes
	 *
	 * @param $params
	 * @return array
	 */
	private function getSeparatorClass($params) {
		$separator_class = array();

		if ($params['class_name'] !== '') {
			$separator_class[] = esc_attr($params['class_name']);
		}
		if ($params['position'] !== '') {
			$separator_class[] = 'qodef-separator-'.$params['position'];
		}
		if ($params['type'] !== '') {
			$separator_class[] = 'qodef-separator-'.$params['type'];
		}

		return implode(' ', $separator_class);
	}

	/**
	 * Return Separator style
	 *
	 * @param $params
	 * @return array
	 */
	private function getSeparatorStyles($params) {
		$styles = array();

		if ($params['color'] !== '') {
			$styles[] = 'border-color: ' . $params['color'];
		}
		
		if ($params['border_style'] !== '') {
			$styles[] = 'border-style: ' . $params['border_style'];
		}
		
		if ($params['width'] !== '') {
			if(coney_qodef_string_ends_with($params['width'], '%') || coney_qodef_string_ends_with($params['width'], 'px')) {
				$styles[] = 'width: ' . $params['width'];
			}else{
				$styles[] = 'width: ' . $params['width'] . 'px';
			}
		}
		
		if ($params['thickness'] !== '') {
			$styles[] = 'border-bottom-width: ' . $params['thickness'] . 'px';
		}
		
		if ($params['top_margin'] !== '') {
			if(coney_qodef_string_ends_with($params['top_margin'], '%') || coney_qodef_string_ends_with($params['top_margin'], 'px')) {
				$styles[] = 'margin-top: ' . $params['top_margin'];
			}else{
				$styles[] = 'margin-top: ' . $params['top_margin'] . 'px';
			}
		}
		
		if ($params['bottom_margin'] !== '') {
			if(coney_qodef_string_ends_with($params['bottom_margin'], '%') || coney_qodef_string_ends_with($params['bottom_margin'], 'px')) {
				$styles[] = 'margin-bottom: ' . $params['bottom_margin'];
			}else{
				$styles[] = 'margin-bottom: ' . $params['bottom_margin'] . 'px';
			}
		}
		
		return implode(';', $styles);
	}
}
