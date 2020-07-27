<?php

class ConeyQodefRawHTMLWidget extends ConeyQodefWidget {
	/**
	 * Set basic widget options and call parent class construct
	 */
	public function __construct() {
		parent::__construct(
			'qodef_raw_html_widget',
			esc_html__( 'Select Raw HTML Widget', 'select-core' ),
			array( 'description' => esc_html__( 'Add raw HTML holder to widget areas', 'select-core' ) )
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
				'name'  => 'extra_class',
				'title' => esc_html__( 'Extra Class Name', 'select-core' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'select-core' )
			),
			array(
				'type'  => 'textarea',
				'name'  => 'content',
				'title' => esc_html__( 'Content', 'select-core' )
			)
		);
	}

	/**
	 * Generates widget's HTML
	 *
	 * @param array $args args from widget area
	 * @param array $instance widget's options
	 */
	public function widget( $args, $instance ) {

		extract( $args );

		$extra_class = '';
		if ( ! empty( $instance['extra_class'] ) && $instance['extra_class'] !== '' ) {
			$extra_class = $instance['extra_class'];
		}
		?>

        <div class="widget qodef-raw-html-widget <?php echo esc_html( $extra_class ); ?>">
			<?php
			if ( ! empty( $instance['widget_title'] ) && $instance['widget_title'] !== '' ) {
				print wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			}
			if ( ! empty( $instance['content'] ) ) {
				print wp_kses_post( $instance['content'] );
			}
			?>
        </div>
		<?php
	}
}