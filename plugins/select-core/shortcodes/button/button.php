<?php
namespace ConeyQodef\Modules\Shortcodes\Button;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Button that represents button shortcode
 * @package ConeyQodef\Modules\Shortcodes\Button
 */
class Button implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     * Sets base attribute and registers shortcode with Visual Composer
     */
    public function __construct() {
        $this->base = 'qodef_button';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base attribute
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Select Button', 'select-core'),
            'base'                      => $this->base,
            'admin_enqueue_css' => array(coney_qodef_get_skin_uri().'/assets/css/qodef-vc-extend.css'),
            'category'                  => esc_html__('by SELECT', 'select-core'),
            'icon'                      => 'icon-wpb-button extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                array(
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'custom_class',
                        'heading'     => esc_html__('Custom CSS Class', 'select-core')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'type',
                        'heading'     => esc_html__('Type', 'select-core'),
                        'value'       => array(
						    esc_html__('Solid', 'select-core')   => 'solid',
						    esc_html__('Outline', 'select-core') => 'outline',
						    esc_html__('Simple', 'select-core')  => 'simple'
                        ),
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'size',
                        'heading'     => esc_html__('Size', 'select-core'),
                        'value'       => array(
						    esc_html__('Default', 'select-core') => '',
						    esc_html__('Small', 'select-core')   => 'small',
						    esc_html__('Medium', 'select-core')  => 'medium',
						    esc_html__('Large', 'select-core')   => 'large',
						    esc_html__('Huge', 'select-core')    => 'huge'
                        ),
                        'dependency'  => array('element' => 'type', 'value' => array('solid', 'outline'))
                    ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'text',
                        'heading'     => esc_html__('Text', 'select-core'),
                        'value'       => esc_html__('Button Text', 'select-core'),
                        'save_always' => true,
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'link',
                        'heading'     => esc_html__('Link', 'select-core')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'target',
                        'heading'     => esc_html__('Link Target', 'select-core'),
                        'value'       => array(
						    esc_html__('Same Window', 'select-core')  => '_self',
						    esc_html__('New Window', 'select-core') => '_blank'
                        )
                    )
                ),
                coney_qodef_icon_collections()->getVCParamsArray(array(), '', true),
                array(
                    array(
                        'type'        => 'colorpicker',
                        'param_name'  => 'color',
                        'heading'     => esc_html__('Color', 'select-core'),
                        'group'       => esc_html__('Design Options', 'select-core')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'param_name'  => 'hover_color',
                        'heading'     => esc_html__('Hover Color', 'select-core'),
                        'group'       => esc_html__('Design Options', 'select-core')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'param_name'  => 'background_color',
                        'heading'     => esc_html__('Background Color', 'select-core'),
                        'dependency'  => array('element' => 'type', 'value' => array('solid')),
                        'group'       => esc_html__('Design Options', 'select-core')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'param_name'  => 'hover_background_color',
                        'heading'     => esc_html__('Hover Background Color', 'select-core'),
                        'group'       => esc_html__('Design Options', 'select-core')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'param_name'  => 'border_color',
                        'heading'     => esc_html__('Border Color', 'select-core'),
                        'group'       => esc_html__('Design Options', 'select-core')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'param_name'  => 'hover_border_color',
                        'heading'     => esc_html__('Hover Border Color', 'select-core'),
                        'group'       => esc_html__('Design Options', 'select-core')
                    ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'font_size',
                        'heading'     => esc_html__('Font Size (px)', 'select-core'),
                        'group'       => esc_html__('Design Options', 'select-core')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'font_weight',
                        'heading'     => esc_html__('Font Weight', 'select-core'),
                        'value'       => array_flip(coney_qodef_get_font_weight_array(true)),
                        'save_always' => true,
                        'group'       => esc_html__('Design Options', 'select-core')
                    ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'margin',
                        'heading'     => esc_html__('Margin', 'select-core'),
                        'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'select-core'),
                        'group'       => esc_html__('Design Options', 'select-core')
                    )
                )
            )
        ));
    }

    /**
     * Renders HTML for button shortcode
     *
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'size'                   => '',
            'type'                   => 'solid',
            'text'                   => '',
            'link'                   => '',
            'target'                 => '',
            'color'                  => '',
            'hover_color'            => '',
            'background_color'       => '',
            'hover_background_color' => '',
            'border_color'           => '',
            'hover_border_color'     => '',
            'font_size'              => '',
            'font_weight'            => '',
            'margin'                 => '',
            'custom_class'           => '',
            'html_type'              => 'anchor',
            'input_name'             => '',
            'custom_attrs'           => array()
        );

        $default_atts = array_merge($default_atts, coney_qodef_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        if($params['html_type'] !== 'input') {
            $iconPackName   = coney_qodef_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
            $params['icon'] = $iconPackName ? $params[$iconPackName] : '';
        }

        $params['size'] = !empty($params['size']) ? $params['size'] : 'medium';
        $params['type'] = !empty($params['type']) ? $params['type'] : 'solid';


        $params['link']   = !empty($params['link']) ? $params['link'] : '#';
        $params['target'] = !empty($params['target']) ? $params['target'] : '_self';

        //prepare params for template
        $params['button_classes']      = $this->getButtonClasses($params);
        $params['button_custom_attrs'] = !empty($params['custom_attrs']) ? $params['custom_attrs'] : array();
        $params['button_styles']       = $this->getButtonStyles($params);
        $params['button_data']         = $this->getButtonDataAttr($params);

        return select_core_get_shortcode_template_part('templates/'.$params['html_type'], 'button', '', $params);
    }

    /**
     * Returns array of button styles
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonStyles($params) {
        $styles = array();

        if(!empty($params['color'])) {
            $styles[] = 'color: '.$params['color'];
        }

        if(!empty($params['background_color']) && $params['type'] !== 'outline') {
            $styles[] = 'background-color: '.$params['background_color'];
        }

        if(!empty($params['border_color'])) {
            $styles[] = 'border-color: '.$params['border_color'];
        }

        if(!empty($params['font_size'])) {
            $styles[] = 'font-size: '.coney_qodef_filter_px($params['font_size']).'px';
        }

        if(!empty($params['font_weight']) && $params['font_weight'] !== '') {
            $styles[] = 'font-weight: '.$params['font_weight'];
        }

        if(!empty($params['margin'])) {
            $styles[] = 'margin: '.$params['margin'];
        }

        return $styles;
    }

    /**
     *
     * Returns array of button data attr
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonDataAttr($params) {
        $data = array();

        if(!empty($params['hover_color'])) {
            $data['data-hover-color'] = $params['hover_color'];
        }

        if(!empty($params['hover_background_color'])) {
            $data['data-hover-bg-color'] = $params['hover_background_color'];
        }

        if(!empty($params['hover_border_color'])) {
            $data['data-hover-border-color'] = $params['hover_border_color'];
        }

        return $data;
    }

    /**
     * Returns array of HTML classes for button
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonClasses($params) {
        $buttonClasses = array(
            'qodef-btn',
            'qodef-btn-'.$params['size'],
            'qodef-btn-'.$params['type']
        );

        if(!empty($params['hover_background_color'])) {
            $buttonClasses[] = 'qodef-btn-custom-hover-bg';
        }

        if(!empty($params['hover_border_color'])) {
            $buttonClasses[] = 'qodef-btn-custom-border-hover';
        }

        if(!empty($params['hover_color'])) {
            $buttonClasses[] = 'qodef-btn-custom-hover-color';
        }

        if(!empty($params['icon'])) {
            $buttonClasses[] = 'qodef-btn-icon';
        }

        if(!empty($params['custom_class'])) {
            $buttonClasses[] = esc_attr($params['custom_class']);
        }

        return $buttonClasses;
    }
}