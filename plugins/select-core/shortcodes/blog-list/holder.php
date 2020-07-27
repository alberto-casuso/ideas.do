<div class="qodef-blog-list-holder <?php echo esc_attr( $holder_classes ); ?>" <?php echo wp_kses( $holder_data, array( 'data' ) ); ?>>
    <div class="qodef-bl-wrapper">
		<?php if ( $section_title == 'yes' ) {
			coney_qodef_get_module_template_part( 'templates/parts/post-info/section-title', 'blog', '', $params );
		} ?>
        <ul class="qodef-blog-list">
			<?php
			if ( $query_result->have_posts() ):
				while ( $query_result->have_posts() ) : $query_result->the_post();
					//coney_qodef_get_module_template_part( 'shortcodes/blog-list/layout-collections/' . $type, 'blog', '', $params );
					echo select_core_get_shortcode_template_part( 'layout-collections/' . $type, 'blog-list', '', $params );
				endwhile;
			else:
				coney_qodef_get_module_template_part( 'templates/parts/no-posts', 'blog', '', $params );
			endif;

			wp_reset_postdata();
			?>
        </ul>
    </div>
	<?php coney_qodef_get_module_template_part( 'templates/parts/pagination/' . $params['pagination_type'], 'blog', '', $params ); ?>
</div>