<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="qodef-post-content">
        <div class="qodef-container">
            <div class="qodef-container-inner">
        <?php coney_qodef_get_module_template_part('templates/parts/post-type/image', 'blog', '', $part_params); ?>
             </div>
        </div>
    </div>
</article>