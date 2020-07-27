<?php

class ConeyQodefWoocommerceDropdownCart extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'qodef_woocommerce_dropdown_cart',
			esc_html__( 'Select Woocommerce Dropdown Cart', 'select-core' ),
			array( 'description' => esc_html__( 'Display a shop cart icon with a dropdown that shows products that are in the cart', 'select-core' ), )
		);

		$this->setParams();
	}

	protected function setParams() {

		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'woocommerce_dropdown_cart_margin',
				'title'       => esc_html__( 'Icon Margin', 'select-core' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'select-core' )
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'woocommerce_enable_cart_info',
				'title'       => esc_html__( 'Enable Cart Info', 'select-core' ),
				'options'     => coney_qodef_get_yes_no_select_array( false ),
				'description' => esc_html__( 'Enabling this option will show cart info (products number and price) at the right side of dropdown cart icon', 'select-core' )
			),
		);
	}

	/**
	 * Generate widget form based on $params attribute
	 *
	 * @param array $instance
	 *
	 * @return null
	 */
	public function form( $instance ) {
		if ( is_array( $this->params ) && count( $this->params ) ) {
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
								esc_html( $param['title'] ); ?>:</label>
                            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>" type="text" value="<?php echo esc_attr( ${$param['name']} ); ?>"/>
							<?php if ( ! empty( $param['description'] ) ) : ?>
                                <span class="qodef-field-description"><?php echo esc_html( $param['description'] ); ?></span>
							<?php endif; ?>
                        </p>
						<?php
						break;
					case 'dropdown':
						?>
                        <p>
                            <label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo
								esc_html( $param['title'] ); ?>:</label>
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
							<?php if ( ! empty( $param['description'] ) ) : ?>
                                <span class="qodef-field-description"><?php echo esc_html( $param['description'] ); ?></span>
							<?php endif; ?>
                        </p>

						<?php
						break;
				}
			}
		} else { ?>
            <p><?php esc_html_e( 'There are no options for this widget.', 'select-core' ); ?></p>
		<?php }
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		foreach ( $this->params as $param ) {
			$param_name = $param['name'];

			$instance[ $param_name ] = sanitize_text_field( $new_instance[ $param_name ] );
		}

		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );

		global $woocommerce;

		$icon_styles = array();

		if ( $instance['woocommerce_dropdown_cart_margin'] !== '' ) {
			$icon_styles[] = 'padding: ' . $instance['woocommerce_dropdown_cart_margin'];
		}

		$icon_class = 'qodef-cart-info-is-disabled';

		if ( ! empty( $instance['woocommerce_enable_cart_info'] ) && $instance['woocommerce_enable_cart_info'] === 'yes' ) {
			$icon_class = 'qodef-cart-info-is-active';
		}

		$cart_description = coney_qodef_options()->getOptionValue( 'qodef_woo_dropdown_cart_description' );
		?>
        <div class="qodef-shopping-cart-holder <?php echo esc_html( $icon_class ); ?>" <?php coney_qodef_inline_style( $icon_styles ) ?>>
            <div class="qodef-shopping-cart-inner">
				<?php $cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0; ?>
                <a itemprop="url" class="qodef-header-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                    <span class="qodef-cart-icon icon_cart_alt"></span>
                    <span class="qodef-cart-info">
						<span class="qodef-cart-info-number"><?php echo sprintf( _n( '%d item', '%d items', WC()->cart->cart_contents_count, 'select-core' ), WC()->cart->cart_contents_count ); ?></span>
						<span class="qodef-cart-info-total"><?php echo wp_kses( $woocommerce->cart->get_cart_subtotal(), array(
								'span' => array(
									'class' => true,
									'id'    => true
								)
							) ); ?></span>
					</span>
                </a>
				<?php if ( ! $cart_is_empty ) : ?>
                    <div class="qodef-shopping-cart-dropdown">
                        <ul>
							<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :
								$_product = $cart_item['data'];
								// Only display if allowed
								if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
									continue;
								}
								// Get price
								$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax( $_product ) : wc_get_price_including_tax( $_product );
								?>
                                <li>
                                    <div class="qodef-item-image-holder">
                                        <a itemprop="url" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
											<?php echo wp_kses( $_product->get_image(), array(
												'img' => array(
													'src'    => true,
													'width'  => true,
													'height' => true,
													'class'  => true,
													'alt'    => true,
													'title'  => true,
													'id'     => true
												)
											) ); ?>
                                        </a>
                                    </div>
                                    <div class="qodef-item-info-holder">
                                        <h5 itemprop="name" class="qodef-product-title">
                                            <a itemprop="url" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>"><?php echo apply_filters( 'coney_qodef_woo_widget_cart_product_title', $_product->get_title(), $_product ); ?></a>
                                        </h5>
                                        <span class="qodef-quantity"><?php esc_html_e( 'Quantity: ', 'select-core' );
											echo esc_html( $cart_item['quantity'] ); ?></span>
										<?php echo apply_filters( 'coney_qodef_woo_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
										<?php echo apply_filters( 'coney_qodef_woo_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><span class="icon-arrows-remove"></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_attr__( 'Remove this item', 'select-core' ) ), $cart_item_key ); ?>
                                    </div>
                                </li>
							<?php endforeach; ?>
                            <div class="qodef-cart-bottom">
                                <div class="qodef-subtotal-holder clearfix">
                                    <span class="qodef-total"><?php esc_html_e( 'Order Total:', 'select-core' ); ?></span>
                                    <span class="qodef-total-amount">
										<?php echo wp_kses( $woocommerce->cart->get_cart_subtotal(), array(
											'span' => array(
												'class' => true,
												'id'    => true
											)
										) ); ?>
									</span>
                                </div>
								<?php if ( ! empty( $cart_description ) ) { ?>
                                    <div class="qodef-cart-description">
                                        <div class="qodef-cart-description-inner">
                                            <span><?php echo esc_html( $cart_description ); ?></span>
                                        </div>
                                    </div>
								<?php } ?>
                                <div class="qodef-btn-holder clearfix">
                                    <a itemprop="url" href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="qodef-view-cart" data-title="<?php esc_attr_e( 'VIEW BAG & CHECKOUT', 'select-core' ); ?>"><span><?php esc_html_e( 'VIEW BAG & CHECKOUT', 'select-core' ); ?></span></a>
                                </div>
                            </div>
                        </ul>
                    </div>
				<?php else : ?>
                    <div class="qodef-shopping-cart-dropdown">
                        <ul>
                            <li class="qodef-empty-cart"><?php esc_html_e( 'No products in the cart.', 'select-core' ); ?></li>
                        </ul>
                    </div>
				<?php endif; ?>
            </div>
        </div>
		<?php
	}
}

add_action( 'widgets_init', function () {
	register_widget( "ConeyQodefWoocommerceDropdownCart" );
} );


add_filter( 'woocommerce_add_to_cart_fragments', 'coney_qodef_woocommerce_header_add_to_cart_fragment' );

function coney_qodef_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	$cart_description = coney_qodef_options()->getOptionValue( 'qodef_woo_dropdown_cart_description' );

	ob_start();

	?>

    <div class="qodef-shopping-cart-inner">
		<?php $cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0; ?>
        <a itemprop="url" class="qodef-header-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
            <span class="qodef-cart-icon icon_cart_alt"></span>
            <span class="qodef-cart-info">
				<span class="qodef-cart-info-number"><?php echo sprintf( _n( '%d item', '%d items', WC()->cart->cart_contents_count, 'select-core' ), WC()->cart->cart_contents_count ); ?></span>
				<span class="qodef-cart-info-total"><?php echo wp_kses( $woocommerce->cart->get_cart_subtotal(), array(
						'span' => array(
							'class' => true,
							'id'    => true
						)
					) ); ?></span>
			</span>
        </a>
		<?php if ( ! $cart_is_empty ) : ?>
            <div class="qodef-shopping-cart-dropdown">
                <ul>
					<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :
						$_product = $cart_item['data'];
						// Only display if allowed
						if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
							continue;
						}
						// Get price
						$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax( $_product ) : wc_get_price_including_tax( $_product );
						?>
                        <li>
                            <div class="qodef-item-image-holder">
                                <a itemprop="url" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
									<?php echo wp_kses( $_product->get_image(), array(
										'img' => array(
											'src'    => true,
											'width'  => true,
											'height' => true,
											'class'  => true,
											'alt'    => true,
											'title'  => true,
											'id'     => true
										)
									) ); ?>
                                </a>
                            </div>
                            <div class="qodef-item-info-holder">
                                <h5 itemprop="name" class="qodef-product-title">
                                    <a itemprop="url" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>"><?php echo apply_filters( 'coney_qodef_woo_widget_cart_product_title', $_product->get_title(), $_product ); ?></a>
                                </h5>
                                <span class="qodef-quantity"><?php esc_html_e( 'Quantity: ', 'select-core' );
									echo esc_html( $cart_item['quantity'] ); ?></span>
								<?php echo apply_filters( 'coney_qodef_woo_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
								<?php echo apply_filters( 'coney_qodef_woo_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><span class="icon-arrows-remove"></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_attr__( 'Remove this item', 'select-core' ) ), $cart_item_key ); ?>
                            </div>
                        </li>
					<?php endforeach; ?>
                    <div class="qodef-cart-bottom">
                        <div class="qodef-subtotal-holder clearfix">
                            <span class="qodef-total"><?php esc_html_e( 'Order Total:', 'select-core' ); ?></span>
                            <span class="qodef-total-amount">
								<?php echo wp_kses( $woocommerce->cart->get_cart_subtotal(), array(
									'span' => array(
										'class' => true,
										'id'    => true
									)
								) ); ?>
							</span>
                        </div>
						<?php if ( ! empty( $cart_description ) ) { ?>
                            <div class="qodef-cart-description">
                                <div class="qodef-cart-description-inner">
                                    <span><?php echo esc_html( $cart_description ); ?></span>
                                </div>
                            </div>
						<?php } ?>
                        <div class="qodef-btn-holder clearfix">
                            <a itemprop="url" href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="qodef-view-cart" data-title="<?php esc_attr_e( 'VIEW BAG & CHECKOUT', 'select-core' ); ?>"><span><?php esc_html_e( 'VIEW BAG & CHECKOUT', 'select-core' ); ?></span></a>
                        </div>
                    </div>
                </ul>
            </div>
		<?php else : ?>
            <div class="qodef-shopping-cart-dropdown">
                <ul>
                    <li class="qodef-empty-cart"><?php esc_html_e( 'No products in the cart.', 'select-core' ); ?></li>
                </ul>
            </div>
		<?php endif; ?>
    </div>

	<?php
	$fragments['div.qodef-shopping-cart-inner'] = ob_get_clean();

	return $fragments;
}

?>