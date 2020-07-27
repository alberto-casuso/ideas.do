<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
	<div class="qodef-post-content">
		<div class="qodef-post-text">
			<div class="qodef-post-text-inner">
                <div class="qodef-post-info">
                    <?php coney_qodef_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                    <?php coney_qodef_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <div class="qodef-post-author-date-holder">
                        <?php coney_qodef_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                        <?php coney_qodef_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    </div>
                </div>
                <div class="qodef-post-heading">
                    <?php coney_qodef_get_module_template_part('templates/parts/post-type/gallery', 'blog', '', $part_params); ?>
                </div>
                <div class="qodef-post-text-main">
                    <?php coney_qodef_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                </div>
                <div class="qodef-post-info-bottom">
                    <div class="qodef-info-bottom-item">
                        <?php echo esc_html__("Share:", "coney");?>
                        <?php coney_qodef_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    </div>
                    <div class="qodef-info-bottom-item">
                        <?php coney_qodef_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $part_params); ?>
                    </div>
                    <div class="qodef-info-bottom-item">
                        <?php coney_qodef_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                    </div>
                </div>
			</div>
		</div>
	</div>
</article>