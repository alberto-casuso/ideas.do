<?php

class ConeyQodefImageWidget extends ConeyQodefWidget {
	public function __construct() {
		parent::__construct(
			'qodef_image_widget',
			esc_html__( 'Select Image Widget', 'select-core' ),
			array( 'description' => esc_html__( 'Add image element to widget areas', 'select-core' ) )
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
				'title' => esc_html__( 'Custom CSS Class', 'select-core' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'select-core' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'image_src',
				'title' => esc_html__( 'Image Source', 'select-core' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'image_alt',
				'title' => esc_html__( 'Image Alt', 'select-core' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'image_width',
				'title' => esc_html__( 'Image Width', 'select-core' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'image_height',
				'title' => esc_html__( 'Image Height', 'select-core' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__( 'Link', 'select-core' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__( 'Target', 'select-core' ),
				'options' => array(
					'_self'  => esc_html__( 'Same Window', 'select-core' ),
					'_blank' => esc_html__( 'New Window', 'select-core' )
				)
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

		$image_src    = '';
		$image_alt    = esc_html__( 'Widget Image', 'select-core' );
		$image_width  = '';
		$image_height = '';

		if ( ! empty( $instance['image_alt'] ) ) {
			$image_alt = $instance['image_alt'];
		}

		if ( ! empty( $instance['image_width'] ) ) {
			$image_width = intval( $instance['image_width'] );
		}

		if ( ! empty( $instance['image_height'] ) ) {
			$image_height = intval( $instance['image_height'] );
		}

		if ( ! empty( $instance['image_src'] ) ) {
			$image_src = '<img itemprop="image" src="' . esc_url( $instance['image_src'] ) . '" alt="' . $image_alt . '" ';
			if ( $image_width != '' ) {
				$image_src .= 'width="' . $image_width . '" ';
			}
			if ( $image_height != '' ) {
				$image_src .= 'height="' . $image_height . '" ';
			}
			$image_src .= ' />';
		}

		$link_begin_html = '';
		$link_end_html   = '';
		$target          = '_self';

		if ( ! empty( $instance['target'] ) ) {
			$target = $instance['target'];
		}

		if ( ! empty( $instance['link'] ) ) {
			$link_begin_html = '<a itemprop="url" href="' . esc_url( $instance['link'] ) . '" target="' . esc_attr( $target ) . '">';
			$link_end_html   = '</a>';
		}
		?>

        <div class="widget qodef-image-widget <?php echo esc_html( $extra_class ); ?>">
			<?php
			if ( ! empty( $instance['widget_title'] ) && $instance['widget_title'] !== '' ) {
				print wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			}
			if ( $link_begin_html !== '' ) {
				print wp_kses_post( $link_begin_html );
			}
			if ( $image_src !== '' ) {
				print esc_url( $image_src );
			}
			if ( $link_end_html !== '' ) {
				print wp_kses_post( $link_end_html );
			}
			?>
        </div>
		<?php
	}
}