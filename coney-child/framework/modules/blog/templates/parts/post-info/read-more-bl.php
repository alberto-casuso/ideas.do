<div class="qodef-post-read-more-button">
	<?php
	if ( coney_qodef_core_plugin_installed() ) {
		echo coney_qodef_get_button_html(
			apply_filters(
				'coney_qodef_blog_shortcode_read_more_button',
				array(
					'type'         => 'simple',
					'link'         => get_the_permalink(),
					'text'         => esc_html__( 'Leer más', 'coney' ),
					'custom_class' => 'qodef-bli-button'
				)
			)
		);
	} else { ?>
        <a itemprop="url" href="<?php echo esc_url( get_the_permalink() ); ?>" target="_self" class="qodef-btn qodef-btn-medium qodef-btn-simple qodef-bli-button">
            <span class="qodef-btn-text">
                <?php echo esc_html__( 'Leer más', 'coney' ); ?>
            </span>
        </a>
	<?php } ?>
</div>
