<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
	<div class="qodef-post-content">
		<div class="qodef-post-text">
			<div class="qodef-post-text-inner">
                <div class="qodef-post-info qodef-section-top">
                    <?php coney_qodef_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                </div>
                <?php coney_qodef_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
				<?php coney_qodef_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
				<?php coney_qodef_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                <div class="qodef-post-info qodef-section-bottom">
					<?php coney_qodef_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $part_params); ?>
                    <?php coney_qodef_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                </div>
			</div>
		</div>
	</div>
</article>