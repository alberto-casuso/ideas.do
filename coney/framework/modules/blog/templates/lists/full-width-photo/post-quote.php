<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="qodef-post-content">
        <div class="qodef-post-heading">
            <div class="qodef-container">
                <div class="qodef-container-inner">
                    <div class="qodef-post-mark">
                        <span class="icon_quotations qodef-quote-mark"></span>
                    </div>
                    <?php coney_qodef_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
                 </div>
            </div>
        </div>
    </div>
</article>