<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="qodef-post-content">

        <?php coney_qodef_get_module_template_part('templates/parts/post-info/link-overlay-link', 'blog'); ?>

        <div class="qodef-post-text">
            <div class="qodef-post-text-inner">
                <div class="qodef-post-mark">
                    <span class="icon_link qodef-link-mark"></span>
                </div>
                <?php coney_qodef_get_module_template_part('templates/parts/post-type/link', 'blog', '', $part_params); ?>
            </div>
        </div>
    </div>
</article>