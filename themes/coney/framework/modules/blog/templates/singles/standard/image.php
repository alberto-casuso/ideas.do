<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="qodef-post-content">
        <?php coney_qodef_get_module_template_part('templates/parts/post-type/image', 'blog', '', $part_params); ?>
    </div>
    <div class="qodef-post-additional-content">
        <?php the_content(); ?>
    </div>
</article>