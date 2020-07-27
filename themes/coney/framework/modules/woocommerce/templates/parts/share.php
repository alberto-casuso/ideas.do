<?php
$show_label   = isset( $params['show_label'] ) && $params['show_label'] == 'yes' ? true : false;
$share_type   = isset( $params['share_type'] ) ? $params['share_type'] : 'list';
$share_font   = isset( $params['share_font'] ) ? $params['share_font'] : 'font-elegant';
$share_circle = isset( $params['share_circle'] ) ? $params['share_circle'] : 'no';

if ( coney_qodef_core_plugin_installed() &&
     coney_qodef_options()->getOptionValue( 'enable_social_share' ) === 'yes' &&
     coney_qodef_options()->getOptionValue( 'enable_social_share_on_product' ) === 'yes' ) : ?>
    <div class="qodef-woo-social-share-holder">
		<?php if ( $show_label ) : ?>
            <span><?php esc_html_e( 'Share:', 'coney' ); ?></span>
		<?php endif; ?>
		<?php echo coney_qodef_get_social_share_html( array(
			'type'        => $share_type,
			'icon_type'   => $share_font,
			'icon_circle' => $share_circle
		) ); ?>
    </div>
<?php endif; ?>