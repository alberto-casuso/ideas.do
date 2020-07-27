<?php
namespace ConeyQodef\Modules\Shortcodes\IconListItem;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Icon List Item
 */
class IconListItem implements ShortcodeInterface{
	/**
	 * @var string
	 */
	private $base;
	
	function __construct() {
		$this->base = 'qodef_icon_list_item';
		
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
		vc_map( array(
			'name' => esc_html__('Select Icon List Item', 'select-core'),
			'base' => $this->base,
			'icon' => 'icon-wpb-icon-list-item extended-custom-icon',
			'category' => esc_html__('by SELECT', 'select-core'),
			'params' => array_merge(
				array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'item_margin',
						'heading'     => esc_html__('Icon List Item Bottom Margin (px)', 'select-core'),
						'description' => esc_html__('Set bottom margin for your Icon List Item element. Default value is 8', 'select-core')
					)
				),
				\ConeyQodefIconCollections::get_instance()->getVCParamsArray(),
				array(
					array(
						'type'       => 'textfield',
						'param_name' => 'icon_size',
						'heading'    => esc_html__('Icon Size (px)', 'select-core')
					),
					array(
						'type'       => 'colorpicker',
						'param_name' => 'icon_color',
						'heading'    => esc_html__('Icon Color', 'select-core')
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'title',
						'heading'    => esc_html__('Title', 'select-core')
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'title_size',
						'heading'    => esc_html__('Title Size (px)', 'select-core'),
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type'       => 'colorpicker',
						'param_name' => 'title_color',
						'heading'    => esc_html__('Title Color', 'select-core'),
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'title_padding',
						'heading'     => esc_html__('Title Left Padding (px)', 'select-core'),
						'description' => esc_html__('Set left padding for your text element to adjust space between icon and text. Default value is 13', 'select-core'),
						'dependency'  => Array('element' => 'title', 'not_empty' => true)
					)
				)
			)
		) );
	}
	
	public function render($atts, $content = null) {
		$args = array(
			'item_margin'   => '',
            'icon_size'     => '',
            'icon_color'    => '',
            'title'         => '',
            'title_color'   => '',
            'title_size'    => '',
			'title_padding' => ''
        );

        $args = array_merge($args, coney_qodef_icon_collections()->getShortcodeParams());
		
        $params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);
		$iconPackName = coney_qodef_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		
		$params['holder_styles']  = $this->getHolderStyles($params);
		$params['icon'] = $params[$iconPackName];
		$params['icon_attributes']['style'] =  $this->getIconStyles($params);
		$params['title_styles'] =  $this->getTitleStyles($params);

		//Get HTML from template
		$html = select_core_get_shortcode_template_part('templates/icon-list-item-template', 'icon-list-item', '', $params);
		
		return $html;
	}
	
	/**
	 * Generates holder styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getHolderStyles($params){
		$styles = array();
		
		if(!empty($params['item_margin'])) {
			$styles[] = 'margin-bottom: '.coney_qodef_filter_px($params['item_margin']).'px';
		}
		
		return implode(';', $styles);
	}
	
	 /**
     * Generates icon styles
     *
     * @param $params
     *
     * @return array
     */
	private function getIconStyles($params){
		$styles = array();
		
		if(!empty($params['icon_color'])) {
			$styles[] = 'color: '.$params['icon_color'];
		}

		if (!empty($params['icon_size'])) {
			$styles[] = 'font-size: '.coney_qodef_filter_px($params['icon_size']).'px';
		}
		
		return implode(';', $styles);
	}
	
	 /**
     * Generates title styles
     *
     * @param $params
     *
     * @return array
     */
	private function getTitleStyles($params){
		$styles = array();
		
		if(!empty($params['title_color'])) {
			$styles[] = 'color: '.$params['title_color'];
		}

		if (!empty($params['title_size'])) {
			$styles[] = 'font-size: '.coney_qodef_filter_px( $params['title_size']).'px';
		}
		
		if(!empty($params['title_padding'])) {
			$styles[] = 'padding-left: '.coney_qodef_filter_px($params['title_padding']).'px';
		}
		
		return implode(';', $styles);
	}
}