<?php
namespace ConeyQodef\Modules\Shortcodes\PricingTables;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTables implements ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_pricing_tables';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map(
			array(
				'name' => esc_html__('Select Pricing Tables', 'select-core'),
				'base' => $this->base,
				'as_parent' => array('only' => 'qodef_pricing_table'),
				'content_element' => true,
				'category' => esc_html__('by SELECT', 'select-core'),
				'icon' => 'icon-wpb-pricing-tables extended-custom-icon',
				'show_settings_on_create' => true,
				'js_view' => 'VcColumnView',
				'params' => array(
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Number of Columns', 'select-core'),
						'param_name' => 'columns',
						'value' => array(
							esc_html__('One', 'select-core') => 'qodef-one-column',
							esc_html__('Two', 'select-core') => 'qodef-two-columns',
							esc_html__('Three', 'select-core') => 'qodef-three-columns',
							esc_html__('Four', 'select-core') => 'qodef-four-columns',
							esc_html__('Five', 'select-core') => 'qodef-five-columns',
						)
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'space_between_columns',
						'heading'    => esc_html__('Space Between Columns', 'select-core'),
						'value'      => array(
							esc_html__('Normal', 'select-core') => 'normal',
							esc_html__('Small', 'select-core') => 'small',
							esc_html__('Tiny', 'select-core') => 'tiny',
							esc_html__('No Space', 'select-core') => 'no'
						)
					)
				)
			)
		);
	}

	public function render($atts, $content = null) {
		$args = array(
			'columns'         	    => 'qodef-two-columns',
			'space_between_columns' => 'normal'
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);

		$holder_class = '';
		
		if (!empty($columns)) {
			$holder_class .= ' '.$columns;
		}

		if (!empty($space_between_columns)) {
			$holder_class .= ' qodef-pt-'.$space_between_columns.'-space';
		}
		
		$html = '<div class="qodef-pricing-tables clearfix '.esc_attr($holder_class).'">';
			$html .= '<div class="qodef-pt-wrapper">';
				$html .= do_shortcode($content);
			$html .= '</div>';
		$html .= '</div>';

		return $html;
	}
}