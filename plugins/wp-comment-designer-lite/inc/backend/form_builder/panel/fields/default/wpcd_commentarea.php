<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="wpcd-element wpcd-form-field-sort wpcd-clearfix">
    <span class="wpcd-fa fa fa-arrows"></span>
    <label>
        <h2><?php _e('Comment Area', 'wp-comment-designer-lite') ?></h2>
    </label>
    <div class="wpcd-element-action-buttons">
        <a href="javascript:void(0)" class="wpcd-elements-settings-trigger button-primary"><?php _e('Settings', 'wp-comment-designer-lite') ?></a>
        <span class="fa fa-chevron-down"></span>
    </div>
</div>
<div class = "wpcd-elements-settings-wrap" style="display:none;" >
    <div class="wpcd-row-odd">
        <div class="wpcd-cd-enable-div wpcd-form-general-div wpcd-clearfix" >
            <div class="wpcd-title-div">
                <label for= "enable_comment">
                    <h3>  <?php _e('Label', 'wp-comment-designer-lite') ?> </h3>
                </label>
            </div>
            <div class="wpcd-option-value">
                <label class="enable_comment wpcd-switch">
                    <input type="text" name="wpcd_form_settings[field][commentarea][label]" placeholder="<?php _e('', 'wp-comment-designer-lite') ?>" value="<?php echo (isset($wpcd_form_settings['field']['commentarea']['label']) && $wpcd_form_settings['field']['commentarea']['label'] != '' ) ? esc_attr($wpcd_form_settings['field']['commentarea']['label']) : ''; ?>"/>
                </label>
                <p class="description"> <?php _e('Enter the label to be displayed for the comment area', 'wp-comment-designer-lite') ?> </p>             
            </div>
        </div>
    </div>
    <div class="wpcd-row-even">
        <div class="wpcd-comment-length-div wpcd-general-div wpcd-clearfix" >
            <div class="wpcd-title-div">
                <h3>  <?php _e('Display Label', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <label class="enable">
                    <input type="radio" name="wpcd_form_settings[field][commentarea][display_label]"  value="yes" <?php echo ((isset($wpcd_form_settings['field']['commentarea']['display_label'])) && $wpcd_form_settings['field']['commentarea']['display_label'] === "yes") ? "checked='checked'" : ""; ?> > <?php _e('Yes', 'wp-comment-designer-lite') ?>
                </label>
                <label class="disabled">
                    <input type="radio" name="wpcd_form_settings[field][commentarea][display_label]"  value="no" <?php echo (isset($wpcd_form_settings['field']['commentarea']['display_label']) && ($wpcd_form_settings['field']['commentarea']['display_label']) === "no") ? "checked='checked'" : ""; ?> > <?php _e('No', 'wp-comment-designer-lite') ?>
                </label>
                <p class="description"> <?php _e('Choose whether or not to display the comment area label in the frontend', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
    </div>
    <div class="wpcd-row-odd">
            <div class="wpcd-cd-enable-div wpcd-form-general-div wpcd-clearfix" >
                <div class="wpcd-title-div">
                    <label for= "enable_comment">
                        <h3>  <?php _e('Placeholder', 'wp-comment-designer-lite') ?> </h3>
                    </label>
                </div>
                <div class="wpcd-option-value">
                    <label class="enable_comment wpcd-switch">
                        <input type="text" name="wpcd_form_settings[field][commentarea][placeholder]" value="<?php echo (isset($wpcd_form_settings['field']['commentarea']['placeholder']) && $wpcd_form_settings['field']['commentarea']['placeholder'] != "") ? esc_attr($wpcd_form_settings['field']['commentarea']['placeholder']) : ''; ?>"/>
                    </label>
                    <p class="description"> <?php _e('Enter the placeholder to be displayed in the commentarea field', 'wp-comment-designer-lite') ?> </p>             
                </div>
            </div>
    </div>
    <input type="hidden" name="wpcd_form_settings[field][commentarea][field_type]"  value="textarea"/> 
    <input type="hidden" name="wpcd_form_settings[field][commentarea][element_type]"  value="default"/> 
</div>