<?php
$title_tag = isset($quote_tag) ? $quote_tag : 'h5';
$quote_text_meta = get_post_meta(get_the_ID(), "qodef_post_quote_text_meta", true );

$post_title = !empty($quote_text_meta) ? $quote_text_meta : get_the_title();

$post_author = get_post_meta(get_the_ID(), "qodef_post_quote_author_meta", true );

$post_link_behavior = coney_qodef_get_meta_field_intersect('blog_quote_behavior', coney_qodef_get_page_id());

if(coney_qodef_get_blog_module() == 'list' && $post_link_behavior == 'custom_behavior') {
    $post_link = get_the_permalink();
}
?>

<div class="qodef-post-quote-holder">
    <div class="qodef-post-quote-holder-inner">
        <<?php echo esc_attr($title_tag);?> itemprop="name" class="qodef-quote-title qodef-post-title">
        <?php if(isset($post_link) && $post_link != '') { ?>
            <a itemprop="url" href="<?php echo esc_url($post_link); ?>" title="<?php the_title_attribute(); ?>">
        <?php } ?>
                <span aria-hidden="true" class="icon_quotations"></span><?php echo esc_html($post_title); ?>
        <?php if(isset($post_link) && $post_link != '') { ?>
            </a>
        <?php } ?>
        </<?php echo esc_attr($title_tag);?>>
        <?php if($post_author != '') { ?>
            <span class="qodef-quote-author">
                    <span class="qodef-quote-line">&#45;</span><?php echo esc_html($post_author); ?>
                </span>
        <?php } ?>
    </div>
</div>