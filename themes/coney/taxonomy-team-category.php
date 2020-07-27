<?php get_header(); ?>
<?php coney_qodef_get_title(); ?>
<div class="qodef-container qodef-default-page-template">
	<?php do_action('coney_qodef_after_container_open'); ?>
	<div class="qodef-container-inner clearfix">
		<?php
            $qodef_cat_id = get_queried_object_id();
            $qodef_cat = get_category($qodef_cat_id);
            $qodef_cat_slug = $qodef_cat->slug;

            coney_qodef_get_team_category_list($qodef_cat_slug);
		?>
	</div>
	<?php do_action('coney_qodef_before_container_close'); ?>
</div>
<?php get_footer(); ?>
