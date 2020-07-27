<?php defined('ABSPATH') or die("No script kiddies please!");

$wpcd_settings = get_option('wpcd_settings');
$page_number = empty($page_number) ? 1 : $page_number;
$template = (isset($wpcd_settings['template_number']) && $wpcd_settings['template_number'] != "") ? esc_attr($wpcd_settings['template_number']) : 'template-1';
$pagination = (isset($wpcd_settings['pagination']) && $wpcd_settings['pagination'] !="") ? esc_attr($wpcd_settings['pagination']): '';
$items_per_page = (isset($wpcd_settings['items_per_page']) && $wpcd_settings['items_per_page'] != "") ? esc_attr($wpcd_settings['items_per_page']) : '10';
$pagination_type = 'page_number';

?>
<div class="wpcd-comment-listing-wrap" id="wpcd-comment-listing-wrap">
    <?php
    if (isset($wpcd_settings['comment_number']) && $wpcd_settings['comment_number'] == 'show') {
        echo "<div class='wpcd-comments-title'>";
        $comments_number = comments_number(esc_html__('No Thoughts', 'wp-comment-designer-lite'), esc_html__('One Thought', 'wp-comment-designer-lite'), '% ' . esc_html__('Thoughts', 'wp-comment-designer-lite'));
        echo $comments_number . ' on ' . get_the_title();
        echo "</div>";
    }
    ?>
    <?php include(WPCD_LITE_PLUGIN_PATH . 'inc/frontend/wpcd_comment_listing_inner.php'); ?>

    <!-- WPCD COMMENT PAGINATION -->
    <?php if (isset($wpcd_settings['pagination']) && $wpcd_settings['pagination'] == 'enable') { ?>
        <?php include(WPCD_LITE_PLUGIN_PATH . 'inc/frontend/comment_pagination.php'); 
    }
    ?>
</div>