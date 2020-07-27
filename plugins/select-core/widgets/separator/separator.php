<?php

class ConeyQodefSeparatorWidget extends ConeyQodefWidget {
    public function __construct() {
        parent::__construct(
            'qodef_separator_widget',
	        esc_html__('Select Separator Widget', 'select-core'),
	        array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'select-core'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type' => 'dropdown',
                'name' => 'type',
                'title' => esc_html__('Type', 'select-core'),
                'options' => array(
                    'normal' => esc_html__('Normal', 'select-core'),
                    'full-width' => esc_html__('Full Width', 'select-core')
                )
            ),
            array(
                'type' => 'dropdown',
                'name' => 'position',
                'title' => esc_html__('Position', 'select-core'),
                'options' => array(
                    'center' => esc_html__('Center', 'select-core'),
                    'left' => esc_html__('Left', 'select-core'),
                    'right' => esc_html__('Right', 'select-core')
                )
            ),
            array(
                'type' => 'dropdown',
                'name' => 'border_style',
                'title' => esc_html__('Style', 'select-core'),
                'options' => array(
                    'solid' => esc_html__('Solid', 'select-core'),
                    'dashed' => esc_html__('Dashed', 'select-core'),
                    'dotted' => esc_html__('Dotted', 'select-core')
                )
            ),
            array(
                'type' => 'textfield',
                'name' => 'color',
                'title' => esc_html__('Color', 'select-core')
            ),
            array(
                'type' => 'textfield',
                'name' => 'width',
                'title' => esc_html__('Width', 'select-core')
            ),
            array(
                'type' => 'textfield',
                'name' => 'thickness',
                'title' => esc_html__('Thickness (px)', 'select-core')
            ),
            array(
                'type' => 'textfield',
                'name' => 'top_margin',
                'title' => esc_html__('Top Margin', 'select-core')
            ),
            array(
                'type' => 'textfield',
                'name' => 'bottom_margin',
                'title' => esc_html__('Bottom Margin', 'select-core')
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
        extract($args);

        //prepare variables
        $params = '';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params .= " $key='$value' ";
            }
        }

        echo '<div class="widget qodef-separator-widget">';
            echo do_shortcode("[qodef_separator $params]"); // XSS OK
        echo '</div>';
    }
}