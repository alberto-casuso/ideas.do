<div class="qodef-columns-wrapper <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-columns-inner">
		<div class="qodef-column-content qodef-column-content1">
			<div class="qodef-blog-holder qodef-blog-single <?php echo esc_attr($blog_single_classes); ?>">
				<?php coney_qodef_get_blog_single_type($blog_single_type); ?>
			</div>
		</div>
		<?php if($sidebar_layout !== 'no-sidebar') { ?>
			<div class="qodef-column-content qodef-column-content2">
				<?php get_sidebar(); ?>
			</div>
		<?php } ?>
	</div>
</div>