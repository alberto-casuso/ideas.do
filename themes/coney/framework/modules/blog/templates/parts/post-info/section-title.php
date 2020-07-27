<?php
$title = isset($title) ? $title : '';
$section_title_tag = isset($section_title_tag) ? $section_title_tag : 'h6';
$section_title_style = isset($section_title_style) ? $section_title_style : '';
?>
<div class="qodef-bli-section-title-holder">
    <<?php echo esc_attr($section_title_tag);?> itemprop="name" class="qodef-bli-section-title" <?php echo coney_qodef_get_inline_style($section_title_style); ?>>
        <?php echo esc_html($title); ?>
    </<?php echo esc_attr($section_title_tag);?>>
    <span class="qodef-bli-section-title-line"></span>
</div>