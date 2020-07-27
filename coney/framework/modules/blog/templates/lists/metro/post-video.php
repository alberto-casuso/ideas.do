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

$video_link = '#';
$video_type = get_post_meta(get_the_ID(), "qodef_video_type_meta", true);
if ($video_type == 'social_networks') {
    $video_link_meta =  get_post_meta(get_the_ID(), "qodef_post_video_link_meta", true);
    $video_link = $video_link_meta !== '' ? $video_link_meta : '#';
} elseif ($video_type == "self") {
    $video_link_meta =  get_post_meta(get_the_ID(), "qodef_post_video_custom_meta", true);
    $video_link = $video_link_meta !== '' ? get_post_meta(get_the_ID(), "qodef_post_video_custom_meta", true) . '?iframe=true&width50%&height=50%' : '#';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
        <?php coney_qodef_get_module_template_part('templates/parts/image', 'blog', '', $part_params); ?>

        <a class="qodef-video-post-link" href="<?php echo esc_url($video_link); ?>"
            <?php if($video_link !== '#') { ?> data-rel="prettyPhoto[<?php the_ID(); ?>]" <?php } ?>>
            <?php echo coney_qodef_icon_collections()->renderIcon('arrow_triangle-right_alt2', 'font_elegant', array('icon_attributes' => array('class' => 'qodef-vb-play-icon'))); ?>
        </a>
</article>