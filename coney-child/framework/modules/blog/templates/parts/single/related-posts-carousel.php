<?php
$show_related = coney_qodef_options()->getOptionValue('blog_single_related_posts') == 'yes' ? true : false;

if($show_related) {
    $data_attr = ''; 
    $data_attr .= ' data-layout=carousel';

    if(coney_qodef_sidebar_layout() === 'no-sidebar') {
        $data_attr .= ' data-number-visible=4';
        $related_post_number = 8;
    }
    else {
        $data_attr .= ' data-number-visible=3';
        $related_post_number = 6;
    }

    $related_posts_options = array(
        'posts_per_page' => $related_post_number
    );

    $related_posts = coney_qodef_get_blog_related_post_type(get_the_ID(), $related_posts_options);

?>
    <div class="qodef-related-posts-holder qodef-related-posts-carousel clearfix">
        <div class="qodef-related-posts-holder-inner">
            <?php if ( $related_posts && $related_posts->have_posts() ) : ?>
                <div class="qodef-related-posts-title">
                    <h6><?php esc_html_e('Artículos que pueden interesarte', 'coney' ); ?></h6>
                </div>
                <div class="qodef-related-posts-inner clearfix" <?php echo esc_attr($data_attr); ?>>
                    <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                        <div class="qodef-related-post">
                            <div class="qodef-related-post-inner">
                                <div class="qodef-related-post-image">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail('coney_qodef_related_post'); ?>
                                        </a>
                                    <?php }	?>
                                </div>
                                <div class="qodef-related-post-holder-info">
                                    <h6 itemprop="name" class="entry-title qodef-post-title"><a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
<?php } ?>