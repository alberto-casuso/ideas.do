<li class="qodef-blog-slider-item">
    <div class="qodef-blog-slider-item-inner">
        <div class="qodef-item-image clearfix">
            <a itemprop="url" href="<?php echo esc_url(get_permalink()) ?>">
                <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
            </a>
        </div>
        <div class="qodef-item-text-wrapper">
            <div class="qodef-item-text-holder <?php if($in_grid== 'yes'){?> qodef-container <?php }?>">
                <div class="qodef-item-text-holder-inner <?php if($in_grid== 'yes'){?> qodef-container-inner clearfix <?php }?>">
                    <?php if($in_grid== 'yes'){?> <div class="qodef-main-text-holder"> <?php }?>
                    <?php if($post_info_category == 'yes' ){ ?>
                        <div class="qodef-item-info-section-top"  <?php coney_qodef_inline_style($info_styles); ?>>
                            <?php coney_qodef_get_module_template_part('templates/parts/post-info/category', 'blog', '', $params); ?>
                        </div>
                    <?php } ?>

                    <<?php echo esc_attr( $title_tag)?> itemprop="name" class="qodef-item-title entry-title">
                    <a itemprop="url" href="<?php echo esc_url(get_permalink()); ?>" <?php coney_qodef_inline_style($title_styles); ?>>
                        <?php echo get_the_title(); ?>
                    </a>
                </<?php echo esc_attr($title_tag); ?>>
                <?php if($post_info_date == 'yes' ||  $post_info_author == 'yes'){ ?>
                    <div class="qodef-item-info-section-bottom"  <?php coney_qodef_inline_style($info_styles); ?>>

                        <?php coney_qodef_get_module_template_part('templates/parts/post-info/author', 'blog', '', $params); ?>
                        <?php coney_qodef_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params); ?>
                    </div>
                <?php } ?>

                <div class="qodef-section-button-holder">
                    <?php coney_qodef_get_module_template_part('templates/parts/post-info/read-more', 'blog', 'bs', $params); ?>
                </div>
                <?php if($in_grid== 'yes'){?> </div> <?php }?>
            </div>
        </div>
    </div>
    </div>
</li>