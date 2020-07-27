<?php
$attachment_meta = coney_qodef_get_attachment_meta_from_url( $logo_image );
$hwstring        = ! empty( $attachment_meta ) ? image_hwstring( $attachment_meta['width'], $attachment_meta['height'] ) : '';

if ( ! empty( $logo_image_dark ) ) {
	$attachment_meta_dark = coney_qodef_get_attachment_meta_from_url( $logo_image_dark );
	$hwstring_dark        = ! empty( $attachment_meta_dark ) ? image_hwstring( $attachment_meta_dark['width'], $attachment_meta_dark['height'] ) : '';
}

if ( ! empty( $logo_image_light ) ) {
	$attachment_meta_light = coney_qodef_get_attachment_meta_from_url( $logo_image_light );
	$hwstring_light        = ! empty( $attachment_meta_light ) ? image_hwstring( $attachment_meta_light['width'], $attachment_meta_light['height'] ) : '';
}
?>

<?php do_action( 'coney_qodef_before_site_logo' ); ?>

    <div class="qodef-logo-wrapper">
        <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php coney_qodef_inline_style( $logo_styles ); ?>>
            <img itemprop="image" class="qodef-normal-logo" src="<?php echo esc_url( $logo_image ); ?>" <?php print wp_kses( $hwstring, array(
				'width'  => true,
				'height' => true
			) ); ?> alt="<?php esc_attr_e( 'logo', 'coney' ); ?>"/>
			<?php if ( ! empty( $logo_image_dark ) ) { ?>
                <img itemprop="image" class="qodef-dark-logo" src="<?php echo esc_url( $logo_image_dark ); ?>" <?php print wp_kses( $hwstring_dark, array(
					'width'  => true,
					'height' => true
				) ); ?> alt="<?php esc_attr_e( 'dark logo', 'coney' ); ?>"/><?php } ?>
			<?php if ( ! empty( $logo_image_light ) ) { ?>
                <img itemprop="image" class="qodef-light-logo" src="<?php echo esc_url( $logo_image_light ); ?>" <?php print wp_kses( $hwstring_light, array(
					'width'  => true,
					'height' => true
				) ); ?> alt="<?php esc_attr_e( 'light logo', 'coney' ); ?>"/><?php } ?>
			<?php if ( ! empty( $logo_image_fullscreen ) ) { ?>
                <img itemprop="image" class="qodef-fullscreen-logo" src="<?php echo esc_url( $logo_image_fullscreen ); ?>" alt="<?php esc_attr_e( 'fullscreen logo', 'coney' ); ?>"/><?php } ?>
        </a>
    </div>

<?php do_action( 'coney_qodef_after_site_logo' ); ?>