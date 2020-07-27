<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="wpcd-element wpcd-form-field-sort wpcd-clearfix">
    <span class="wpcd-fa fa fa-arrows"></span>
    <label>
        <h2><?php _e('URL', 'wp-comment-designer-lite') ?></h2>
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
                <label for= "enable_url">
                    <h3>  <?php _e('Show on form', 'wp-comment-designer-lite') ?> </h3>
                </label>
            </div>
            <div class="wpcd-option-value">
                <label class="enable_comment wpcd-switch">
                    <input type="checkbox" name="wpcd_form_settings[field][url][show_on_form]" id="enable_url" value="enable" <?php if (isset($wpcd_form_settings['field']['url']['show_on_form']) && $wpcd_form_settings['field']['url']['show_on_form'] === "enable") {
                        ?>checked="checked"<?php } ?>>
                        <label class="wpcd-general-checkbox" for ="enable_url"></label>
                        <?php _e('Enable', 'wp-comment-designer-lite') ?>
                        <div class="wpcd-check round"></div>
                </label>
                <p class="description"> <?php _e('Enable to display the name element in the frontend. Note: This element is not displayed for logged-in users', 'wp-comment-designer-lite') ?> </p>             
            </div>
        </div>
    </div>
    <div class="wpcd-row-even">
        <div class="wpcd-cd-enable-div wpcd-form-general-div wpcd-clearfix" >
            <div class="wpcd-title-div">
                <label for= "enable_comment">
                   <h3>  <?php _e('Label', 'wp-comment-designer-lite') ?> </h3>
                </label>
            </div>
            <div class="wpcd-option-value">
                <label class="enable_comment wpcd-switch">
                    <input type="text" name="wpcd_form_settings[field][url][label]" placeholder="<?php _e('', 'wp-comment-designer-lite') ?>" value="<?php echo (isset($wpcd_form_settings['field']['url']['label']) && $wpcd_form_settings['field']['url']['label'] != '') ? esc_attr($wpcd_form_settings['field']['url']['label']) : ''; ?>"/>
                </label>
                <p class="description"> <?php _e('Enter the url label to be displayed in the frontend', 'wp-comment-designer-lite') ?> </p>             
            </div>
        </div>
    </div>
    <div class="wpcd-row-odd">
        <div class="wpcd-comment-length-div wpcd-general-div wpcd-clearfix" >
            <div class="wpcd-title-div">
                <h3>  <?php _e('Display Label', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <label class="enable">
                    <input type="radio" name="wpcd_form_settings[field][url][display_label]" class="status-mode" value="yes" <?php echo ((isset($wpcd_form_settings['field']['url']['display_label'])) && $wpcd_form_settings['field']['url']['display_label'] === "yes") ? "checked='checked'" : ""; ?> > <?php _e('Yes', 'wp-comment-designer-lite') ?>
                </label>
                <label class="disabled">
                    <input type="radio" name="wpcd_form_settings[field][url][display_label]" class="status-mode" value="no" <?php echo (isset($wpcd_form_settings['field']['url']['display_label']) && ($wpcd_form_settings['field']['url']['display_label']) === "no") ? "checked='checked'" : ""; ?> > <?php _e('No', 'wp-comment-designer-lite') ?>
                </label>
                <p class="description"> <?php _e('Choose whether or not to display the url label in the frontend', 'wp-comment-designer-lite', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
    </div>
    <div class="wpcd-row-even">
        <div class="wpcd-cd-enable-div wpcd-form-general-div wpcd-clearfix" >
            <div class="wpcd-title-div">
                <label for= "enable_comment">
                    <h3>  <?php _e('Placeholder', 'wp-comment-designer-lite') ?> </h3>
                </label>
            </div>
            <div class="wpcd-option-value">
                <label class="enable_comment wpcd-switch">
                    <input type="text" name="wpcd_form_settings[field][url][placeholder]" value="<?php echo (isset($wpcd_form_settings['field']['url']['placeholder']) && $wpcd_form_settings['field']['url']['placeholder'] != '') ? esc_attr($wpcd_form_settings['field']['url']['placeholder']) : ''; ?>"/>
                </label>
                <p class="description"> <?php _e('Enter the placeholder to be displayed in the url field', 'wp-comment-designer-lite') ?> </p>             
            </div>
        </div>
        <input type="hidden" name="wpcd_form_settings[field][url][field_type]"  value="url"/>
        <input type="hidden" name="wpcd_form_settings[field][url][element_type]"  value="default"/> 
    </div>
</div>