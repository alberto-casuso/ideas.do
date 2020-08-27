<?php if($max_num_pages > 1) { ?>
	<div class="qodef-blog-pag-loading">
		<div class="progress-loader-holder">
			<div class="progress-loader-holder-text">
				<div class="progress-loader-holder-number">0</div>
			</div>
		</div>
	</div>
	<div class="qodef-blog-pag-load-more">
		<?php
        if(coney_qodef_core_plugin_installed()) {
			echo coney_qodef_get_button_html(
                apply_filters(
                    'coney_qodef_blog_template_load_more_button',
                    array(
                        'link' => 'javascript: void(0)',
                        'size' => 'large',
                        'text' => esc_html__('Ver más', 'coney')
			        )
                )
            );
        } else { ?>
            <a itemprop="url" href="javascript:void(0)" target="_self" class="qodef-btn qodef-btn-large qodef-btn-solid">
                <span class="qodef-btn-text">
                    <?php echo esc_html__('Ver más', 'coney'); ?>
                </span>
            </a>
		<?php } ?>
	</div>
    <?php
        $unique_id = rand( 1000, 9999 );
        wp_nonce_field( 'qodef_blog_load_more_nonce_' . $unique_id, 'qodef_blog_load_more_nonce_' . $unique_id );
    ?>
<?php }