<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * coney_qodef_header_meta hook
	 *
	 * @see coney_qodef_header_meta() - hooked with 10
	 * @see coney_qodef_user_scalable_meta - hooked with 10
	 */
	do_action( 'coney_qodef_header_meta' );

	wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<?php
/**
 * coney_qodef_after_body_tag hook
 *
 * @see coney_qodef_get_side_area() - hooked with 10
 * @see coney_qodef_smooth_page_transitions() - hooked with 10
 */
do_action( 'coney_qodef_after_body_tag' ); ?>

<div class="qodef-wrapper qodef-404-page">
    <div class="qodef-wrapper-inner">
		<?php coney_qodef_get_header(); ?>

        <div class="qodef-content" <?php coney_qodef_content_elem_style_attr(); ?>>
            <div class="qodef-content-inner">
                <div class="qodef-page-not-found">
					<?php
					$qodef_title_image_404 = coney_qodef_options()->getOptionValue( '404_page_title_image' );
					$qodef_title_404       = coney_qodef_options()->getOptionValue( '404_title' );
					$qodef_subtitle_404    = coney_qodef_options()->getOptionValue( '404_subtitle' );
					$qodef_text_404        = coney_qodef_options()->getOptionValue( '404_text' );
					$qodef_button_label    = coney_qodef_options()->getOptionValue( '404_back_to_home' );
					?>

					<?php if ( ! empty( $qodef_title_image_404 ) ) { ?>
                        <div class="qodef-404-title-image">
                            <img src="<?php echo esc_url( $qodef_title_image_404 ); ?>" alt="<?php esc_attr_e( '404 Title Image', 'coney' ); ?>"/>
                        </div>
					<?php } ?>

                    <h1 class="qodef-page-not-found-title">
						<?php if ( ! empty( $qodef_title_404 ) ) {
							echo esc_html( $qodef_title_404 );
						} else {
							esc_html_e( '404', 'coney' );
						} ?>
                    </h1>

                    <h3 class="qodef-page-not-found-subtitle">
						<?php if ( ! empty( $qodef_subtitle_404 ) ) {
							echo esc_html( $qodef_subtitle_404 );
						} else {
							esc_html_e( 'Page not found', 'coney' );
						} ?>
                    </h3>

                    <p class="qodef-page-not-found-text">
						<?php if ( ! empty( $qodef_text_404 ) ) {
							echo esc_html( $qodef_text_404 );
						} else {
							esc_html_e( 'Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'coney' );
						} ?>
                    </p>

					<?php
					$qodef_params           = array();
					$qodef_params['text']   = ! empty( $qodef_button_label ) ? $qodef_button_label : esc_html__( 'BACK TO HOME', 'coney' );
					$qodef_params['link']   = esc_url( home_url( '/' ) );
					$qodef_params['target'] = '_self';
					$qodef_params['size']   = 'large';

					echo coney_qodef_execute_shortcode( 'qodef_button', $qodef_params ); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>