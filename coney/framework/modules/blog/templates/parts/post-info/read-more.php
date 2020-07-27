<div class="qodef-post-read-more-button">
	<?php
	if ( coney_qodef_core_plugin_installed() ) {
		echo coney_qodef_get_button_html(
			apply_filters(
				'coney_qodef_blog_template_read_more_button',
				array(
					'type'         => 'solid',
					'size'         => 'medium',
					'link'         => get_the_permalink(),
					'text'         => esc_html__( 'Read more', 'coney' ),
					'custom_class' => 'qodef-blog-list-button'
				)
			)
		);
	} else { ?>
        <a itemprop="url" href="<?php echo esc_url( get_the_permalink() ); ?>" target="_self" class="qodef-btn qodef-btn-medium qodef-btn-solid qodef-blog-list-button">
            <span class="qodef-btn-text">
                <?php echo esc_html__( 'Read more', 'coney' ); ?>
            </span>
        </a>
	<?php } ?>
</div>
