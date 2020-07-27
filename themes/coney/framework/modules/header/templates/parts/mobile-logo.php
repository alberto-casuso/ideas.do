<?php
$attachment_meta = coney_qodef_get_attachment_meta_from_url( $logo_image );
$hwstring        = ! empty( $attachment_meta ) ? image_hwstring( $attachment_meta['width'], $attachment_meta['height'] ) : '';
?>

<?php do_action( 'coney_qodef_before_mobile_logo' ); ?>

    <div class="qodef-mobile-logo-wrapper">
        <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php coney_qodef_inline_style( $logo_styles ); ?>>
            <img itemprop="image" src="<?php echo esc_url( $logo_image ); ?>" <?php print wp_kses( $hwstring, array(
				'width'  => true,
				'height' => true
			) ); ?> alt="<?php esc_attr_e( 'mobile logo', 'coney' ); ?>"/>
        </a>
    </div>

<?php do_action( 'coney_qodef_after_mobile_logo' ); ?>