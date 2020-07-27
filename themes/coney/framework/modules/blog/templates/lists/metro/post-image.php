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
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
	<div class="qodef-post-content">
		<?php coney_qodef_get_module_template_part('templates/parts/post-type/image', 'blog', '', $part_params); ?>
	</div>
</article>