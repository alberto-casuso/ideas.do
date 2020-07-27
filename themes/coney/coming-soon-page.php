<?php
/*
Template Name: Coming Soon Page
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
	    <?php
	    /**
	     * coney_qodef_header_meta hook
	     *
	     * @see coney_qodef_header_meta() - hooked with 10
	     * @see coney_qodef_user_scalable_meta() - hooked with 10
	     */
	    do_action('coney_qodef_header_meta');

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
		do_action('coney_qodef_after_body_tag'); ?>

		<div class="qodef-wrapper">
			<div class="qodef-wrapper-inner">
				<div class="qodef-content">
		            <div class="qodef-content-inner">
						<div class="qodef-full-width">
							<div class="qodef-full-width-inner">
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									<?php the_content(); ?>
								<?php endwhile; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>