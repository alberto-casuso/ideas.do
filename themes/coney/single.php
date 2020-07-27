<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <?php
        $qodef_blog_single_type = coney_qodef_get_meta_field_intersect('blog_single_type');
        coney_qodef_include_blog_helper_functions('singles', $qodef_blog_single_type);
        $qodef_holder_params = coney_qodef_get_holder_params_blog();

        $module_title = isset($qodef_holder_params['module_title']) ? $qodef_holder_params['module_title'] : false;
        $module_title_layout = isset($qodef_holder_params['module_title_layout']) ? $qodef_holder_params['module_title_layout'] : "";
        ?>

        <?php coney_qodef_get_title($module_title, 'blog', $module_title_layout); ?>
            <?php get_template_part('slider'); ?>
            <div class="<?php echo esc_attr($qodef_holder_params['holder']); ?>">
                <?php do_action('coney_qodef_after_container_open'); ?>
                <div class="<?php echo esc_attr($qodef_holder_params['inner']); ?>">
                    <?php coney_qodef_get_blog_single($qodef_blog_single_type); ?>
                </div>
            <?php do_action('coney_qodef_before_container_close'); ?>
            </div>
    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>