<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<style>
    <?php
    $wpcd_settings = get_option('wpcd_settings');

    if (isset($wpcd_settings['font_family']) && $wpcd_settings['font_family'] != '') {
        if ($wpcd_settings['font_family']!='Default'){
            echo '.wp-comment-designer-lite-wrap,
            .wpcd-author-name,
            .wpcd-comment,
            .wpcd-date-time, 
            .wpcd-flag-comments-wrap, 
            .wpcd-reply-button, 
            .wpcd-edit-comments-wrapper,
            .wpcd-comment-pagination-wrapper,
            .wpcd-comment-form-submit,
            .wp-comment-designer-lite-wrap input::placeholder 
                    {font-family: ' . esc_attr($wpcd_settings['font_family']) . '}';
        }
    }
    ?>
</style>