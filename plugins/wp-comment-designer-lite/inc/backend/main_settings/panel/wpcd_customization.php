<?php
defined('ABSPATH') or die("No script kiddies please!");

$font_family=array(
    'Default',
    'Arial',
    'Arial Black',
    'Arial Narrow',
    'Arial Rounded MT Bold',
    'Avant Garde',
    'Calibri',
    'Candara',
    'Century Gothic',
    'Franklin Gothic Medium',
    'Futura',
    'Geneva',
    'Gill Sans',
    'Open Sans',
    'Helvetica',
    'Impact',
    'Lucida Grande',
    'Optima',
    'Segoe UI',
    'Tahoma',
    'Trebuchet MS',
    'Verdana',
    'Big Caslon',
    'Bodoni MT',
    'Book Antiqua',
    'Calisto MT',
    'Cambria',
    'Didot',
    'Garamond',
    'Georgia',
    'Goudy Old Style',
    'Hoefler Text',
    'Lucida Bright',
    'Palatino',
    'Perpetua',
    'Rockwell',
    'Rockwell Extra Bold',
    'Baskerville',
    'Times New Roman',
    'Consolas',
    'Courier New',
    'Lucida Console',
    'Lucida Sans Typewriter',
    'Monaco',
    'Andale Mono',
    'Copperplate',
    'Papyrus',
    'Brush Script MT'
);

?>
<div class="customization-menu-wrap settings-content" id="Customization" style="display:none;" >
    <div class="wpcd-subhead">
        <h2><?php _e('CUSTOM SETTINGS', 'wp-comment-designer-lite') ?></h2>
    </div>
    <div class="wpcd-row-odd">
        <div class="custom-email-div wpcd-configuration-div wpcd-clearfix">
            <div class="wpcd-title-div">
                <h3><?php _e('Before Notes Text', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <label class="error">
                    <input type="text" name="wpcd_settings[comment_notes_before]" placeholder="<?php _e('Your email address will not be published.', 'wp-comment-designer-lite') ?>" value="<?php echo (isset($wpcd_settings['comment_notes_before']) && $wpcd_settings['comment_notes_before'] != '') ? esc_attr($wpcd_settings['comment_notes_before']) : ''; ?>"/>
                </label>
                <p class="description"> <?php _e(' Enter the text to be displayed before the set of comment form fields if the user is not logged in', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
    </div>
    <div class="wpcd-row-even">
        <div class="custom-error-message-div wpcd-configuration-div wpcd-clearfix">
            <div class="wpcd-title-div">
                <h3><?php _e('After Notes Text', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <label class="error">
                    <input type="text" name="wpcd_settings[comment_notes_after]" placeholder="<?php _e('Your email address will not be published.', 'wp-comment-designer-lite') ?>" value="<?php echo (isset($wpcd_settings['comment_notes_after']) && $wpcd_settings['comment_notes_after'] != '') ? esc_attr($wpcd_settings['comment_notes_after']) : ''; ?>"/>
                </label>
                <p class="description"> <?php _e('Enter the text to be displayed after the set of comment form fields and before the submit button', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
    </div>
    <div class="wpcd-row-odd">
        <div class="custom-button-div wpcd-configuration-div wpcd-clearfix">
            <div class="wpcd-title-div">
                <h3><?php _e('Comment Label', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <label class="error">
                    <input type="text" name="wpcd_settings[title_reply]" placeholder="<?php _e('Leave a Comment', 'wp-comment-designer-lite') ?>" value="<?php echo (isset($wpcd_settings['title_reply']) && $wpcd_settings['title_reply'] != '') ? esc_attr($wpcd_settings['title_reply']) : ''; ?>"/>
                </label>
                <p class="description"> <?php _e('Enter the label to be displayed for asking the users to leave a comment for a post. Note: If left empty, this field will take the value "Leave A Comment"', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
    </div>
    <div class="wpcd-row-even">
        <div class="custom-comment-title-div wpcd-configuration-div wpcd-clearfix">
            <div class="wpcd-title-div">
                <h3><?php _e('Reply Button Label', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <label class="error">
                    <input type="text" name="wpcd_settings[reply_button_label]" placeholder="<?php _e('Reply', 'wp-comment-designer-lite') ?>" value="<?php echo (isset($wpcd_settings['reply_button_label']) && $wpcd_settings['reply_button_label'] != '') ? esc_attr($wpcd_settings['reply_button_label']) : ''; ?>"/>
                </label>
                <p class="description"> <?php _e('Enter the label to be displayed for the trigger button for replying beneath each comment. Note: If left empty, this field will take the value "Reply"', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
    </div>
    <div class="wpcd-row-odd">
        <div class="custom-comment-title-div wpcd-configuration-div wpcd-clearfix">
            <div class="wpcd-title-div">
                <h3><?php _e('Cancel Reply Label', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <label class="error">
                    <input type="text" name="wpcd_settings[cancel_reply_link]" placeholder="<?php _e('Cancel Reply', 'wp-comment-designer-lite') ?>" value="<?php echo (isset($wpcd_settings['cancel_reply_link']) && $wpcd_settings['cancel_reply_link'] != "") ? esc_attr($wpcd_settings['cancel_reply_link']) : ''; ?>"/>
                </label>
                <p class="description"> <?php _e('Enter the label to be displayed for canceling a reply. Note: if empty, this field will take the value "Cancel Reply"', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
    </div>
    <div class="wpcd-row-even">
        <div class="custom-comment-title-div wpcd-configuration-div wpcd-clearfix">
            <div class="wpcd-title-div">
                <h3><?php _e('Comment Form Submit Label', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <label class="error">
                    <input type="text" name="wpcd_settings[label_submit]" placeholder="<?php _e('Post Comment', 'wp-comment-designer-lite') ?>" value="<?php echo (isset($wpcd_settings['label_submit']) && $wpcd_settings['label_submit'] != '') ? esc_attr($wpcd_settings['label_submit']) : ''; ?>"/>
                </label>
                <p class="description"> <?php _e('Enter the label you want for your comment form submit button. Note: if empty, this field will take the value "Post Comment"', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
    </div>
    <div class="wpcd-row-odd">
        <div class="custom-comment-title-div wpcd-configuration-div wpcd-clearfix">
            <div class="wpcd-title-div">
                <h3><?php _e('Font family', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <select name="wpcd_settings[font_family]" id="selected_pagination" class="select-pagination-dropdown ">
                    <optgroup label="<?php _e('Font Family', 'wp-comment-designer-lite') ?>">
                        <?php
                        foreach ($font_family as $family) {
                            ?>
                            <option value ="<?php echo $family ?>" <?php if (isset($wpcd_settings['font_family']) && $wpcd_settings['font_family'] == $family) { ?>selected="selected"<?php } ?> style = 'font-family:"<?php echo $family ?>" ;'>
                                <?php
                                _e($family, 'wp-comment-designer-lite');
                                ?>
                            </option>
                           <?php 
                        } ?> 
                    </optgroup>
                </select>
                <p class="description"> <?php _e('Select the font family for the for the comments section', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
    </div>
</div>