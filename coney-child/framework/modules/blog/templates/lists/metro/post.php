<?php
$image_proportion = coney_qodef_get_meta_field_intersect('blog_list_featured_image_proportion', coney_qodef_get_page_id());
$image_proportion_value = get_post_meta(get_the_ID(), 'qodef_blog_masonry_gallery_' . $image_proportion .'_dimensions_meta', true);

if (isset($image_proportion_value) && $image_proportion_value !== '') {
    $size = $image_proportion_value !== '' ? $image_proportion_value : 'default';
    $post_classes[] = 'qodef-post-size-'. $size;
}
else {
    $size = 'default';
    $post_classes[] = 'qodef-post-size-default';
}
if($image_proportion == 'original') {
    $part_params['featured_image_size'] = 'full';
}
else {
    switch ($size):
        case 'default':
            $part_params['featured_image_size'] = 'coney_qodef_square';
            break;
        case 'large-width':
            $part_params['featured_image_size'] = 'coney_qodef_landscape';
            break;
        case 'large-height':
            $part_params['featured_image_size'] = 'coney_qodef_portrait';
            break;
        case 'large-width-height':
            $part_params['featured_image_size'] = 'coney_qodef_huge';
            break;
        default:
            $part_params['featured_image_size'] = 'coney_qodef_square';
            break;
    endswitch;
}
?>
<!--article id="post-< ?php the_ID(); ?>" < ?php post_class($post_classes); ?>>
        < ?php coney_qodef_get_module_template_part('templates/parts/image', 'blog', '', $part_params); ?>

        <-?php coney_qodef_get_module_template_part('templates/parts/post-info/link-overlay', 'blog'); ?>

        <div class="qodef-post-info texto-blog-home">
            <div class="qodef-post-top-section">
                <-?php coney_qodef_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                <-?php coney_qodef_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
            </div>
            <div class="qodef-post-text-main">
            <-?php coney_qodef_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
            </div>
            <div class="qodef-post-info-bottom">
                <-?php coney_qodef_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $part_params); ?>
            </div>
        </div>

</article-->
<article id="post-<?php the_ID(); ?>"  <?php post_class($post_classes); ?>>
    <div class="container">
        <div class="row">
            <div class="col-5 post-info">
                <h4 itemprop="name" class="entry-title qodef-post-title">
                <a itemprop="url" href="<?php echo get_the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_title(); ?>
                        </a>
                </h4>
                <div class="qodef-post-read-more-button">
                <?php
                if ( coney_qodef_core_plugin_installed() ) {
                    echo coney_qodef_get_button_html(
                        apply_filters(
                            'coney_qodef_blog_template_read_more_button',
                            array(
                                'type'         => 'solid',
                                'size'         => 'medium',
                                'link'         => get_the_permalink(),
                                'text'         => esc_html__( 'Read more', 'coney' ),
                                'custom_class' => 'qodef-blog-list-button'
                            )
                        )
                    );
                } else { ?>
                    <a itemprop="url" href="<?php echo esc_url( get_the_permalink() ); ?>" target="_self" class="qodef-btn qodef-btn-medium qodef-btn-solid qodef-blog-list-button">
                        <span class="qodef-btn-text">
                            <?php echo esc_html__( 'Read more', 'coney' ); ?>
                        </span>
                    </a>
                <?php } ?>
            </div>

               
                <?php //coney_qodef_get_module_template_part('templates/parts/post-info/link-overlay', 'blog'); ?>
                <!--div class="qodef-post-info texto-blog-home">
                    <div class="qodef-post-top-section">
                        < ?php coney_qodef_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                        < ?php coney_qodef_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                    </div>
                    <div class="qodef-post-text-main">
                    <?php //coney_qodef_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>



                        <a itemprop="url" href="< ?php echo get_the_permalink(); ?>" title="< ?php the_title_attribute(); ?>">
                        < ?php the_title(); ?>
                        </a>

                    </div>
                    <div class="qodef-post-info-bottom">
                        < ?php coney_qodef_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $part_params); ?>
                    </div>
                </div-->
            </div>
            <div class="col-7">
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

            <!--div class="qodef-post-banner-holder">
                <div class="qodef-post-banner-holder-inner"-->
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
                <!--/div>
            </div-->
            <?php //coney_qodef_get_module_template_part('templates/parts/image', 'blog', '', $part_params); ?>
            </div>
        </div>
    </div>
</article>