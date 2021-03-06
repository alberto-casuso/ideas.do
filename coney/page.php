<?php
$qodef_sidebar_layout  = coney_qodef_sidebar_layout();
$qodef_sidebar_classes = coney_qodef_sidebar_columns_class();

get_header();
coney_qodef_get_title();
get_template_part('slider');
?>
<div class="qodef-container qodef-default-page-template">
	<?php do_action('coney_qodef_after_container_open'); ?>
	<div class="qodef-container-inner clearfix">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="qodef-columns-wrapper <?php echo esc_attr($qodef_sidebar_classes); ?>">
				<div class="qodef-columns-inner">
					<div class="qodef-column-content qodef-column-content1">
						<?php
							the_content();
							do_action('coney_qodef_page_after_content');
						?>
					</div>
					<?php if($qodef_sidebar_layout !== 'no-sidebar') { ?>
						<div class="qodef-column-content qodef-column-content2">
							<?php get_sidebar(); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php endwhile; endif; ?>
	</div>
	<?php do_action('coney_qodef_before_container_close'); ?>
</div>
<?php get_footer(); ?>