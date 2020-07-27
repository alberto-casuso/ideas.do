<?php get_header(); ?>
<?php coney_qodef_get_title(); ?>
<div class="qodef-container qodef-default-page-template">
	<?php do_action('coney_qodef_after_container_open'); ?>
	<div class="qodef-container-inner clearfix">
		<?php

		$qodef_taxonomy_id   = get_queried_object_id();
		$qodef_taxonomy_type = 'portfolio-category';
		$qodef_taxonomy      = ! empty( $qodef_taxonomy_id ) ? get_term_by( 'id', $qodef_taxonomy_id, $qodef_taxonomy_type ) : '';
		$qodef_taxonomy_slug = ! empty( $qodef_taxonomy ) ? $qodef_taxonomy->slug : '';

		coney_qodef_get_portfolio_category_list($qodef_taxonomy_slug);
		?>
	</div>
	<?php do_action('coney_qodef_before_container_close'); ?>
</div>
<?php get_footer(); ?>
