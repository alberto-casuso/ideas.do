<div class="qodef-columns-wrapper <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-columns-inner">
	    <div class="qodef-column-content qodef-column-content1">
		    <?php coney_qodef_get_blog_type($blog_type); ?>
	    </div>
		<?php if($sidebar_layout !== 'no-sidebar') { ?>
        <div class="qodef-column-content qodef-column-content2">
            <?php get_sidebar(); ?>
        </div>
		<?php } ?>
	</div>
</div>