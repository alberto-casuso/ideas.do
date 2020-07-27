<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="qodef-post-content">
        <div class="qodef-post-text">
            <div class="qodef-post-text-inner">
                <div class="qodef-post-text-main">
                    <div class="qodef-post-mark">
                        <span class="icon_quotations qodef-quote-mark"></span>
                    </div>
                    <?php coney_qodef_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="qodef-post-additional-content">
        <?php the_content(); ?>
        <div class="qodef-post-info-bottom clearfix">
            <div class="qodef-post-info-bottom-left">
                <?php coney_qodef_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
            </div>
            <div class="qodef-post-info-bottom-right">
                <?php coney_qodef_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
            </div>
        </div>
    </div>
</article>