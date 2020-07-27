<?php
namespace ConeyQodef\Modules\Shortcodes\ProgressBar;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProgressBar implements ShortcodeInterface{
	private $base;
	
	function __construct() {
		$this->base = 'qodef_progress_bar';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Select Progress Bar', 'select-core'),
			'base' => $this->base,
			'icon' => 'icon-wpb-progress-bar extended-custom-icon',
			'category' => esc_html__('by SELECT', 'select-core'),
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type'       => 'textfield',
					'param_name' => 'percent',
					'heading'    => esc_html__('Percentage', 'select-core')
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'title',
					'heading'    => esc_html__('Title', 'select-core')
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'title_tag',
					'heading'     => esc_html__('Title Tag', 'select-core'),
					'value'       => array_flip(coney_qodef_get_title_tag(true, array('p' => 'p'))),
					'save_always' => true,
					'dependency'  => array('element' => 'title', 'not_empty' => true)
				),
                array(
                    'type'       => 'colorpicker',
                    'param_name' => 'color_active',
                    'heading'    => esc_html__('Active Color', 'select-core')
                ),
                array(
                    'type'       => 'colorpicker',
                    'param_name' => 'color_inactive',
                    'heading'    => esc_html__('Inactive Color', 'select-core')
                )
			)
		) );
	}

	public function render($atts, $content = null) {
		$args = array(
			'percent'       => '100',
            'title'         => '',
            'title_tag'     => 'h6',
            'color_active'  => '',
            'color_inactive' => ''
        );
		$params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);
		
        $params['active_bar_style']  = $this->getActiveColor($params);
        $params['inactive_bar_style']  = $this->getInactiveColor($params);
		$params['title_tag'] = !empty($title_tag) ? $title_tag : $args['title_tag'];
        $params['holder_class'] = $this->getHolderClasses($params);
		
        //init variables
		$html = select_core_get_shortcode_template_part('templates/progress-bar-template', 'progress-bar', '', $params);
		
        return $html;
	}

    /**
     * Return active color for active bar
     *
     * @param $params
     *
     * @return array
     */
    private function getActiveColor($params) {
        $styles = array();

        if(!empty($params['color_active'])) {
            $styles[] = 'background-color: '.$params['color_active'];
        }

        return $styles;
    }

    /**
     * Return active color for inactive bar
     *
     * @param $params
     *
     * @return array
     */
    private function getInactiveColor($params) {
        $styles = array();

        if(!empty($params['color_inactive'])) {
            $styles[] = 'background-color: '.$params['color_inactive'];
        }

        return $styles;
    }

    /**
     * Generates progress bar holder classes
     *
     * @param $params
     *
     * @return string
     */
    private function getHolderClasses($params){

        $class = 'qodef-progress-bar';

        if(isset($params['percent']) && $params['percent'] == 0) {
            $class .= ' qodef-pb-zero-value';
        }

        return $class;
    }
}