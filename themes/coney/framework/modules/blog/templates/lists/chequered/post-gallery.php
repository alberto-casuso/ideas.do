<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <a itemprop="url" class="qodef-blog-masonry-gallery-link" href="<?php the_permalink(); ?>"></a>
    <div class="qodef-post-content">
        <div class="qodef-post-heading">
            <?php coney_qodef_get_module_template_part('templates/parts/post-type/gallery', 'blog', '', $part_params); ?>
        </div>
    </div>
</article>