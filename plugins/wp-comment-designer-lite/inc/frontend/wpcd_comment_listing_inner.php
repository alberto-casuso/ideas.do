<?php defined('ABSPATH') or die("No script kiddies please!");

$wpcd_settings = get_option('wpcd_settings');
$page_number = empty($page_number) ? 1 : $page_number;
$template = (isset($wpcd_settings['template_number']) && $wpcd_settings['template_number'] != "") ? esc_attr($wpcd_settings['template_number']) : 'template-1';
$pagination = (isset($wpcd_settings['pagination']) && $wpcd_settings['pagination']) ? esc_attr($wpcd_settings['pagination']): '';
$items_per_page = (isset($wpcd_settings['items_per_page']) && $wpcd_settings['items_per_page'] != "") ? esc_attr($wpcd_settings['items_per_page']) : '10';
$pagination_type = 'page-number';

?>
<div class="wpcd-comment-list-inner">
    <?php
    $db_table_name = $wpdb->prefix . "comments";
    $comment_listing = WPCD_LITE_CLASS::wpcd_recursive_array_builder($db_table_name = $wpdb->prefix . "comments", $parent = 0, $parent_child = true, $post_id, $sort_type, $pagination, $items_per_page, $pagination_type, $page_number);
    /* For listing the comments */
    ?>
    <div class="wpcd-comment-listing-wrapper" >
        <?php
        $class = 'wpcd-comment-list';
        $css="";
        $child = 0;
        WPCD_LITE_CLASS::wpcd_list_comments($comment_listing, $class, $css, $template);
        ?>
    </div>
</div>