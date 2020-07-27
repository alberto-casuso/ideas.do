<?php
$post_quote_behavior = coney_qodef_get_meta_field_intersect('blog_quote_behavior', coney_qodef_get_page_id());

if(coney_qodef_get_blog_module() == 'list' && $post_quote_behavior == 'custom_behavior') { ?>
    <a class="qodef-post-link-overlay" itemprop="url" href="<?php echo get_the_permalink(); ?>" title="<?php the_title_attribute(); ?>" target="_blank"></a>
<?php } ?>