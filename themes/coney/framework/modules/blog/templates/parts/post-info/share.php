<?php
$share_type   = isset( $share_type ) ? $share_type : 'list';
$share_text   = isset( $share_text ) ? $share_text : 'no';
$share_font   = isset( $share_font ) ? $share_font : 'font-elegant';
$share_circle = isset( $share_circle ) ? $share_circle : 'no';
$share_square = isset( $share_square ) ? $share_square : 'no';

if ( coney_qodef_core_plugin_installed() &&
     coney_qodef_options()->getOptionValue( 'enable_social_share' ) === 'yes' &&
     coney_qodef_options()->getOptionValue( 'enable_social_share_on_post' ) === 'yes' ) : ?>
    <div class="qodef-blog-share redes">
		<?php /* if ( $share_text == 'yes' ) : */ ?>
            <span class="qodef-share-text"><?php echo esc_html__( 'Compartir:', 'coney' ); ?></span>
		<?php /* endif; */ ?>
		<?php echo coney_qodef_get_social_share_html( array(
			'type'        => $share_type,
			'icon_type'   => $share_font,
			'icon_circle' => $share_circle,
			'icon_square' => $share_square
		) ); ?>
    </div>
<?php endif; ?>