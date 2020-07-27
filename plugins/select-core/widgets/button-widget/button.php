<?php

class ConeyQodefButtonWidget extends ConeyQodefWidget {
	public function __construct() {
		parent::__construct(
			'qodef_button_widget',
			esc_html__('Select Button Widget', 'select-core'),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'select-core'))
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
					'solid' => esc_html__('Solid', 'select-core'),
					'outline' => esc_html__('Outline', 'select-core'),
					'simple' => esc_html__('Simple', 'select-core')
				)
			),
			array(
				'type' => 'dropdown',
				'name' => 'size',
				'title' => esc_html__('Size', 'select-core'),
				'options' => array(
					'small' => esc_html__('Small', 'select-core'),
					'medium' => esc_html__('Medium', 'select-core'),
					'large' => esc_html__('Large', 'select-core'),
					'huge' => esc_html__('Huge', 'select-core')
				),
				'description' => esc_html__('This option is only available for solid and outline button type', 'select-core')
			),
			array(
				'type' => 'textfield',
				'name' => 'text',
				'title' => esc_html__('Text', 'select-core'),
				'default' => esc_html__('Button Text', 'select-core')
			),
			array(
				'type' => 'textfield',
				'name'  => 'link',
				'title' => esc_html__('Link', 'select-core')
			),
			array(
				'type' => 'dropdown',
				'name' => 'target',
				'title' => esc_html__('Link Target', 'select-core'),
				'options' => array(
					'_self' => esc_html__('Same Window', 'select-core'),
					'_blank' => esc_html__('New Window', 'select-core')
				)
			),
			array(
				'type' => 'textfield',
				'name' => 'color',
				'title' => esc_html__('Color', 'select-core')
			),
			array(
				'type' => 'textfield',
				'name' => 'hover_color',
				'title' => esc_html__('Hover Color', 'select-core')
			),
			array(
				'type' => 'textfield',
				'name' => 'background_color',
				'title' => esc_html__('Background Color', 'select-core'),
				'description' => esc_html__('This option is only available for solid button type', 'select-core')
			),
			array(
				'type' => 'textfield',
				'name' => 'hover_background_color',
				'title' => esc_html__('Hover Background Color', 'select-core'),
				'description' => esc_html__('This option is only available for solid button type', 'select-core')
			),
			array(
				'type' => 'textfield',
				'name' => 'border_color',
				'title' => esc_html__('Border Color', 'select-core'),
				'description' => esc_html__('This option is only available for solid and outline button type', 'select-core')
			),
			array(
				'type' => 'textfield',
				'name' => 'hover_border_color',
				'title' => esc_html__('Hover Border Color', 'select-core'),
				'description' => esc_html__('This option is only available for solid and outline button type', 'select-core')
			),
			array(
				'type' => 'textfield',
				'name' => 'margin',
				'title' => esc_html__('Margin', 'select-core'),
				'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'select-core')
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
		$params = '';

		if (!is_array($instance)) { $instance = array(); }

		// Filter out all empty params
		$instance = array_filter($instance, function($array_value) { return trim($array_value) != ''; });

		// Default values
		if (!isset($instance['text'])) { $instance['text'] = 'Button Text'; }

		// Generate shortcode params
		foreach($instance as $key => $value) {
			$params .= " $key='$value' ";
		}

		echo '<div class="widget qodef-button-widget">';
			echo do_shortcode("[qodef_button $params]"); // XSS OK
		echo '</div>';
	}
}