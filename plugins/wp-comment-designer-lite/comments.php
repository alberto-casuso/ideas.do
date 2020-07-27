<?php defined('ABSPATH') or die("No script kiddies please!");
$wpcd_settings = get_option('wpcd_settings');
$wpcd_form_settings = get_option('wpcd_form_settings');
$post = get_post();
$post_id = !empty($post) ? $post->ID : '';
$template = (isset($wpcd_settings['template_number']) && $wpcd_settings['template_number'] != "") ? esc_attr($wpcd_settings['template_number']) : 'template-1';

if (is_user_logged_in()) {
    $user_status = "wpcd-logged-in";
} else {
    $user_status = "wpcd-not-logged-in";
}

if (post_password_required()) {
    return;
}
?>
<input type="hidden" id="wpcd-current-post-id" value=<?php echo $post_id; ?> >

<?php
$hide_replies = (isset($wpcd_settings['hide_replies']) && $wpcd_settings['hide_replies'] == 'enable' ) ? esc_attr($wpcd_settings['hide_replies']) : '';
?>
<input type="hidden" id="wpcd-hide-replies" value="<?php echo $hide_replies ?>" >
<div id="comments" class="wpcd-comments-area">
    <!-- WPCD COMMENT LISTING -->
    <?php
    $sort_type = 'default';
    include(WPCD_LITE_PLUGIN_PATH . 'inc/frontend/wpcd_comment_listing.php');
    ?>
    <!-- WPCD COMMENT FORM  -->
    <div id="wpcd-comments" class="wpcd-comments-form wpcd-not-demo <?php echo $user_status; ?>">
        <?php
            WPCD_LITE_CLASS::wpcd_build_frontend_form();
        ?>
    </div>
</div>

