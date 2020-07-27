<li class="qodef-blog-slider-item">
    <div class="qodef-blog-slider-item-inner">
        <div class="qodef-item-image clearfix">
            <a itemprop="url" href="<?php echo esc_url(get_permalink()) ?>">
                <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
            </a>
        </div>
        <div class="qodef-item-text-wrapper">
            <div class="qodef-item-text-holder  qodef-container">
                <div class="qodef-item-text-holder-inner  qodef-container-inner clearfix">
                    <?php if($post_info_date == 'yes' ){ ?>
                        <div class="qodef-item-info-section-top"  <?php coney_qodef_inline_style($info_styles); ?>>
                            <?php coney_qodef_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params); ?>
                        </div>
                    <?php } ?>

                    <<?php echo esc_attr( $title_tag)?> itemprop="name" class="qodef-item-title entry-title">
                    <a itemprop="url" href="<?php echo esc_url(get_permalink()); ?>" <?php coney_qodef_inline_style($title_styles); ?>>
                        <?php echo get_the_title(); ?>
                    </a>
                </<?php echo esc_attr($title_tag); ?>>
                <div class="qodef-section-button-holder">
                    <?php coney_qodef_get_module_template_part('templates/parts/post-info/read-more', 'blog', 'bs', $params); ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</li>