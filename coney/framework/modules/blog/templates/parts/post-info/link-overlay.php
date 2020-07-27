<?php if(coney_qodef_blog_item_has_link()) { ?>
    <a class="qodef-post-link-overlay" itemprop="url" href="<?php echo get_the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
<?php } ?>