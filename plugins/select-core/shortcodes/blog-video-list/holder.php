<div class="qodef-blog-video-list-holder <?php echo esc_attr( $holder_classes ); ?>">
    <div class="qodef-bvl-wrapper">
		<?php if ( $section_title == 'yes' ) {
			coney_qodef_get_module_template_part( 'templates/parts/post-info/section-title', 'blog', '', $params );
		} ?>
        <ul class="qodef-blog-video-list">

			<?php
			if ( $query_result->have_posts() ):
				while ( $query_result->have_posts() ) : $query_result->the_post();

					$html       = '';
					$video_link = '';

					$has_video_link = get_post_meta( get_the_ID(), "qodef_post_video_link_meta", true ) !== '';

					if ( $has_video_link ) {
						$video_link = get_post_meta( get_the_ID(), "qodef_post_video_link_meta", true );
					}

					$featured_image_meta = get_post_meta( get_the_ID(), 'qodef_blog_list_featured_image_meta', true );
					$video_image         = ! empty( $featured_image_meta ) && coney_qodef_blog_item_has_link() ? $featured_image_meta : get_the_post_thumbnail_url( get_the_ID(), 'full' );

					if ( ! empty( $video_link ) ) {
						print '<li class="qodef-bvl-item clearfix"><div class="qodef-blog-video-list-item-inner">';
						echo coney_qodef_get_video_button_html( array(
							'video_link'  => $video_link,
							'video_image' => $video_image
						) );
						print '</div></li>';
					}

				endwhile;
			else:
				coney_qodef_get_module_template_part( 'templates/parts/no-posts', 'blog', '', $params );
			endif;

			wp_reset_postdata();
			?>

        </ul>
    </div>
</div>