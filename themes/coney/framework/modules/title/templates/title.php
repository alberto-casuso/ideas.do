<?php do_action( 'coney_qodef_before_page_title' ); ?>
<div class="qodef-title <?php echo coney_qodef_title_classes(); ?>" style="<?php echo esc_attr( $title_height );
echo esc_attr( $title_background_color );
echo esc_attr( $title_background_image ); ?>" data-height="<?php echo esc_attr( intval( preg_replace( '/[^0-9]+/', '', $title_height ), 10 ) ); ?>" <?php echo esc_attr( $title_background_image_width ); ?>>
	<?php if ( ! empty( $title_background_image_src ) ) { ?>
        <div class="qodef-title-image">
            <img itemprop="image" src="<?php echo esc_url( $title_background_image_src ); ?>" alt="<?php esc_attr_e( 'Title Image', 'coney' ); ?>"/>
        </div>
	<?php } ?>
    <div class="qodef-title-holder" <?php coney_qodef_inline_style( $title_holder_height ); ?>>
        <div class="qodef-container clearfix">
            <div class="qodef-container-inner">
                <div class="qodef-title-subtitle-holder" style="<?php echo esc_attr( $title_subtitle_holder_padding ); ?>">
                    <div class="qodef-title-subtitle-holder-inner">
						<?php switch ( $type ){
						case 'standard': ?>
						<?php if ( coney_qodef_get_title_text() !== '' ) { ?>
                        <<?php echo esc_attr( $title_tag ); ?> class="qodef-page-title entry-title" <?php coney_qodef_inline_style( $title_color ); ?>><span><?php coney_qodef_title_text(); ?></span>
                    </<?php echo esc_attr( $title_tag ); ?>>
					<?php } ?>
					<?php if ( $has_subtitle ) { ?>
                        <span class="qodef-subtitle" <?php coney_qodef_inline_style( $subtitle_color ); ?>><span><?php coney_qodef_subtitle_text(); ?></span></span>
					<?php } ?>
					<?php if ( $enable_breadcrumbs ) { ?>
                        <div class="qodef-breadcrumbs-holder"> <?php coney_qodef_custom_breadcrumbs(); ?></div>
					<?php } ?>
					<?php break;
					case 'breadcrumb': ?>
                        <div class="qodef-breadcrumbs-holder"> <?php coney_qodef_custom_breadcrumbs(); ?></div>
						<?php break;
					}
					?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php do_action( 'coney_qodef_after_page_title' ); ?>
