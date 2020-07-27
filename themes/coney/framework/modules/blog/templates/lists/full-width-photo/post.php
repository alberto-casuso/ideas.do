<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="qodef-post-content">
        <div class="qodef-container">
            <div class="qodef-container-inner">
                <div class="qodef-post-info-section-top">
                    <?php coney_qodef_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                    <?php coney_qodef_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <?php coney_qodef_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
        <div class="qodef-post-heading">
            <?php coney_qodef_get_module_template_part('templates/parts/image', 'blog', '', $part_params); ?>
        </div>
        <div class="qodef-container">
            <div class="qodef-container-inner">
                <div class="qodef-post-info-section-left">
                    <div class="qodef-post-info">
                        <span><?php echo esc_html__("Share:", "coney");?></span>
                        <?php coney_qodef_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    </div>
                    <div class="qodef-post-info">
                        <span><?php echo esc_html__("Written by:", "coney");?></span>
                        <?php coney_qodef_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                    </div>
                    <div class="qodef-post-info">
                        <span><?php echo esc_html__("Date:", "coney");?></span>
                        <?php coney_qodef_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    </div>
                    <div class="qodef-post-info">
                        <span><?php echo esc_html__("Tags:", "coney");?></span>
                        <?php coney_qodef_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
                    </div>
                </div>
                <div class="qodef-post-info-section-right">
                    <?php the_content(); ?>
                    <?php do_action('coney_qodef_single_link_pages'); ?>
                    <div class="qodef-post-info-bottom clearfix">
                        <div class="qodef-post-info-bottom-left">
                            <?php coney_qodef_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $part_params); ?>
                        </div>
                        <div class="qodef-post-info-bottom-right">
                            <?php coney_qodef_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>