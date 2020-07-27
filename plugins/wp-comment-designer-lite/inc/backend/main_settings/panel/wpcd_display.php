<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="display-menu-wrap settings-content" id="Display" style="display:none;" >
    <div class="wpcd-subhead">
        <h2><?php _e('DISPLAY SETTINGS', 'wp-comment-designer-lite') ?></h2>
    </div>
    <div class="wpcd-row-odd">
        <div class="wpcd-field-wrap wpcd-configuration-div">
            <div class="wpcd-title-div">
                <label for="wpcd_settings[template_number]" class="display-label-controller">
                    <?php _e('Comment Lists Template', 'wp-comment-designer-lite'); ?>
                </label>
            </div>
            <div class="wpcd-menu-inner-field wpcd-option-value">
                <select name="wpcd_settings[template_number]" id="icon-template" class="wpcd-display template-dropdown" size="1" >
                    <?php 
                    $template_names=array(
                        'Candid Template',
                        'Lounge Template',
                        'Ambient Template',
                        'Delightful Template'
                        );

                    $i=1;
                    foreach ($template_names as $name) {
                            ?>
                        <option class="wpcd-temp" value="template-<?php echo $i; ?>" <?php if (isset($wpcd_settings['template_number']) && $wpcd_settings['template_number'] == 'template-' . $i) { ?>selected="selected"<?php } ?>>
                                <?php
                                _e($name, 'wp-comment-designer-lite');
                                ?>
                            </option>
                           <?php $i++; } ?> 
                </select>
                <div class="wpcd-template-demo" >
                    <?php $cnt=1;
                    foreach ($template_names as $name) { ?>
                        <div class="wpcd-common" id="wpcd-temp-demo-<?php echo $cnt; ?>" <?php if ($cnt != 1) { ?>style="display:none;"<?php } ?>>
                            <div class="wpcd-preview"> Preview </div> 
                            <div class="wpcd-display-template wpcd-clearfix">
                                <img src="<?php echo WPCD_LITE_PLUGIN_URL . 'img/template-comment-list/template-' . $cnt . '.png' ?>"  class="wpcd-display-template-list-<?php echo $cnt; ?>"/>
                                <div>
                                    <img src="<?php echo WPCD_LITE_PLUGIN_URL . 'img/template-comment-form/template-' . $cnt . '.png' ?>"  class="wpcd-display-template-form-<?php echo $cnt; ?>"/>
                                    <img src="<?php echo WPCD_LITE_PLUGIN_URL . 'img/template-save-button/' . $cnt . '.png' ?>"  class="wpcd-display-template-form-<?php echo $cnt; ?>"/>
                                </div>
                            </div>
                        </div>
                    <?php $cnt++; } ?> 
                </div>
            </div>
        </div>
    </div>
</div>