<?php

$featured_image_size = isset($featured_image_size) ? $featured_image_size : 'full';
$featured_image_meta = get_post_meta(get_the_ID(), 'qodef_blog_list_featured_image_meta', true);

$has_featured = !empty($featured_image_meta) || has_post_thumbnail();

$post_link_meta = get_post_meta(get_the_ID(), "qodef_post_image_link_meta", true );
$post_target_meta = get_post_meta(get_the_ID(), "qodef_post_image_link_target_meta", true );

if(!empty($post_link_meta)) {
    $post_link = esc_html($post_link_meta);
    $post_target = !empty($post_target_meta)?esc_html($post_target_meta): "_blank";
}

$title_params = array(
    'title_tag' => $title_tag
);

?>

<div class="qodef-post-banner-holder">
    <div class="qodef-post-banner-holder-inner">
        <?php if(isset($post_link) && $post_link != '') { ?>
        <a itemprop="url" href="<?php echo esc_url($post_link); ?>" title="<?php the_title_attribute(); ?>" target="<?php echo esc_attr($post_target);?>" class="qodef-post-banner-link">
            <?php } ?>
            <?php if($has_featured) { ?>
                <div class="qodef-post-banner-image">
                    <?php if(coney_qodef_return_has_media()) { ?>
                        <?php if($featured_image_meta !== '')  { ?>
                            <img itemprop="image" class="qodef-custom-post-image" src="<?php echo esc_url($featured_image_meta); ?>" alt="<?php esc_attr_e('Blog list featured image', 'coney'); ?>" />
                        <?php } else { ?>
                            <?php the_post_thumbnail($featured_image_size); ?>
                        <?php } ?>
                    <?php } else { ?>
                        <?php coney_qodef_get_module_template_part('templates/parts/title', 'blog', '', $title_params); ?>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <?php coney_qodef_get_module_template_part('templates/parts/title', 'blog', '', $title_params); ?>
            <?php } ?>
            <?php if(isset($post_link) && $post_link != '') { ?>
        </a>
    <?php } ?>
    </div>
</div>