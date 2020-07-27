<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="field-form-menu-wrap settings-content" id="form-field" >
    <div class="wpcd-subhead">
        <h2><?php _e('FIELD SETTINGS', 'wp-comment-designer-lite') ?></h2>
    </div>
    <?php
    $wpcd_form_settings = get_option('wpcd_form_settings');
    ?>
    <div class="wpcd-field-settings-wrap wpcd-clearfix">
        <div class="wpcd-custom-wrapper">
            <?php
            if (isset($wpcd_form_settings['field']) && !empty($wpcd_form_settings['field'])) {
                foreach ($wpcd_form_settings['field'] as $key => $value) {
                    if ($key == 'commentarea' || $key == 'name' || $key == 'email' || $key == 'url') {
                        ?>
                        <div class="wpcd-default-elements-wrap wpcd-sortable-elements-wrap" > 
                            <?php include(WPCD_LITE_PLUGIN_PATH . 'inc/backend/form_builder/panel/fields/default/wpcd_' . $key . '.php'); ?>
                        </div>
                        <?php
                    } 
                }
            }
            ?> 
        </div>  
    </div>
</div>

