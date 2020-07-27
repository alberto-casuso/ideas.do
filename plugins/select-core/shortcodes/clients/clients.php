<?php
namespace ConeyQodef\Modules\Shortcodes\Clients;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Clients
 */
class Clients implements ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'qodef_clients';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => esc_html__('Select Clients', 'select-core'),
            'select-core',
            'base'                    => $this->base,
            'as_parent'               => array('only' => 'qodef_client'),
            'content_element'         => true,
            'category'                => esc_html__('by SELECT', 'select-core'),
            'icon'                    => 'icon-wpb-clients extended-custom-icon',
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Columns', 'select-core'),
                    'param_name'  => 'columns',
                    'value'       => array(
                        esc_html__('Two', 'select-core')   => '2',
                        esc_html__('Three', 'select-core') => '3',
                        esc_html__('Four', 'select-core')  => '4',
                        esc_html__('Five', 'select-core')  => '5',
                        esc_html__('Six', 'select-core')   => '6'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
            ),
            'js_view'                 => 'VcColumnView'

        ));
    }

    public function render($atts, $content = null) {

        $args   = array(
            'columns' => '',

        );
        $params = shortcode_atts($args, $atts);

        $params['holder_classes']  = $this->getHolderClasses($params);
        extract($params);
        $params['content'] = $content;
        $html              = '';

        $html = select_core_get_shortcode_template_part('templates/clients-template', 'clients', '', $params);

        return $html;

    }

    private function getHolderClasses($params) {
        $classes   = array('qodef-clients clearfix');
        $classes[] = '';
        $columns = $params['columns'];


            switch ($columns) {
                case 2:
                    $classes[] = 'qodef-clients-two-columns';
                    break;
                case 3:
                    $classes[] = 'qodef-clients-three-columns';
                    break;
                case 4:
                    $classes[] = 'qodef-clients-four-columns';
                    break;
                case 5:
                    $classes[] = 'qodef-clients-five-columns';
                    break;
                case 6:
                    $classes[] = 'qodef-clients-six-columnss';
                    break;
                default:
                    $classes[] = 'qodef-clients-two-columns';
                    break;
            }



        return $classes;
    }

}
