<?php
namespace ConeyQodef\Modules\Shortcodes\Tabs;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tabs
 */
class Tabs implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	
	function __construct() {
		$this->base = 'qodef_tabs';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Select Tabs', 'select-core'),
			'base' => $this->getBase(),
			'as_parent' => array('only' => 'qodef_tab'),
			'content_element' => true,
			'category' => esc_html__('by SELECT', 'select-core'),
			'icon' => 'icon-wpb-tabs extended-custom-icon',
			'js_view' => 'VcColumnView',
			'params' => array(
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'layout_type',
                    'heading'    => esc_html__('Type', 'select-core'),
                    'value'      => array(
                        esc_html__('Flexible', 'select-core') => 'flexible',
                        esc_html__('Fixed', 'select-core')    => 'fixed',
                    )
                ),
				array(
					'type'       => 'dropdown',
					'param_name' => 'type',
					'heading'    => esc_html__('Layout', 'select-core'),
					'value'      => array(
						esc_html__('Standard', 'select-core') => 'standard',
						esc_html__('Boxed', 'select-core')    => 'boxed',
						esc_html__('Simple', 'select-core')   => 'simple',
						esc_html__('Vertical', 'select-core') => 'vertical'
					),
                    'dependency' => array('element' => 'layout_type', 'value' => 'flexible')
				),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'columns',
                    'heading'    => esc_html__('Number of columns', 'select-core'),
                    'value'      => array(
                        esc_html__('One', 'select-core') => 'one',
                        esc_html__('Two', 'select-core')    => 'two',
                        esc_html__('Three', 'select-core')   => 'three',
                        esc_html__('Four', 'select-core') => 'four',
                        esc_html__('Five', 'select-core') => 'five',
                        esc_html__('Six', 'select-core') => 'six',
                    ),
                    'dependency' => array('element' => 'layout_type', 'value' => 'fixed')
                )
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'type' => 'standard',
			'layout_type' => 'flexible',
			'columns' => 'one',
		);

        $params  = shortcode_atts($args, $atts);
		extract($params);
		
		// Extract tab titles
		preg_match_all('/title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
		$tab_titles = array();

		/**
		 * get tab titles array
		 */
		if (isset($matches[0])) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach($tab_titles as $tab) {
			preg_match('/title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['tabs_titles']    = $tab_title_array;
		$params['content']        = $content;
		
		$output = '';
		
		$output .= select_core_get_shortcode_template_part('templates/tab-template','tabs', '', $params);
		
		return $output;
	}
	
	/**
	 * Generates holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getHolderClasses($params){
		$holder_classes = array();
		
		$holder_classes[] = ($params['type'] !== " "  && $params['layout_type'] == 'flexible' ) ? 'qodef-tabs-'.esc_attr($params['type']) : '';
		$holder_classes[] = !empty($params['layout_type']) ? 'qodef-tabs-'.esc_attr($params['layout_type']) : 'qodef-tabs-flexible';
		$holder_classes[] = !empty($params['columns']) ? 'qodef-tabs-columns-'.esc_attr($params['columns']) : 'qodef-tabs-standard';

		return implode(' ', $holder_classes);
	}
}