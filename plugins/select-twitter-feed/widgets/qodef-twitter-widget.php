<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class QodefTwitterWidget extends WP_Widget {
	private $params;

	public function __construct() {
		parent::__construct(
			'qodef_twitter_widget',
			'Select Twitter Widget',
			array(
				'description' => 'Display your Twitter feed'
			)
		);

		$this->setParams();
	}

	private function setParams() {
		$this->params = array(
			array(
				'name'  => 'title',
				'type'  => 'textfield',
				'title' => 'Title'
			),
			array(
				'name'    => 'type_of_widget',
				'type'    => 'dropdown',
				'title'   => 'Widget Type',
				'options' => array(
					'standard' => 'Standard',
					'slider'   => 'Slider'
				)
			),
			array(
				'name'  => 'user_id',
				'type'  => 'textfield',
				'title' => 'User ID'
			),
			array(
				'name'  => 'count',
				'type'  => 'textfield',
				'title' => 'Number of tweets'
			),
			array(
				'name'    => 'show_tweet_icon',
				'type'    => 'dropdown',
				'title'   => 'Show tweet icon',
				'options' => array(
					'yes' => 'Yes',
					'no'  => 'No'
				)
			),
			array(
				'name'    => 'show_tweet_time',
				'type'    => 'dropdown',
				'title'   => 'Show tweet time',
				'options' => array(
					'no'  => 'No',
					'yes' => 'Yes'
				)
			),
			array(
				'name'  => 'transient_time',
				'type'  => 'textfield',
				'title' => 'Tweets Cache Time'
			)
		);
	}

	public function form( $instance ) {
		foreach ( $this->params as $param_array ) {
			$param_name    = $param_array['name'];
			${$param_name} = isset( $instance[ $param_name ] ) ? esc_attr( $instance[ $param_name ] ) : '';
		}

		foreach ( $this->params as $param ) {
			switch ( $param['type'] ) {
				case 'textfield':
					?>
                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo
							esc_html( $param['title'] ); ?></label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>" type="text" value="<?php echo esc_attr( ${$param['name']} ); ?>"/>
                    </p>
					<?php
					break;
				case 'dropdown':
					?>
                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo
							esc_html( $param['title'] ); ?></label>
						<?php if ( isset( $param['options'] ) && is_array( $param['options'] ) && count( $param['options'] ) ) { ?>
                            <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>">
								<?php foreach ( $param['options'] as $param_option_key => $param_option_val ) {
									$option_selected = '';
									if ( ${$param['name']} == $param_option_key ) {
										$option_selected = 'selected';
									}
									?>
                                    <option <?php echo esc_attr( $option_selected ); ?> value="<?php echo esc_attr( $param_option_key ); ?>"><?php echo esc_attr( $param_option_val ); ?></option>
								<?php } ?>
                            </select>
						<?php } ?>
                    </p>

					<?php
					break;
			}
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		foreach ( $this->params as $param ) {
			$param_name = $param['name'];

			$instance[ $param_name ] = sanitize_text_field( $new_instance[ $param_name ] );
		}

		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $instance );

		print wp_kses_post( $args['before_widget'] );

		if ( ! empty( $title ) ) {
			print wp_kses_post( $args['before_title'] ) . esc_html( $title ) . wp_kses_post( $args['after_title'] );
		}

		$user_id        = ! empty( $user_id ) ? $user_id : '';
		$count          = ! empty( $count ) ? $count : '';
		$items          = ! empty( $count ) ? $count : '-1';
		$transient_time = ! empty( $transient_time ) ? $transient_time : 0;

		$twitter_style = ( $show_tweet_icon != 'yes' ) ? 'padding: 0;' : '';

		$available_type_values = array( 'standard', 'slider' );
		if ( ! in_array( $type_of_widget, $available_type_values ) ) {
			$type_of_widget = 'standard';
		}

		$widget_data = '';

		if ( $type_of_widget == 'slider' ) {

			$widget_data = ' data-items=' . $items;

		}

		$twitter_api = QodefTwitterApi::getInstance();

		if ( $twitter_api->hasUserConnected() ) {
			$response = $twitter_api->fetchTweets( $user_id, $count, array(
				'transient_time' => $transient_time,
				'transient_id'   => 'qodef_twitter_' . $args['widget_id']
			) );

			if ( $response->status ) {
				if ( is_array( $response->data ) && count( $response->data ) ) { ?>
                    <ul class="qodef-twitter-widget qodef-twitter-<?php echo esc_attr( $type_of_widget ); ?>" <?php echo esc_attr( $widget_data ); ?>>
						<?php foreach ( $response->data as $tweet ) { ?>

							<?php if ( $type_of_widget == 'slider' ) { ?>

                                <li class="qodef-tweet-holder">
									<?php if ( $show_tweet_icon == 'yes' ) { ?>
                                        <div class="qodef-twitter-icon"><i class="fa fa-twitter"></i></div><?php } ?>
                                    <div class="qodef-tweet-text" <?php coney_qodef_inline_style( $twitter_style ); ?>>
										<?php echo wp_kses_post( $twitter_api->getHelper()->getTweetText( $tweet ) ); ?>
                                        <a class="qodef-tweet-author" target="_blank" href="<?php echo esc_url( $twitter_api->getHelper()->getTweetURL( $tweet ) ); ?>">
                                            &commat; <?php echo wp_kses_post( $twitter_api->getHelper()->getTweetAuthor( $tweet ) ); ?>
                                        </a>
										<?php if ( $show_tweet_time == 'yes' ) { ?>
                                            <a class="qodef-tweet-time" target="_blank" href="<?php echo esc_url( $twitter_api->getHelper()->getTweetURL( $tweet ) ); ?>">
												<?php echo wp_kses_post( $twitter_api->getHelper()->getTweetTime( $tweet ) ); ?>
                                            </a>
										<?php } ?>
                                    </div>
                                </li>

							<?php } else { ?>

                                <li class="qodef-tweet-holder">
									<?php if ( $show_tweet_icon == 'yes' ) { ?>
                                        <div class="qodef-twitter-icon"><i class="fa fa-twitter"></i></div><?php } ?>
                                    <div class="qodef-tweet-text" <?php coney_qodef_inline_style( $twitter_style ); ?>>
										<?php echo wp_kses_post( $twitter_api->getHelper()->getTweetText( $tweet ) ); ?>
										<?php if ( $show_tweet_time == 'yes' ) { ?>
                                            <a class="qodef-tweet-time" target="_blank" href="<?php echo esc_url( $twitter_api->getHelper()->getTweetURL( $tweet ) ); ?>">
												<?php echo wp_kses_post( $twitter_api->getHelper()->getTweetTime( $tweet ) ); ?>
                                            </a>
										<?php } ?>
                                    </div>
                                </li>

							<?php } ?>

						<?php } ?>
                    </ul>
				<?php }
			} else {
				echo esc_html( $response->message );
			}
		} else {
			esc_html_e( 'It seams that you haven\'t connected with your Twitter account', 'qode' );
		}

		print wp_kses_post( $args['after_widget'] );
	}
}

function qodef_twitter_widget_load() {
	register_widget( 'QodefTwitterWidget' );
}

add_action( 'widgets_init', 'qodef_twitter_widget_load' );