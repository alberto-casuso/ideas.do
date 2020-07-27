<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <a itemprop="url" class="qodef-blog-masonry-gallery-link" href="<?php the_permalink(); ?>"></a>
    <div class="qodef-post-content">
        <div class="qodef-post-heading">
            <?php coney_qodef_get_module_template_part('templates/parts/image', 'blog', '', $part_params); ?>
            <?php coney_qodef_get_module_template_part('templates/parts/post-type/audio', 'blog', '', $part_params); ?>
        </div>
        <?php echo coney_qodef_icon_collections()->renderIcon('icon_music', 'font_elegant', array('icon_attributes' => array('class' => 'qodef-vb-play-icon'))); ?>
    </div>
</article>