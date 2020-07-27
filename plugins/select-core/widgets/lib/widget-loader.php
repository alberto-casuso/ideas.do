<?php

if ( ! function_exists( 'coney_qodef_register_widgets' ) ) {
	function coney_qodef_register_widgets() {
		$widgets = array(
			'ConeyQodefBlogListWidget',
			'ConeyQodefButtonWidget',
			'ConeyQodefImageWidget',
			'ConeyQodefPopupOpener',
			'ConeyQodefRawHTMLWidget',
			'ConeyQodefSearchOpener',
			'ConeyQodefSeparatorWidget',
			'ConeyQodefSideAreaOpener',
			'ConeyQodefSocialIconWidget'
		);

		if ( coney_qodef_is_woocommerce_installed() ) {
			$widgets[] = 'ConeyQodefWoocommerceDropdownCart';
		}

		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
}

add_action( 'widgets_init', 'coney_qodef_register_widgets' );