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
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>

    <?php coney_qodef_get_module_template_part('templates/parts/post-info/link-overlay-quote', 'blog'); ?>

    <div class="qodef-post-info">
        <?php coney_qodef_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
        <div class="qodef-post-mark">
            <span class="icon_quotations qodef-quote-mark"></span>
        </div>
    </div>

</article>