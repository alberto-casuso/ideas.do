<?php
    /*
        Template Name: Blog: Split Column
    */
?>
<?php
$qodef_blog_type = 'split-column';
coney_qodef_include_blog_helper_functions('lists', $qodef_blog_type);
$qodef_holder_params = coney_qodef_get_holder_params_blog();
?>
<?php get_header(); ?>
<?php coney_qodef_get_title(); ?>
<?php get_template_part('slider'); ?>
    <div class="<?php echo esc_attr($qodef_holder_params['holder']); ?>">
        <?php do_action('coney_qodef_after_container_open'); ?>
        <div class="<?php echo esc_attr($qodef_holder_params['inner']); ?>">
            <?php coney_qodef_get_blog($qodef_blog_type); ?>
        </div>
        <?php do_action('coney_qodef_before_container_close'); ?>
    </div>
<?php coney_qodef_get_blog_widget_area(); ?>
<?php get_footer(); ?>