<?php

class ConeyQodefBlogListWidget extends ConeyQodefWidget {
	public function __construct() {
		parent::__construct(
			'qodef_blog_list_widget',
			esc_html__( 'Select Blog List Widget', 'select-core' ),
			array( 'description' => esc_html__( 'Display a list of your blog posts', 'select-core' ) )
		);

		$this->setParams();
	}

	/**
	 * Sets widget options
	 */
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'select-core' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'select-core' ),
				'options' => array(
					'simple'  => esc_html__( 'Simple', 'select-core' ),
					'minimal' => esc_html__( 'Minimal', 'select-core' )
				)
			),
			array(
				'type'  => 'textfield',
				'name'  => 'number_of_posts',
				'title' => esc_html__( 'Number of Posts', 'select-core' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'space_between_columns',
				'title'   => esc_html__( 'Space Between items', 'select-core' ),
				'options' => array(
					'normal' => esc_html__( 'Normal', 'select-core' ),
					'small'  => esc_html__( 'Small', 'select-core' ),
					'tiny'   => esc_html__( 'Tiny', 'select-core' ),
					'no'     => esc_html__( 'No Space', 'select-core' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'order_by',
				'title'   => esc_html__( 'Order By', 'select-core' ),
				'options' => array(
					'title' => esc_html__( 'Title', 'select-core' ),
					'date'  => esc_html__( 'Date', 'select-core' ),
					'rand'  => esc_html__( 'Random', 'select-core' ),
					'name'  => esc_html__( 'Post Name', 'select-core' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'order',
				'title'   => esc_html__( 'Order', 'select-core' ),
				'options' => array(
					'ASC'  => esc_html__( 'ASC', 'select-core' ),
					'DESC' => esc_html__( 'DESC', 'select-core' )
				)
			),
			array(
				'type'        => 'textfield',
				'name'        => 'category',
				'title'       => esc_html__( 'Category Slug', 'select-core' ),
				'description' => esc_html__( 'Leave empty for all or use comma for list', 'select-core' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_tag',
				'title'   => esc_html__( 'Title Tag', 'select-core' ),
				'options' => coney_qodef_get_title_tag( true )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_transform',
				'title'   => esc_html__( 'Title Text Transform', 'select-core' ),
				'options' => coney_qodef_get_text_transform_array( true )
			),
		);
	}

	/**
	 * Generates widget's HTML
	 *
	 * @param array $args args from widget area
	 * @param array $instance widget's options
	 */
	public function widget( $args, $instance ) {
		$params = '';

		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$instance['post_info_section'] = 'yes';
		$instance['number_of_columns'] = '1';

		// Filter out all empty params
		$instance = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );

		//generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}

		$available_types = array( 'simple', 'classic' );

		if ( ! in_array( $instance['type'], $available_types ) ) {
			$instance['type'] = 'simple';
		}

		echo '<div class="widget qodef-blog-list-widget">';
		if ( ! empty( $instance['widget_title'] ) ) {
			print wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
		}

		echo do_shortcode( "[qodef_blog_list $params]" ); // XSS OK
		echo '</div>';
	}
}