<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php coney_qodef_get_title(); ?>
        <div class="qodef-container">
            <div class="qodef-container-inner">
                <?php coney_qodef_single_team(); ?>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>