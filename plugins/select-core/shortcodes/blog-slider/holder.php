<div class="qodef-blog-slider-holder <?php echo esc_attr( $holder_classes ); ?>">
    <ul class="qodef-blog-slider" <?php echo coney_qodef_get_inline_attrs( $slider_data ); ?>>
		<?php
		if ( $query_result->have_posts() ):
			while ( $query_result->have_posts() ) : $query_result->the_post();
				//coney_qodef_get_module_template_part('shortcodes/blog-slider/layout-collections/blog-slider-'.$type, 'blog', '', $params);
				echo select_core_get_shortcode_template_part( 'layout-collections/blog-slider-' . $type, 'blog-slider', '', $params );
			endwhile;
		else: ?>
            <div class="qodef-blog-slider-messsage">
                <p><?php esc_html_e( 'No posts were found.', 'select-core' ); ?></p>
            </div>
		<?php endif;

		wp_reset_postdata();
		?>
    </ul>
</div>
