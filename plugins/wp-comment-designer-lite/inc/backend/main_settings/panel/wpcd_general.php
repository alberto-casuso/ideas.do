<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="general-menu-wrap settings-content" id="General" style="display:block;" >
    <div class="wpcd-subhead">
        <h2><?php _e('GENERAL SETTINGS', 'wp-comment-designer-lite') ?></h2>
    </div>
    <?php $wpcd_settings = get_option('wpcd_settings'); ?>
    <div class="wpcd-row-odd">
        <div class="wpcd-cd-enable-div wpcd-general-div">
            <div class="wpcd-title-div">
                <label for= "enable_comment">
                    <h3>  <?php _e('Enable WP Comment Designer Lite', 'wp-comment-designer-lite') ?> </h3>
                </label>
            </div>
            <div class="wpcd-option-value">
                <label class="enable_comment wpcd-switch">
                    <input type="checkbox" name="wpcd_settings[enable_comment]" id= "enable_comment" value="enable" <?php if (isset($wpcd_settings['enable_comment']) && $wpcd_settings['enable_comment'] === "enable") {
        ?>checked="checked"<?php } ?>>
                    <label class="wpcd-general-checkbox" for ="enable_comment"></label>
                    <?php _e('Enable', 'wp-comment-designer-lite') ?>
                    <div class="wpcd-check round"></div>
                </label>
                <p class="description"> <?php _e('Tick to enable WP Comment Designer Lite ', 'wp-comment-designer-lite') ?> </p>             
            </div>
        </div>
    </div>
    
    <div class="wpcd-row-even">
        <div class="wpcd-comment-number-div wpcd-general-div" >
            <div class="wpcd-title-div">
                <h3>  <?php _e('Total Comment Number', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <label class="enable">
                    <input type="radio" name="wpcd_settings[comment_number]" value="show" <?php echo ((isset($wpcd_settings['comment_number'])) && $wpcd_settings['comment_number'] === "show") ? "checked='checked'" : ""; ?> > <?php _e('Show', 'wp-comment-designer-lite') ?>
                </label>
                <label class="disabled">
                    <input type="radio" name="wpcd_settings[comment_number]" value="hide" <?php echo (isset($wpcd_settings['comment_number']) && ($wpcd_settings['comment_number']) === "hide") ? "checked='checked'" : ""; ?> > <?php _e('Hide', 'wp-comment-designer-lite') ?>
                </label>
                <p class="description"> <?php _e('Show/Hide total number of comments in the frontend', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
    </div>

    <div class="wpcd-row-odd">
        <div class="wpcd-show-hide-replies-div wpcd-general-div" >
            <div class="wpcd-title-div">
                <h3>  <?php _e('Show/Hide Replies', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <label class="enable">
                    <input type="radio" name="wpcd_settings[hide_replies]" class="wpcd-show-hide-replies" value="enable" <?php echo ((isset($wpcd_settings['hide_replies'])) && $wpcd_settings['hide_replies'] === "enable") ? "checked='checked'" : ""; ?> > <?php _e('Enable', 'wp-comment-designer-lite') ?>
                </label>
                <label class="disabled">
                    <input type="radio" name="wpcd_settings[hide_replies]" class="wpcd-show-hide-replies" value="disable" <?php echo (isset($wpcd_settings['hide_replies']) && ($wpcd_settings['hide_replies']) === "disable") ? "checked='checked'" : ""; ?> > <?php _e('Disable', 'wp-comment-designer-lite') ?>
                </label>
                <p class="description"> <?php _e('Enable/Disable to hide the comment replies in the comment list', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
        <div class="wpcd-show-replies-div wpcd-general-div" <?php echo (isset($wpcd_settings['hide_replies']) && $wpcd_settings['hide_replies'] === "disable") ? "style='display:none;'" : ""; ?>>
            <div class="wpcd-title-div">
                <h3>  <?php _e('Show Reply Label', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <label class="error">
                    <input type="text" name="wpcd_settings[show_reply_label]" placeholder="<?php _e('Show Replies', 'wp-comment-designer-lite') ?>" value="<?php echo (isset($wpcd_settings['show_reply_label']) && $wpcd_settings['show_reply_label'] != '') ? esc_attr($wpcd_settings['show_reply_label']) : ''; ?>"/>
                </label>
                <p class="description"> <?php _e(' Enter the label for the trigger button for displaying replies', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
        <div class="wpcd-hide-replies-div wpcd-general-div" <?php echo (isset($wpcd_settings['hide_replies']) && $wpcd_settings['hide_replies'] === "disable") ? "style='display:none;'" : ""; ?>>
            <div class="wpcd-title-div">
                <h3>  <?php _e('Hide Reply Label', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <label class="error">
                    <input type="text" name="wpcd_settings[hide_reply_label]" placeholder="<?php _e('Hide Replies', 'wp-comment-designer-lite') ?>" value="<?php echo (isset($wpcd_settings['hide_reply_label']) && $wpcd_settings['hide_reply_label'] != '') ? esc_attr($wpcd_settings['hide_reply_label']) : ''; ?>"/>
                </label>
                <p class="description"> <?php _e(' Enter the label for the trigger button for hiding replies', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
    </div>
    
    <div class="wpcd-row-even">
        <div class="wpcd-user-registration-div wpcd-general-div" >
            <div class="wpcd-title-div">
                <h3>  <?php _e('Comment Rating', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <label class="enable">
                    <input type="radio" name="wpcd_settings[comment_rating]" value="enable" <?php echo ((isset($wpcd_settings['comment_rating'])) && $wpcd_settings['comment_rating'] === "enable") ? "checked='checked'" : ""; ?> > <?php _e('Enable', 'wp-comment-designer-lite') ?>
                </label>
                <label class="disabled">
                    <input type="radio" name="wpcd_settings[comment_rating]" value="disable" <?php echo (isset($wpcd_settings['comment_rating']) && ($wpcd_settings['comment_rating']) === "disable") ? "checked='checked'" : ""; ?> > <?php _e('Disable', 'wp-comment-designer-lite') ?>
                </label>
                <p class="description"> <?php _e('Enable/Disable to allow comment rating', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
    </div>
</div>